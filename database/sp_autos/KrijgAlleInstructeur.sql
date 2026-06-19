USE BEverkantewielen;

DELIMITER $$

DROP PROCEDURE IF EXISTS `KrijgAlleAutos`; $$

CREATE PROCEDURE `KrijgAlleAutos`()
BEGIN
    SELECT 
        i.Id AS InstructeurID, -- In je nieuwe tabel heet de PK 'Id'
        i.Voornaam,
        i.Tussenvoegsel,
        i.Achternaam,
        i.Mobiel,
        i.DatumInDienst,
        i.AantalSterren,
        vi.VoertuigId,
        i.Isactief          -- Dit legt de connectie met het VoertuigId uit de tussentabel
    FROM Instructeur i
    -- We gebruiken een LEFT JOIN zodat instructeurs zonder auto ook getoond worden
    LEFT JOIN VoertuigInstructeur vi ON i.Id = vi.InstructeurId
    GROUP BY i.Voornaam
    ORDER BY i.AantalSterren DESC; -- Groeperen op instructeur zodat we één rij per instructeur krijgen
END $$

DELIMITER ;