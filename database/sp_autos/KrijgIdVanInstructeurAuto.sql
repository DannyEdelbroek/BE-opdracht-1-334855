    USE BEverkantewielen;

    DELIMITER $$

    DROP PROCEDURE IF EXISTS `KrijgVoertuigWijzigGegevens`; $$
    CREATE PROCEDURE `KrijgVoertuigWijzigGegevens`(
        IN p_VoertuigId INT UNSIGNED
    )
    BEGIN
        SELECT 
            v.Id AS VoertuigID,
            v.TypeVoertuigId,
            v.Type,
            v.Bouwjaar,
            v.Brandstof,
            v.Kenteken,
            vi.InstructeurId,
            -- CONCAT_WS voegt de velden samen met een spatie, en slaat NULL-waarden (tussenvoegsels) netjes over!
            CONCAT_WS(' ', i.Voornaam, i.Tussenvoegsel, i.Achternaam) AS InstructeurNaam
        FROM Voertuig v
        LEFT JOIN VoertuigInstructeur vi ON v.Id = vi.VoertuigId AND vi.Isactief = 1
        LEFT JOIN Instructeur i ON vi.InstructeurId = i.Id
        WHERE v.Id = p_VoertuigId;
    END $$


    DROP PROCEDURE IF EXISTS `UpdateVoertuigGegevens`; $$
    CREATE PROCEDURE `UpdateVoertuigGegevens`(
        IN p_VoertuigId INT UNSIGNED,
        IN p_InstructeurId INT UNSIGNED,
        IN p_TypeVoertuigId INT UNSIGNED,
        IN p_Type VARCHAR(50),
        IN p_Bouwjaar DATE,
        IN p_Brandstof VARCHAR(20),
        IN p_Kenteken VARCHAR(10)
    )
    BEGIN
        -- Start de transactie veilig
        START TRANSACTION;

        -- 1. Update de basisgegevens van het voertuig
        UPDATE Voertuig 
        SET 
            TypeVoertuigId = p_TypeVoertuigId,
            Type = p_Type,
            Bouwjaar = p_Bouwjaar,
            Brandstof = p_Brandstof,
            Kenteken = p_Kenteken,
            DatumGewijziged = NOW(6)
        WHERE Id = p_VoertuigId;

        -- 2. Update de gekoppelde instructeur in de tussentabel
        UPDATE VoertuigInstructeur
        SET 
            InstructeurId = p_InstructeurId,
            DatumGewijziged = NOW(6)
        WHERE VoertuigId = p_VoertuigId AND Isactief = 1;

        -- CRUCIAAL: Sla de data nu écht permanent op in de database!
        COMMIT;
        
    END $$

    DELIMITER ;