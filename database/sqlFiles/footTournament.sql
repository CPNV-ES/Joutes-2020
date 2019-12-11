SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';
SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- ========================================== Data ==============================================

--
--  Insert Data in events
--

INSERT INTO events(name) VALUES ('Tournoi d''été 2017');

--
--  Insert Data in sports
--

INSERT INTO sports(name, description) VALUES ('Football', 'Equipes de 6');

--
--  Insert Data in courts
--

INSERT INTO courts(name, sport_id) VALUES ('Terrain A', 1),('Terrain B', 1);

--
--  Insert Data in tournaments
--

INSERT INTO tournaments(name, start_date, event_id, sport_id) VALUES ('Tournoi de Foot', '2017-06-11', 1, 1);

--
--  Insert Data in game_types
--

INSERT INTO game_types(game_type_description) values ('Match de 12 minutes'), ('2x10 minutes');

--
--  Insert Data in pool_modes
--

INSERT INTO pool_modes(mode_description,planningAlgorithm) values ('Matches simples',1),('Aller-retour',2),('Elimination directe',3),('Finale de classement',4);

--
--  Insert Data in participants
--

INSERT INTO participants(first_name,last_name) VALUES ("Ahmed","Casey"),("Chester","Day"),("Riley","Garrison"),("Duncan","Roy"),("Remedios","Black"),("Mark","Molina"),("Dana","Justice"),("Linus","Leon"),("Cairo","Farmer"),("Nyssa","Gallagher");
INSERT INTO participants(first_name,last_name) VALUES ("Allegra","Waller"),("Emery","Copeland"),("Illana","Mcgowan"),("Magee","Bauer"),("Patricia","Briggs"),("Samuel","Meyers"),("Nelle","Holcomb"),("Shay","David"),("Kai","Quinn"),("Brendan","Macdonald");
INSERT INTO participants(first_name,last_name) VALUES ("Justin","Jones"),("Erich","Shepherd"),("Joseph","Compton"),("Moses","Pope"),("Hedley","Thornton"),("Deborah","Wells"),("Kay","Ortega"),("Dorothy","Johnston"),("Irene","Alston"),("Doris","Baird");
INSERT INTO participants(first_name,last_name) VALUES ("Zorita","Ellis"),("Yen","Hale"),("Madison","Marshall"),("Angela","Perry"),("Michael","Woodard"),("Karyn","Riddle"),("Carol","Lang"),("Malik","Padilla"),("Maxine","Rowland"),("Halee","Larson");
INSERT INTO participants(first_name,last_name) VALUES ("Tatyana","Rosario"),("Latifah","Jenkins"),("Wynne","Rowland"),("Nola","Adkins"),("Nicole","Wilkerson"),("Sybil","Murray"),("Cadman","Evans"),("Xenos","Kramer"),("Illana","Riley"),("Evan","Logan");
INSERT INTO participants(first_name,last_name) VALUES ("Risa","Fuller"),("Jenette","Alvarado"),("Colorado","Moss"),("Bree","Velazquez"),("Madonna","Preston"),("Daria","Pearson"),("Uta","Hensley"),("Paul","Lambert"),("Declan","Ramirez"),("Davis","Mcleod");
INSERT INTO participants(first_name,last_name) VALUES ("Wanda","Sears"),("Melvin","Bowen"),("Lareina","Forbes"),("Dane","Holland"),("Norman","Mcleod"),("Blythe","Cruz"),("Jayme","Gill"),("Adele","Warren"),("Candace","Valenzuela"),("Judith","Blake");
INSERT INTO participants(first_name,last_name) VALUES ("Chaim","Forbes"),("Prescott","Franco"),("Forrest","Green"),("Marshall","Forbes"),("Jordan","Webster"),("Caesar","Vazquez"),("Drake","Craig"),("Armand","Farmer"),("Joel","Dillard"),("Robert","Talley");
INSERT INTO participants(first_name,last_name) VALUES ("Gil","Sloan"),("Stone","Maxwell"),("Rashad","Brady"),("Raja","Vega"),("Benedict","Underwood"),("Griffith","Hahn"),("Steven","Montoya"),("Tyrone","Delgado"),("Chandler","Curtis"),("Baker","Jefferson");
INSERT INTO participants(first_name,last_name) VALUES ("Wylie","Waller"),("Michael","Waters"),("Brian","Morin"),("Barrett","Donaldson"),("Jakeem","Munoz"),("Sawyer","Manning"),("Chadwick","Collins"),("Galvin","Gutierrez"),("Gregory","Fletcher"),("Lucius","Woodard");
INSERT INTO participants(first_name,last_name) VALUES ("Rogan","Blackwell"),("Kennedy","Preston"),("Hu","Hester"),("Phelan","Ruiz"),("Tanner","Mccarty"),("Dalton","Glover"),("Berk","Mcdonald"),("Wing","Moran"),("Axel","Perkins"),("Hamish","Adkins");
INSERT INTO participants(first_name,last_name) VALUES ("Giacomo","Talley"),("Marshall","Tillman"),("Ira","Wilkinson"),("Henry","Shaw"),("Chancellor","Colon"),("Cruz","Ayers"),("Xander","Melton"),("Bevis","Oneill"),("Rashad","Marsh"),("Len","Francis");
INSERT INTO participants(first_name,last_name) VALUES ("Aristotle","Carver"),("Nathaniel","Estrada"),("Dominic","Padilla"),("Tucker","Clemons"),("Rashad","Bryan"),("Amir","Bender"),("Griffin","Alexander"),("Leonard","Moran"),("Macon","Jennings"),("Camden","Blackwell");
INSERT INTO participants(first_name,last_name) VALUES ("Bevis","Stevens"),("Ignatius","Mason"),("Marshall","Byers"),("Norman","Jennings"),("Dane","Howe"),("Amery","Moses"),("Acton","Dotson"),("Igor","Day"),("Harlan","Dennis"),("Lamar","Ruiz");
INSERT INTO participants(first_name,last_name) VALUES ("Derek","Hamilton"),("Randall","Waller"),("Rahim","Briggs"),("Harding","Gonzales"),("Alvin","Giles"),("Rooney","Weber"),("Randall","Wheeler"),("Grant","Rodriguez"),("Herman","Newton"),("Colton","Alvarado");
INSERT INTO participants(first_name,last_name) VALUES ("Simon","Sharp"),("Hop","Lowe"),("Rooney","Brewer"),("Kirk","Calhoun"),("Michael","Sharp"),("Peter","Martin"),("Gregory","Brewer"),("Hunter","Guzman"),("Cedric","Chan"),("Dexter","Reynolds");
INSERT INTO participants(first_name,last_name) VALUES ("Giacomo","Roman"),("Raphael","Foster"),("Ronan","Jennings"),("Keegan","Garner"),("Asher","Wagner"),("Cain","Mueller"),("Burke","Parsons"),("Chaim","Holloway"),("Jonah","Mcguire"),("Bert","Burks");


