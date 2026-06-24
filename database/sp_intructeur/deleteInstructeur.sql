USE BEverkantewielen;

-- Procedure: delete a voertuig only when not active
DELIMITER $$

DROP PROCEDURE IF EXISTS `deleteInstructeur`; $$

CREATE PROCEDURE `deleteInstructeur`(
    IN p_InstructeurId INT
)
BEGIN
    DECLARE v_isactief INT DEFAULT 0;
    DECLARE v_exists INT DEFAULT 0;

    SELECT COUNT(*) INTO v_exists FROM Voertuig WHERE Id = p_InstructeurId;

    IF v_exists = 0 THEN
        SELECT 'not_found' AS status;
    ELSE
        SELECT Isactief INTO v_isactief FROM Instructeur  WHERE Id = p_InstructeurId LIMIT 1;

        IF v_isactief = 1 THEN
            SELECT 'active' AS status; -- cannot delete active vehicle
        ELSE
            -- remove child relations first (if any)
            DELETE FROM VoertuigInstructeur WHERE InstructeurId = p_InstructeurId;

            SELECT 'deleted' AS status;
        END IF;
    END IF;
END $$

DELIMITER ;