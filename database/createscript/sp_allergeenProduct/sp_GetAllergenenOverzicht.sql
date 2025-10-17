USE jamin;

DROP PROCEDURE IF EXISTS sp_GetAllergenenOverzicht;
DELIMITER $$

CREATE PROCEDURE sp_GetAllergenenOverzicht(
    IN p_ProductNaam VARCHAR(100)
)
BEGIN
    /*
      Deze procedure toont:
      - Naam en barcode van het opgegeven product
      - Een overzicht van alle allergenen die daarbij horen
    */

    SELECT 
        P.Naam AS NaamProduct,
        P.Barcode,
        A.Naam AS AllergeenNaam,
        A.Omschrijving AS AllergeenOmschrijving
    FROM Product AS P
    INNER JOIN ProductPerAllergeen AS PPA ON P.Id = PPA.ProductId
    INNER JOIN Allergeen AS A ON PPA.AllergeenId = A.Id
    WHERE P.Naam = p_ProductNaam
    ORDER BY A.Naam ASC;
END $$

DELIMITER ;