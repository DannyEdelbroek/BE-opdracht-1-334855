-- Step: 01
-- Goal: Create a new database jamin
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            04-04-2023      Danny           New
-- **********************************************************************************/

-- Check if the database exists
DROP DATABASE IF EXISTS `jamin`;

-- Create a new Database
CREATE DATABASE IF NOT EXISTS `jamin`;

-- Use database jamin
Use `jamin`;


-- Step: 02
-- Goal: Create a new table Allergeen
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            12-09-2025      Danny                       New
-- **********************************************************************************/

-- Drop table Instructeur
DROP TABLE IF EXISTS Allergeen;

CREATE TABLE IF NOT EXISTS Allergeen
(
    Id              SMALLINT         UNSIGNED       NOT NULL    AUTO_INCREMENT
   ,naam            VARCHAR(30)                     NOT NULL
   ,Omschrijving    VARCHAR(100)                    NOT NULL
   ,IsActief        BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen     VARCHAR(250)                        NULL    DEFAULT NULL
   ,DatumAangemaakt DateTime(6)                     NOT NULL
   ,DatumGewijzigd  DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_Allergeen_Id   PRIMARY KEY CLUSTERED(Id)
) ENGINE=InnoDB;


-- Step: 03
-- Goal: Fill table Instructeur with data
-- **********************************************************************************

-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            12-09-2025      Danny                       New
-- **********************************************************************************/

