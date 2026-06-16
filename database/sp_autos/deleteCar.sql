-- Procedure: Verwijder een voertuig veilig binnen een transactie
USE BEverkantewielen;

DELIMITER $$

DROP PROCEDURE IF EXISTS `DeleteCar`; $$

CREATE PROCEDURE `DeleteCar`(
    IN p_VoertuigId INT UNSIGNED
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

        -- 1. Verwijder alleen de koppeling met de instructeur
        DELETE FROM VoertuigInstructeur WHERE VoertuigId = p_VoertuigId;

    -- Als alles zonder fouten is doorlopen, sla de wijzigingen definitief op
    COMMIT;
            
END $$

DELIMITER ;