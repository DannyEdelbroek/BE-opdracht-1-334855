USE jamin;

DROP PROCEDURE IF EXISTS sp_getOverzichtLeverancie;

DELIMITER $$

CREATE PROCEDURE sp_getOverzichtLeverancie()
BEGIN
    SELECT 
        LEV.Id AS Id,
        LEV.Naam AS Naam,
        LEV.ContactPersoon AS ContactPersoon,
        LEV.LeverancierNummer AS LeverancierNummer,
        LEV.Mobiel AS Mobiel,
        COUNT(DISTINCT PPL.ProductId) AS AantalVerschillendeProducten
    FROM Leverancier AS LEV
    LEFT JOIN ProductPerLeverancier AS PPL
        ON LEV.Id = PPL.LeverancierId
    GROUP BY 
        LEV.Id, LEV.Naam, LEV.ContactPersoon, LEV.LeverancierNummer, LEV.Mobiel
    ORDER BY AantalVerschillendeProducten DESC;
END $$
DELIMITER ;