--
--  Insert Data in teams
--

INSERT INTO teams(name,tournament_id) VALUES ('Barcelone',1);
INSERT INTO teams(name,tournament_id) VALUES ('AC Milan',1);
INSERT INTO teams(name,tournament_id) VALUES ('Ajax Amstersam',1);
INSERT INTO teams(name,tournament_id) VALUES ('Olympique de Marseille',1);
INSERT INTO teams(name,tournament_id) VALUES ('Lausanne-Sports',1);
INSERT INTO teams(name,tournament_id) VALUES ('Dortmund',1);
INSERT INTO teams(name,tournament_id) VALUES ('Chelsea',1);
INSERT INTO teams(name,tournament_id) VALUES ('Galatasaray',1);
INSERT INTO teams(name,tournament_id) VALUES ('Real Madrid',1);
INSERT INTO teams(name,tournament_id) VALUES ('Juventus',1);
INSERT INTO teams(name,tournament_id) VALUES ('FC Rotterdam',1);
INSERT INTO teams(name,tournament_id) VALUES ('PSG',1);
INSERT INTO teams(name,tournament_id) VALUES ('FC Sion',1);
INSERT INTO teams(name,tournament_id) VALUES ('Bayern Münich',1);
INSERT INTO teams(name,tournament_id) VALUES ('Liverpool',1);
INSERT INTO teams(name,tournament_id) VALUES ('FC Göteborg',1);
INSERT INTO teams(name,tournament_id) VALUES ('FC Bruges',1);
INSERT INTO teams(name,tournament_id) VALUES ('Shatkar Donetsk',1);
INSERT INTO teams(name,tournament_id) VALUES ('FC Sainte-Croix',1);

