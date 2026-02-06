USE jamin;

DROP PROCEDURE IF EXISTS sp_getContactId;

DELIMITER $$

CREATE PROCEDURE sp_getContactId(
    IN p_ContactId INT
)
BEGIN
    SELECT 
        L.Id AS LeverancierId,
        C.Id AS ContactId,
        L.Naam,
        L.ContactPersoon,
        L.LeverancierNummer,
        L.Mobiel,
        C.Straat,
        C.Huisnummer,
        C.Postcode,
        C.Stad
    FROM Leverancier AS L
    INNER JOIN Contact AS C 
        ON C.Id = L.ContactId
    WHERE L.ContactId = p_ContactId;
END $$

DELIMITER ;

