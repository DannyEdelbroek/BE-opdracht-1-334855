USE jamin;

DELIMITER $$

DROP PROCEDURE IF EXISTS sp_GetProductId $$

CREATE PROCEDURE sp_GetProductId(
    IN p_LeverancierId INT
)
BEGIN
    SELECT
        L.Naam AS LeverancierNaam,
        P.Naam AS ProductNaam,
        GROUP_CONCAT(A.Naam SEPARATOR ', ') AS Allergenen,
        PP.DatumLevering,
        PP.Aantal
    FROM Leverancier L
    INNER JOIN ProductPerLeverancier PP ON PP.LeverancierId = L.Id
    INNER JOIN Product P ON P.Id = PP.ProductId
    LEFT JOIN ProductPerAllergeen PPA ON PPA.ProductId = P.Id
    LEFT JOIN Allergeen A ON A.Id = PPA.AllergeenId
    WHERE L.Id = p_LeverancierId
    GROUP BY
        PP.DatumLevering,
        PP.Aantal,
        P.Naam,
        L.Naam
    ORDER BY PP.DatumLevering DESC;

END $$

DELIMITER ;