-- Procedure: Verwijder een voertuig veilig binnen een transactie
USE BEverkantewielen;

DELIMITER $$

DROP PROCEDURE IF EXISTS `DeleteCar`; $$

CREATE PROCEDURE `DeleteCar`(
    IN p_VoertuigId INT
)
BEGIN
    -- Foutafhandeling: Als er een SQL-fout optreedt, rol de transactie dan terug
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Transactie mislukt: Voertuig kon niet worden verwijderd.';
    END;

    -- Start de transactie
    START TRANSACTION;

        -- 1. Verwijder eerst de gekoppelde instructeurs
        DELETE FROM VoertuigInstructeur WHERE VoertuigId = p_VoertuigId;

        -- 2. Verwijder daarna het voertuig zelf
        DELETE FROM Voertuig WHERE Id = p_VoertuigId;

    -- Als alles zonder fouten is doorlopen, sla de wijzigingen definitief op
    COMMIT;
            
END $$

DELIMITER ;