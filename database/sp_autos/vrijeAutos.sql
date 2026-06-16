USE BEverkantewielen; 

DELIMITER $$

DROP PROCEDURE IF EXISTS `KrijgAlleVrijeVoertuigen`$$

CREATE PROCEDURE `KrijgAlleVrijeVoertuigen`()
BEGIN -- <--- Dit keyword ontbrak!
    SELECT 
        v.Id AS VoertuigID,
        tv.TypeVoertuig,
        v.Type,
        v.Kenteken,
        v.Bouwjaar,
        v.Brandstof,
        tv.RijbewijsCategorie
    FROM Voertuig v
    INNER JOIN TypeVoertuig tv ON v.TypeVoertuigId = tv.Id
    WHERE v.Isactief = 1
      -- Check 1: Het voertuig mag geen andere actieve instructeur hebben
      AND NOT EXISTS (
          SELECT 1 
          FROM VoertuigInstructeur vi 
          WHERE vi.VoertuigId = v.Id 
            AND vi.Isactief = 1
      ); -- <--- Puntkomma toegevoegd voor nette afsluiting binnen de procedure
END $$

DELIMITER ;