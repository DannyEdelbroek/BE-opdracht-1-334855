USE jamin;

DROP PROCEDURE IF EXISTS sp_GetAllProducts;

DELIMITER $$

CREATE PROCEDURE sp_GetAllProducts()
BEGIN
    SELECT 
         PROD.Id                  AS Id,
         PROD.Naam                AS Naam,
         PROD.Barcode             AS Barcode,
         TRIM(TRAILING '.00' FROM FORMAT(MAGA.VerpakkingsEenheid, 1)) AS VerpakkingsEenheid,
         MAGA.AantalAanwezig      AS AantalAanwezig
    FROM Product AS PROD
    INNER JOIN Magazijn AS MAGA 
        ON PROD.Id = MAGA.ProductId
    ORDER BY PROD.Barcode ASC;
END $$

DELIMITER ;