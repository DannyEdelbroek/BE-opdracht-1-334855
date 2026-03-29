USE jamin;
DROP PROCEDURE IF EXISTS sp_deleteProduct;

DELIMITER $$

CREATE PROCEDURE sp_deleteProduct(
    IN p_id INT UNSIGNED
)
BEGIN
    DECLARE v_count INT;

    -- Tel alle actieve leveringen waarvan datum levering < einddatum
    SELECT COUNT(*)
    INTO v_count
    FROM ProductPerLeverancier ppl
    JOIN ProductEinddatumLevering pel
      ON ppl.ProductId = pel.ProductId
    WHERE ppl.ProductId = p_id
      AND ppl.IsActief = 1
      AND pel.IsActief = 1
      AND ppl.DatumLevering < pel.EinddatumLevering;

    IF v_count > 0 THEN
        -- Er zijn nog leveringen voor dit product die nog niet voorbij de einddatum zijn
        SELECT 0 AS success, 
               'Product kan niet worden verwijderd, er zijn nog leveringen vóór de einddatum.' AS message;
    ELSE
        -- Verwijder het product en gerelateerde gegevens
        DELETE FROM ProductPerLeverancier WHERE ProductId = p_id;
        DELETE FROM ProductPerAllergeen WHERE ProductId = p_id;
        DELETE FROM ProductEinddatumLevering WHERE ProductId = p_id;
        DELETE FROM Magazijn WHERE ProductId = p_id;
        DELETE FROM Product WHERE Id = p_id;

        SELECT 1 AS success, 'Product succesvol verwijderd.' AS message;
    END IF;
END $$

DELIMITER ;