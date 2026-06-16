use BEverkantewielen; 

DELIMITER $$

DROP PROCEDURE IF EXISTS `KrijgInstructeur`;

CREATE PROCEDURE `KrijgInstructeur`(
    IN p_InstructeurId INT UNSIGNED
)
BEGIN
    -- 1. Eerst halen we de gegevens van de instructeur op voor de bovenkant van je scherm
    SELECT 
        i.Id AS InstructeurId,
        CONCAT_WS(' ', i.Voornaam, i.Tussenvoegsel, i.Achternaam) AS InstructeurNaam,
        i.DatumInDienst,
        i.AantalSterren
    FROM Instructeur i
    WHERE i.Id = p_InstructeurId;
    
END $$

DELIMITER ;