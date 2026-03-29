USE jamin;

DELIMITER $$

DROP PROCEDURE IF EXISTS sp_GetIdProductsLeverancier $$

CREATE PROCEDURE sp_GetIdProductsLeverancier(
    IN p_ProductId INT
)
BEGIN
    SELECT
    p.Id,
    p.Naam,
    p.Barcode,

    CASE 
        WHEN SUM(CASE WHEN a.Naam = 'Gluten' THEN 1 ELSE 0 END) > 0 
        THEN 'Ja' ELSE 'Nee' 
    END AS BevatGluten,

    CASE 
        WHEN SUM(CASE WHEN a.Naam = 'Gelatine' THEN 1 ELSE 0 END) > 0 
        THEN 'Ja' ELSE 'Nee' 
    END AS BevatGelatine,

    CASE 
        WHEN SUM(CASE WHEN a.Naam = 'AZO-kleurstof' THEN 1 ELSE 0 END) > 0 
        THEN 'Ja' ELSE 'Nee' 
    END AS BevatAZO,

    CASE 
        WHEN SUM(CASE WHEN a.Naam = 'Lactose' THEN 1 ELSE 0 END) > 0 
        THEN 'Ja' ELSE 'Nee' 
    END AS BevatLactose,

    CASE 
        WHEN SUM(CASE WHEN a.Naam = 'Soja' THEN 1 ELSE 0 END) > 0 
        THEN 'Ja' ELSE 'Nee' 
    END AS BevatSoja

FROM Product p
LEFT JOIN ProductPerAllergeen ppa ON p.Id = ppa.ProductId
LEFT JOIN Allergeen a ON ppa.AllergeenId = a.Id
WHERE p.Id = :id
GROUP BY p.Id;
END $$

DELIMITER ;