INSERT INTO Allergeen
(
     naam
    ,Omschrijving
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
     ('Gluten', '', 'Dit product bevat gluten', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Gelatine', '', 'Dit product bevat gelatine', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Noten', '', 'Dit product bevat AZO-kleurstoffen', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Gluten', '', 'Dit product bevat lactose', 1, NULL, SYSDATE  (6), SYSDATE(6))
    ,('Lactose', '', 'Dit product bevat soja
Dit product bevat soja
', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Schaaldieren', '', 'Schaaldieren', 1, NULL   , SYSDATE(6), SYSDATE(6))



-- Step: 04
-- Goal: Create a new table TypeVoertuig
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            04-04-2023      Arjan de Ruijter            New
-- **********************************************************************************/

-- Drop table TypeVoertuig
DROP TABLE IF EXISTS TypeVoertuig;

CREATE TABLE IF NOT EXISTS TypeVoertuig
(
    Id                  TINYINT         UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,TypeVoertuig        VARCHAR(20)                     NOT NULL
   ,Rijbewijscategorie  VARCHAR(5)                      NOT NULL
   ,IsActief            BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen         VARCHAR(250)                        NULL    DEFAULT NULL
   ,DatumAangemaakt     DateTime(6)                     NOT NULL
   ,DatumGewijzigd      DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_TypeVoertuig_Id   PRIMARY KEY CLUSTERED(Id)
) ENGINE=InnoDB;


-- Step: 05
-- Goal: Fill table TypeVoertuig with data
-- **********************************************************************************

-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            04-04-2023      Arjan de Ruijter            New
-- **********************************************************************************/

INSERT INTO TypeVoertuig
(
     TypeVoertuig
    ,Rijbewijscategorie
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
     ('Personenauto', 'B', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Vrachtwagen', 'C', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Bus', 'D', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Bromfiets', 'AM', 1, NULL, SYSDATE(6), SYSDATE(6));



-- Step: 06
-- Goal: Create a new table Voertuig
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            04-04-2023      Arjan de Ruijter            New
-- **********************************************************************************/

-- Drop table Voertuig
DROP TABLE IF EXISTS Voertuig;

CREATE TABLE IF NOT EXISTS Voertuig
(
    Id                  TINYINT         UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,Kenteken            VARCHAR(12)                     NOT NULL
   ,Type                VARCHAR(20)                     NOT NULL
   ,Bouwjaar            DATE                            NOT NULL
   ,Brandstof           VARCHAR(20)                     NOT NULL  
   ,TypeVoertuigId      TINYINT         UNSIGNED        NOT NULL  
   ,IsActief            BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen         VARCHAR(250)                        NULL    DEFAULT NULL
   ,DatumAangemaakt     DateTime(6)                     NOT NULL
   ,DatumGewijzigd      DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_Voertuig_Id   PRIMARY KEY CLUSTERED(Id)
   ,CONSTRAINT      FK_Voertuig_TypeVoertuigId_TypeVoertuig_Id  FOREIGN KEY (TypeVoertuigId) REFERENCES TypeVoertuig(Id)
) ENGINE=InnoDB;


-- Step: 07
-- Goal: Fill table Voertuig with data
-- **********************************************************************************

-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            04-04-2023      Arjan de Ruijter            New
-- **********************************************************************************/

INSERT INTO Voertuig
(
     Kenteken
    ,Type
    ,Bouwjaar
    ,Brandstof
    ,TypeVoertuigId
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
     ('AU-67-IO', 'Golf', '2017-06-12', 'Diesel', 1, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('TR-24-OP', 'DAF', '2019-05-23', 'Diesel', 2, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('TH-78-KL', 'Mercedes', '2023-01-01', 'Benzine', 1, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('90-KL-TR', 'Fiat 500', '2021-09-12', 'Benzine', 1, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('34-TK-LP', 'Scania', '2015-03-13', 'Diesel', 2, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('YY-OP-78', 'BMW M5', '2022-05-13', 'Diesel', 1, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('UU-HH-JK', 'M.A.N', '2017-12-03', 'Diesel', 2, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('ST-FZ-28', 'Citroën', '2018-01-20', 'Elektrisch', 1, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('123-FR-T', 'Piaggio ZIP', '2021-02-01', 'Benzine', 4, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('DRS-52-P', 'Vespa', '2022-03-21', 'Benzine', 4, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('STP-12-U', 'Vespa', '2022-07-02', 'Benzine', 4, 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('45-SD-23', 'Renault', '2023-01-01', 'Diesel', 3, 1, NULL, SYSDATE(6), SYSDATE(6));



-- Step: 08
-- Goal: Create a new table VoertuigInstructeur
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            04-04-2023      Arjan de Ruijter            New
-- **********************************************************************************/

-- Drop table VoertuigInstructeur
DROP TABLE IF EXISTS VoertuigInstructeur;

CREATE TABLE IF NOT EXISTS VoertuigInstructeur
(
    Id                  TINYINT         UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,VoertuigId          TINYINT         UNSIGNED        NOT NULL
   ,InstructeurId       TINYINT         UNSIGNED        NOT NULL
   ,DatumToekenning     DATE                            NOT NULL
   ,IsActief            BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen         VARCHAR(250)                        NULL    DEFAULT NULL
   ,DatumAangemaakt     DateTime(6)                     NOT NULL
   ,DatumGewijzigd      DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_VoertuigInstructeur_Id   PRIMARY KEY CLUSTERED(Id)
   ,CONSTRAINT      FK_VoertuigInstructeur_VoertuigId_Voertuig_Id  FOREIGN KEY (VoertuigId) REFERENCES Voertuig(Id)
   ,CONSTRAINT      FK_VoertuigInstructeur_InstructeurId_Instructeur_Id  FOREIGN KEY (InstructeurId) REFERENCES Instructeur(Id)
) ENGINE=InnoDB;


-- Step: 09
-- Goal: Fill table VoertuigInstructeur with data
-- **********************************************************************************

-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            04-04-2023      Arjan de Ruijter            New
-- **********************************************************************************/

INSERT INTO VoertuigInstructeur
(
     VoertuigId
    ,InstructeurId
    ,DatumToekenning
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
     (1, 5, '2017-06-18', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(3, 1, '2021-09-26', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(9, 1, '2021-09-27', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(3, 4, '2022-08-01', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(5, 1, '2019-08-30', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,(10, 5, '2020-02-02', 1, NULL, SYSDATE(6), SYSDATE(6));