USE jamin;

DELIMITER $$

DROP PROCEDURE IF EXISTS sp_getLeveringProdcuct$$

CREATE PROCEDURE sp_getLeveringProdcuct(
    IN p_ProductNaam VARCHAR(255)
)
BEGIN
    SELECT  
        L.Naam AS LeverancierNaam,
        L.ContactPersoon,
        L.LeverancierNummer,
        L.Mobiel,
        P.Naam AS ProductNaam
    FROM Product AS P
    INNER JOIN ProductPerLeverancier AS PP ON P.Id = PP.ProductId
    INNER JOIN Leverancier AS L ON L.Id = PP.LeverancierId
    WHERE P.Naam = p_ProductNaam;
END $$