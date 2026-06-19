USE BEverkantewielen;

DELIMITER //

DROP PROCEDURE IF EXISTS `ToggleInstructeurStatus` //

CREATE PROCEDURE ToggleInstructeurStatus(
    IN instructeur_id INT UNSIGNED
)
BEGIN
    -- 1. Controleer eerst of de instructeur bestaat
    IF EXISTS (SELECT 1 FROM Instructeur WHERE Id = instructeur_id) THEN
        
        -- 2. Schakel de status van de instructeur om (Toggle: 1 -> 0 of 0 -> 1)
        UPDATE Instructeur 
        SET Isactief = NOT Isactief 
        WHERE Id = instructeur_id;

        -- 3. Zet alle gekoppelde voertuigen ALTIJD gelijk aan de nieuwe status van de instructeur.
        -- Als de instructeur wordt uitgezet (0), gaan alle voertuigen mee naar (0).
        -- Als de instructeur weer wordt aangezet (1), gaan alle voertuigen mee terug naar (1).
        UPDATE VoertuigInstructeur
        SET Isactief = (SELECT Isactief FROM Instructeur WHERE Id = instructeur_id)
        WHERE InstructeurId = instructeur_id;

    ELSE
        -- Gooi een foutmelding als de instructeur niet bestaat
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Instructeur niet gevonden';
    END IF;
END //

DELIMITER ;