    USE jamin;

    DROP PROCEDURE IF EXISTS sp_GetLeveringsInformatie;

    DELIMITER $$

    CREATE PROCEDURE sp_GetLeveringsInformatie(
        IN p_ProductNaam VARCHAR(50)
    )
    BEGIN
        SELECT 
            L.Naam AS NaamLeverancier,
            L.ContactPersoon AS ContactpersoonLeverancier,
            L.LeverancierNummer,
            L.Mobiel,
            P.Naam AS NaamProduct,
            PPL.DatumLevering AS DatumLaatsteLevering,
            PPL.Aantal,
            M.AantalAanwezig,
            PPL.DatumEerstVolgendeLevering AS EerstvolgendeLevering
        FROM Product P
        LEFT JOIN ProductPerLeverancier PPL ON P.Id = PPL.ProductId
        LEFT JOIN Leverancier L ON PPL.LeverancierId = L.Id
        LEFT JOIN Magazijn M ON P.Id = M.ProductId
        WHERE P.Naam = p_ProductNaam
        ORDER BY PPL.DatumLevering ASC;
    END $$

    DELIMITER ;