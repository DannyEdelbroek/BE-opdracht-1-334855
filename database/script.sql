use BEverkantewielen;

-- drop relaties if they exist to prevent errors when running the script multiple times

drop table if exists VoertuigInstructeur;
drop table if exists Voertuig;
drop table if exists Instructeur;
drop table if exists TypeVoertuig;

-- create voertuig relaties

create table TypeVoertuig(
	Id int unsigned auto_increment primary key,
    TypeVoertuig varchar(50) not null,
    RijbewijsCategorie char(3) not null,
    Isactief bit not null default 1,
    Opmerking varchar(255) null,
    DatumAangemaakt datetime(6) not null default now(6),
    DatumGewijziged datetime(6) not null default now(6)
) ENGINE=InnoDB;

-- insert type voertuig relaties

insert into TypeVoertuig (TypeVoertuig, RijbewijsCategorie) values
	('Personenauto', 'B'),
    ('Vrachtwagen', 'C'),
    ('Bus', 'D'),
    ('Bromfiets', 'AM');

-- create instructeur relaties

create table Instructeur(
	Id int unsigned auto_increment primary key,
    Voornaam varchar(100) not null,
    Tussenvoegsel varchar(20) null,
    Achternaam varchar(100) not null,
    Mobiel varchar(15) not null,
    DatumInDienst date not null,
    AantalSterren tinyint unsigned,	 
    Isactief bit not null default 1,
    Opmerking varchar(255) null,
    DatumAangemaakt datetime(6) default now(6),
    DatumGewijziged datetime(6) default now(6)
)ENGINE=InnoDB;

-- insert instructeur relaties

insert into Instructeur (Voornaam, Tussenvoegsel, Achternaam, Mobiel, DatumInDienst, AantalSterren, Isactief) values
	('Li', null, 'Zhan', '06-28493827', '2015-04-17', 3, 1),
    ('Leroy', null, 'Boerhaven', '06-39398734', '2018-06-25', 1, 1),
    ('Yoeri', 'Van', 'Veen', '06-24383291', '2010-05-12', 3, 1),
    ('Bert', 'Van', 'Sali', '06-48293823', '2023-01-10', 4, 1),
    ('Mohammed', 'El', 'Yassidi', '06-34291234', '2010-06-14', 5, 0);

-- create voertuig relaties

create table Voertuig(
	Id int unsigned auto_increment primary key,
    Kenteken varchar(10) not null,
    `Type` varchar(50) not null,
    Bouwjaar date not null,
    Brandstof varchar(20),
    TypeVoertuigId int unsigned not null,
    Isactief bit not null,
    Opmerking varchar(255) null,
    DatumAangemaakt datetime(6) default now(6),
    DatumGewijziged datetime(6) default now(6),
    
    FOREIGN KEY (TypeVoertuigId) REFERENCES TypeVoertuig(Id)
)ENGINE=InnoDB;

-- insert voertuig relaties

INSERT INTO Voertuig (Kenteken, `Type`, Bouwjaar, Brandstof, TypeVoertuigId, Isactief) VALUES
('AU-67-IO', 'Golf', '2017-06-12', 'Diesel', 1, 1),
('TR-24-OP', 'DAF', '2019-05-23', 'Diesel', 2, 1),
('TH-78-KL', 'Mercedes', '2023-01-01', 'Benzine', 1, 1),
('90-KL-TR', 'Fiat 500', '2021-09-12', 'Benzine', 1, 0),
('34-TK-LP', 'Scania', '2015-03-13', 'Diesel', 2, 0),
('YY-OP-78', 'BMW M5', '2022-05-13', 'Diesel', 1, 0),
('UU-HH-JK', 'M.A.N', '2017-12-03', 'Diesel', 2, 0),
('ST-FZ-28', 'Citroën', '2018-01-20', 'Elektrisch', 1, 1),
('123-FR-T', 'Piaggio ZIP', '2021-02-01', 'Benzine', 4, 1),
('DRS-52-P', 'Vespa', '2022-03-21', 'Benzine', 4, 1),
('STP-12-U', 'Kymco', '2022-07-02', 'Benzine', 4, 0),
('45-SD-23', 'Renault', '2023-01-01', 'Diesel', 3, 1);

-- create voertuig-instructeur relaties

create table VoertuigInstructeur(
	Id int unsigned auto_increment primary key,
    VoertuigId int unsigned,
    InstructeurId int unsigned,
    DatumToekenning date not null,
    Isactief bit not null default 1,
    Opmerking varchar(255) null,
    DatumAangemaakt datetime(6) default now(6),
    DatumGewijziged datetime(6) default now(6),
    
    FOREIGN KEY (VoertuigId) REFERENCES Voertuig(Id),
    FOREIGN KEY (InstructeurId) REFERENCES Instructeur(Id)
)ENGINE=InnoDB;

-- insert voertuig-instructeur relaties

insert into VoertuigInstructeur (VoertuigId, InstructeurId, DatumToekenning, Isactief) values
	(1, 5, '2017-06-18', 1),
    (3, 1, '2021-09-26', 1),
    (9, 1, '2021-09-27', 1),
    (4, 4, '2022-08-01', 1),
    (5, 1, '2019-08-30', 1),
    (6, 5, '2020-02-02', 1);