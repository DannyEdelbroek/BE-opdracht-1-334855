USE jamin;

DROP PROCEDURE IF EXISTS sp_GetAllProductsLeverancierOverview;
DELIMITER $$

CREATE PROCEDURE sp_GetAllProductsLeverancierOverview(
    IN PageNumber INT,
    IN PageSize INT,
    IN p_startdatum DATE,
    IN p_einddatum DATE
)
BEGIN
    DECLARE offsetRows INT;
    SET offsetRows = (PageNumber - 1) * PageSize;

    SELECT
        l.Id AS LeverancierId,
        l.Naam AS LeverancierNaam,
        l.ContactPersoon,
        c.Stad,
        p.Naam AS ProductNaam,
        pel.EinddatumLevering
    FROM ProductPerLeverancier pp
    INNER JOIN Leverancier l ON pp.LeverancierId = l.Id
    INNER JOIN Product p ON pp.ProductId = p.Id
    LEFT JOIN ProductPerAllergeen ppa ON p.Id = ppa.ProductId
    LEFT JOIN Allergeen a ON ppa.AllergeenId = a.Id
    LEFT JOIN Contact c ON c.Id = l.ContactId
    INNER JOIN ProductEinddatumLevering pel ON pel.ProductId = p.Id
    WHERE (p_startdatum IS NULL OR pp.DatumLevering >= p_startdatum)
        AND (p_einddatum IS NULL OR pp.DatumLevering <= p_einddatum)
    GROUP BY l.Naam, l.ContactPersoon, p.Naam, pel.EinddatumLevering
    ORDER BY l.Naam, p.Naam
    LIMIT offsetRows, PageSize;
END $$

DELIMITER ;