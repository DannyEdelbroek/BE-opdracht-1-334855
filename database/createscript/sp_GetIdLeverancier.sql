USE jamin;

DELIMITER $$

DROP PROCEDURE IF EXISTS sp_GetIdLeverancier $$

CREATE PROCEDURE sp_GetIdLeverancier(
    IN p_LeverancierId INT
)
BEGIN
    SELECT
        L.Id,
        L.Naam AS LeverancierNaam,
        L.ContactPersoon,
        L.Mobiel,
        C.Straat,
        C.Huisnummer,
        C.Stad
    FROM Leverancier L
    LEFT JOIN Contact C ON C.Id = L.ContactId
    WHERE L.Id = p_LeverancierId;
END $$

DELIMITER ;
