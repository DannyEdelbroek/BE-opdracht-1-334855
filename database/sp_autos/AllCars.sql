USE BEverkantewielen;

-- Procedure: return all vehicles (only vehicle details, no instructor)
DELIMITER $$

DROP PROCEDURE IF EXISTS `KrijgAlleVoertuigen`; $$

CREATE PROCEDURE `KrijgAlleVoertuigen`()
BEGIN
    SELECT 
        v.Id AS VoertuigID,
        tv.TypeVoertuig,
        v.Type,
        v.Kenteken,
        v.Bouwjaar,
        v.Brandstof,
        tv.RijbewijsCategorie,
        CONCAT_WS(' ', i.Voornaam, i.Tussenvoegsel, i.Achternaam) AS InstructeurNaam
    FROM Voertuig v
    INNER JOIN TypeVoertuig tv ON v.TypeVoertuigId = tv.Id
    LEFT JOIN VoertuigInstructeur vi ON v.Id = vi.VoertuigId
    LEFT JOIN Instructeur i ON vi.InstructeurId = i.Id
    ORDER BY tv.RijbewijsCategorie DESC;
END $$

DELIMITER ;

-- Procedure: delete a voertuig only when not active
DELIMITER $$

DROP PROCEDURE IF EXISTS `VerwijderVoertuig`; $$

CREATE PROCEDURE `VerwijderVoertuig`(
    IN p_VoertuigId INT
)
BEGIN
    DECLARE v_isactief INT DEFAULT 0;
    DECLARE v_exists INT DEFAULT 0;

    SELECT COUNT(*) INTO v_exists FROM Voertuig WHERE Id = p_VoertuigId;

    IF v_exists = 0 THEN
        SELECT 'not_found' AS status;
    ELSE
        SELECT Isactief INTO v_isactief FROM Voertuig WHERE Id = p_VoertuigId LIMIT 1;

        IF v_isactief = 1 THEN
            SELECT 'active' AS status; -- cannot delete active vehicle
        ELSE
            -- remove child relations first (if any)
            DELETE FROM VoertuigInstructeur WHERE VoertuigId = p_VoertuigId;

            DELETE FROM Voertuig WHERE Id = p_VoertuigId;

            SELECT 'deleted' AS status;
        END IF;
    END IF;
END $$

DELIMITER ;