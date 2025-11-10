use jamin;

DELIMITER $$

CREATE PROCEDURE sp_getGeleverdeProductenPerLeverancier(
    IN p_LeverancierId SMALLINT
)
BEGIN
    SELECT 
        L.Naam AS LeverancierNaam,
        L.ContactPersoon,
        L.LeverancierNummer,
        L.Mobiel,
        P.Naam AS ProductNaam,
        M.AantalAanwezig AS AantalInMagazijn,
        M.VerpakkingsEenheid AS VerpakkingsEenheid,
        DATE_FORMAT(MAX(PPL.DatumLevering), '%d-%m-%Y') AS LaatsteLevering
    FROM Leverancier AS L
    INNER JOIN ProductPerLeverancier AS PPL ON L.Id = PPL.LeverancierId
    INNER JOIN Product AS P ON P.Id = PPL.ProductId
    INNER JOIN Magazijn AS M ON M.ProductId = P.Id
    WHERE L.Id = p_LeverancierId
    GROUP BY 
        L.Naam, L.ContactPersoon, L.LeverancierNummer, L.Mobiel,
        P.Naam, M.AantalAanwezig, M.VerpakkingsEenheid
    ORDER BY M.AantalAanwezig DESC;
END $$

DELIMITER ;
