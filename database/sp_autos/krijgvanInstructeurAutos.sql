USE BEverkantewielen;

DELIMITER $$

DROP PROCEDURE IF EXISTS `KrijgVoertuigenVanInstructeur`; $$

CREATE PROCEDURE `KrijgVoertuigenVanInstructeur`(
    IN p_InstructeurId INT UNSIGNED
)
BEGIN
    SELECT 
        -- Instructeur metadata (bovenkant schets)
        i.Id AS InstructeurID,
        i.Voornaam,
        i.Tussenvoegsel,
        i.Achternaam,
        i.DatumInDienst,
        i.AantalSterren,
        
        -- Voertuig informatie (tabel in schets)
        v.Id AS VoertuigID,
        tv.TypeVoertuig,
        v.Type,
        v.Kenteken,
        v.Bouwjaar,
        v.Brandstof,
        tv.RijbewijsCategorie
    FROM Instructeur i
    -- Koppel via de tussentabel naar de voertuigen
    INNER JOIN VoertuigInstructeur vi ON i.Id = vi.InstructeurId
    LEFT JOIN Voertuig v ON vi.VoertuigId = v.Id
    -- Koppel naar het type voertuig voor de rijbewijscategorie
    INNER JOIN TypeVoertuig tv ON v.TypeVoertuigId = tv.Id
    WHERE i.Id = p_InstructeurId;
END $$

DELIMITER ;