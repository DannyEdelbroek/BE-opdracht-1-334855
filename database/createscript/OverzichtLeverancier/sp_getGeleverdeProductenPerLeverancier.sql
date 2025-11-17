USE jamin;

DELIMITER $$

DROP PROCEDURE IF EXISTS sp_getGeleverdeProductenPerLeverancier $$

CREATE PROCEDURE sp_getGeleverdeProductenPerLeverancier(
    IN l_LeverancierId SMALLINT
)
BEGIN
    SELECT 
        L.Id AS leverancierId,
        L.Naam AS LeverancierNaam,
        L.ContactPersoon,
        L.LeverancierNummer,
        L.Mobiel,
        P.Id AS ProductId,
        P.Naam AS ProductNaam,

        M.AantalAanwezig AS AantalInMagazijn,
        TRIM(TRAILING '.00' FROM M.VerpakkingsEenheid) AS VerpakkingsEenheid,

        DATE_FORMAT(MAX(PPL.DatumLevering), '%d-%m-%Y') AS LaatsteLevering
    FROM Leverancier AS L
    INNER JOIN ProductPerLeverancier AS PPL ON L.Id = PPL.LeverancierId
    INNER JOIN Product AS P ON P.Id = PPL.ProductId
    INNER JOIN Magazijn AS M ON M.ProductId = P.Id
    WHERE L.Id = l_LeverancierId
    GROUP BY 
        L.Naam, L.ContactPersoon, L.LeverancierNummer, L.Mobiel,
        P.Id, P.Naam,
        M.AantalAanwezig, M.VerpakkingsEenheid
    ORDER BY M.AantalAanwezig DESC;
END $$

DELIMITER ;

