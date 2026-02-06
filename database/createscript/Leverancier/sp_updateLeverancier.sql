    USE jamin;

    DROP PROCEDURE IF EXISTS sp_updateLeverancier;

    DELIMITER $$

    CREATE PROCEDURE sp_updateLeverancier(
        IN p_ContactId INT,
        IN p_Naam VARCHAR(50),
        IN p_ContactPersoon VARCHAR(100),
        IN p_LeverancierNummer VARCHAR(40),
        IN p_Mobiel VARCHAR(20),
        IN p_Straat VARCHAR(100),
        IN p_Huisnummer VARCHAR(10),
        IN p_Postcode VARCHAR(10),
        IN p_Stad VARCHAR(50),
        OUT p_ResultMessage VARCHAR(200) CHARACTER SET utf8mb4
    )
    BEGIN
        -- Declare error handler
        DECLARE EXIT HANDLER FOR SQLEXCEPTION
        BEGIN
            ROLLBACK;
            SET p_ResultMessage = 'Door een technische storing is het niet mogelijk de wijziging door te voeren. 
                                Probeer het op een later moment nog eens';
        END;

        -- Start transactie
        START TRANSACTION;

        -- Update Contact tabel
        UPDATE Contact
        SET 
            Straat = p_Straat,
            Huisnummer = p_Huisnummer,
            Postcode = p_Postcode,
            Stad = p_Stad
        WHERE Id = p_ContactId;

        -- Update Leverancier tabel
        UPDATE Leverancier
        SET 
            Naam = p_Naam,
            ContactPersoon = p_ContactPersoon, 
            LeverancierNummer = p_LeverancierNummer,
            Mobiel = p_Mobiel
        WHERE ContactId = p_ContactId;

        -- Commit als alles goed gaat
        COMMIT;

        SET p_ResultMessage = 'Leverancier is succesvol bijgewerkt.';

        SELECT ROW_COUNT() AS affected;

    END $$

    DELIMITER ;