--
--  Insert Data in participant_team
--

INSERT INTO participant_team(participant_id, team_id, isCaptain) select id, id%19+1, (id%19=0) from participants limit 114;

--
--  Insert Data in contenders
--

-- ================= stage 1 =====================

-- Four random pools
INSERT INTO pools (tournament_id, start_time, end_time, poolName, mode_id, game_type_id, poolSize, stage, isFinished)
VALUES
  (1, '08:00', '12:00', 'A', 2, 1, 4, 1, 0), (1, '08:00', '12:00', 'B', 2, 1, 5, 1, 0),
  (1, '08:00', '12:00', 'C', 2, 1, 5, 1, 0), (1, '08:00', '12:00', 'D', 2, 1, 5, 1, 0);

-- contenders are automatic
INSERT INTO contenders(pool_id,team_id) select id%4+1,id FROM teams;

-- ================= stage 2 =====================

-- Four pools by level
INSERT INTO pools (tournament_id, start_time, end_time, poolName, mode_id, game_type_id, poolSize, stage, isFinished)
VALUES
  (1, '13:30', '15:30', 'Poule A, Niveau 1', 1, 1, 5, 2, 0), (1, '13:30', '15:30', 'Poule B, Niveau 1', 1, 1, 5, 2, 0),
  (1, '13:30', '15:30', 'Poule A, Niveau 2', 1, 1, 5, 2, 0), (1, '13:30', '15:30', 'Poule B, Niveau 2', 1, 1, 4, 2, 0);

INSERT INTO contenders (pool_id, rank_in_pool, pool_from_id)
VALUES
  (5, 1, 1),
  (5, 2, 2),
  (5, 1, 3),
  (5, 2, 4),
  (5, 1, 2),
  (6, 2, 3),
  (6, 1, 4),
  (6, 2, 1),
  (6, 3, 1),
  (6, 3, 2),
  (7, 4, 2),
  (7, 4, 4),
  (7, 3, 3),
  (7, 4, 1),
  (7, 3, 4),
  (8, 4, 3),
  (8, 5, 2),
  (8, 5, 3),
  (8, 5, 4);

-- ================= stage 3 =====================

-- finals
INSERT INTO pools (tournament_id, start_time, end_time, poolName, mode_id, game_type_id, poolSize, stage, isFinished)
VALUES
  (1, '16:00', '16:30', 'Finale 17-18', 4, 2, 2, 3, 0),
  (1, '16:00', '16:30', 'Finale 15-16', 4, 2, 2, 3, 0),
  (1, '16:30', '17:00', 'Finale 13-14', 4, 2, 2, 3, 0),
  (1, '16:30', '17:00', 'Finale 11-12', 4, 2, 2, 3, 0),
  (1, '17:00', '17:30', 'Finale 9-10', 4, 2, 2, 3, 0),
  (1, '17:00', '17:30', 'Finale 7-8', 4, 2, 2, 3, 0),
  (1, '17:30', '18:00', 'Finale 5-6', 4, 2, 2, 3, 0),
  (1, '17:30', '18:00', 'Finale 3-4', 4, 2, 2, 3, 0),
  (1, '18:00', '18:30', 'Finale 1-2', 4, 2, 2, 3, 0);

INSERT INTO contenders (pool_id, rank_in_pool, pool_from_id)
VALUES
  (9, 4, 7),
  (9, 4, 8),
  (10, 3, 7),
  (10, 3, 8),
  (11, 2, 7),
  (11, 2, 8),
  (12, 1, 7),
  (12, 1, 8),
  (13, 5, 5),
  (13, 5, 6),
  (14, 4, 5),
  (14, 4, 6),
  (15, 3, 5),
  (15, 3, 6),
  (16, 2, 5),
  (16, 2, 6),
  (17, 1, 5),
  (17, 1, 6);

-- Summary
SELECT
  pools.id,
  stage,
  start_time,
  poolName,
  poolSize,
  mode_description,
  game_type_description,
  team_id,
  rank_in_pool,
  pool_from_id
FROM pools
  INNER JOIN contenders ON pools.id = contenders.pool_id
  INNER JOIN pool_modes ON pools.mode_id = pool_modes.id
  INNER JOIN game_types ON pools.game_type_id = game_types.id