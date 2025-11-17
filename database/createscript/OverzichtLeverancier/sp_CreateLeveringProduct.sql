USE jamin;

DELIMITER $$

DROP PROCEDURE IF EXISTS sp_CreateLeveringProduct $$

CREATE PROCEDURE sp_CreateLeveringProduct(
    IN p_LeverancierId INT,
    IN p_ProductId INT,
    IN p_Aantal INT,
    IN p_DatumEerstVolgendeLevering DATE
)
BEGIN
    -- Insert de levering
    INSERT INTO ProductPerLeverancier
        (LeverancierId, ProductId, DatumLevering, Aantal, DatumEerstVolgendeLevering)
    VALUES
        (p_LeverancierId, p_ProductId, p_DatumLevering, p_Aantal, p_DatumEerstVolgendeLevering);

    -- Update voorraad in Magazijn
    UPDATE Magazijn
    SET AantalAanwezig = AantalAanwezig + p_Aantal
    WHERE ProductId = p_ProductId;

    -- Geef terug welke ID is ingevoegd
    SELECT LAST_INSERT_ID() AS new_id;
END$$

DELIMITER ;
