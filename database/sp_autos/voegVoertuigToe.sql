USE BEverkantewielen; 

DELIMITER $$

DROP PROCEDURE IF EXISTS `voegVoertuigToe`$$

CREATE PROCEDURE `voegVoertuigToe`(
    IN p_VoertuigId INT UNSIGNED,
    IN p_InstructeurId INT UNSIGNED
)
BEGIN

    -- De transactie wordt teruggedraaid als er TOCH iets misgaat (bijv. een niet-bestaand ID)
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
        BEGIN
            ROLLBACK;
            SELECT 0 AS success, 'An error occurred. Transaction rolled back.' AS message, NULL AS AutoID;
        END;

    START TRANSACTION;

    INSERT INTO VoertuigInstructeur (
            VoertuigId,
            InstructeurId,
            DatumToekenning,
            isactief,
            DatumAangemaakt,
            DatumGewijziged
        ) VALUES (
            p_VoertuigId,
            p_InstructeurId,
            NOW(),
            1,
            NOW(),
            NOW()
        );

    COMMIT;

    -- Dit wordt alleen uitgevoerd als de COMMIT succesvol is afgerond
    SELECT 
            1 AS success,
            'Auto is succesvol toegevoegd' AS message,
            LAST_INSERT_ID() AS AutoID;
END $$

DELIMITER ;