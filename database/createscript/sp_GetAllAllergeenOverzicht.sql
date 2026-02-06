USE jamin;

DROP PROCEDURE IF EXISTS sp_GetAllAllergeenOverzicht;
DELIMITER $$

CREATE PROCEDURE sp_GetAllAllergeenOverzicht(
    IN PageNumber INT,
    IN PageSize INT,
    IN AllergeenFilter VARCHAR(255)
)
BEGIN
    DECLARE offsetRows INT;
    SET offsetRows = (PageNumber - 1) * PageSize;

    SELECT
        a.Id AS AllergeenId,
        p.Id AS ProductId,
        p.Naam AS ProductNaam,
        a.Naam AS AllergeenNaam,
        m.AantalAanwezig,
        a.Omschrijving,
        L.Id AS LeverancierId
    FROM Product p
    INNER JOIN ProductPerAllergeen ppa ON p.Id = ppa.ProductId
    INNER JOIN Allergeen a ON a.Id = ppa.AllergeenId
    LEFT JOIN Magazijn m ON m.ProductId = p.Id
    INNER JOIN ProductPerLeverancier PPL ON PPL.ProductId = p.Id
    INNER JOIN Leverancier L ON L.Id = PPL.LeverancierId
    WHERE
        AllergeenFilter IS NULL
        OR a.Naam = AllergeenFilter
    GROUP BY p.Id, a.Id, m.AantalAanwezig, L.Id
    ORDER BY p.Naam, a.Naam ASC
    LIMIT offsetRows, PageSize;
END $$

DELIMITER ;
