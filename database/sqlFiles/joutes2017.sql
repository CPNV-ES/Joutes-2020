-- Empty the current database's tables and reset autoincrement to 1

-- SET FOREIGN_KEY_CHECKS = 0;
--
-- DELIMITER $$
-- CREATE PROCEDURE clearDb()
--   BEGIN
--     DECLARE oneTable CHAR(100);
--     DECLARE finished INT DEFAULT 0;
--     DECLARE allTables CURSOR FOR SELECT table_name
--                                  FROM information_schema.tables
--                                  WHERE table_schema = (SELECT DATABASE());
--     DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;
--     OPEN allTables;
--     get_table: LOOP
--       FETCH allTables
--       INTO oneTable;
--       IF finished = 1
--       THEN
--         LEAVE get_table;
--       END IF;
--       IF oneTable <> 'migrations'
--       THEN
--         SET @qry1 := concat('delete from ', oneTable);
--         PREPARE stmt FROM @qry1;
--         EXECUTE stmt;
--         SET @qry1 := concat('ALTER TABLE ', oneTable, ' auto_increment=1');
--         PREPARE stmt FROM @qry1;
--         EXECUTE stmt;
--       END IF;
--     END LOOP get_table;
--     CLOSE allTables;
--   END;
-- $$
-- CALL clearDb();
-- DROP PROCEDURE clearDb;
--
-- SET FOREIGN_KEY_CHECKS = 1;

-- ========================================== Data ==============================================

--
--  Insert Data in events
--

INSERT INTO joutes.events (NAME) VALUES ('joutes 2017');

--
--  Insert Data in sports
--

INSERT INTO sports (NAME, description)
VALUES ('Beach Volley', '4-4 mixte'), ('Badminton', 'Doubles'), ('Unihockey', 'à 6 joueurs');

--
--  Insert Data in courts
--

INSERT INTO courts (NAME, acronym, sport_id)
VALUES
  ('Lac', 'Lac', 1), ('Montagne', 'Mnt', 1),
  ('1', 'T1', 2), ('2', 'T2', 2), ('3', 'T3', 2), ('4', 'T4', 2), ('5', 'T5', 2), ('6', 'T6', 2),
  ('A', 'A', 3), ('B', 'B', 3);

--
--  Insert Data in tournaments
--

INSERT INTO tournaments (NAME, start_date, event_id, sport_id)
VALUES
  ('BeachVolley', '2017-06-27 09:30:00', 1, 1),
  ('Badminton', '2017-06-27 13:30:00', 1, 2),
  ('Unihockey', '2017-06-27 08:00:00', 1, 3);

--
--  Insert Data in game_types
--

INSERT INTO game_types (game_type_description) VALUES ('Modalités de jeu');

--
--  Insert Data in pool_modes
--

INSERT INTO pool_modes (mode_description, planningAlgorithm)
VALUES ('Matches simples', 1), ('Aller-retour', 2), ('Elimination directe', 3);

--
--  Insert Data in participants
--

INSERT INTO participants (first_name, last_name)
VALUES ("Ahmed", "Casey"), ("Chester", "Day"), ("Riley", "Garrison"), ("Duncan", "Roy"), ("Remedios", "Black"),
  ("Mark", "Molina"), ("Dana", "Justice"), ("Linus", "Leon"), ("Cairo", "Farmer"), ("Nyssa", "Gallagher");
INSERT INTO participants (first_name, last_name)
VALUES ("Allegra", "Waller"), ("Emery", "Copeland"), ("Illana", "Mcgowan"), ("Magee", "Bauer"), ("Patricia", "Briggs"),
  ("Samuel", "Meyers"), ("Nelle", "Holcomb"), ("Shay", "David"), ("Kai", "Quinn"), ("Brendan", "Macdonald");
INSERT INTO participants (first_name, last_name)
VALUES ("Justin", "Jones"), ("Erich", "Shepherd"), ("Joseph", "Compton"), ("Moses", "Pope"), ("Hedley", "Thornton"),
  ("Deborah", "Wells"), ("Kay", "Ortega"), ("Dorothy", "Johnston"), ("Irene", "Alston"), ("Doris", "Baird");
INSERT INTO participants (first_name, last_name)
VALUES ("Zorita", "Ellis"), ("Yen", "Hale"), ("Madison", "Marshall"), ("Angela", "Perry"), ("Michael", "Woodard"),
  ("Karyn", "Riddle"), ("Carol", "Lang"), ("Malik", "Padilla"), ("Maxine", "Rowland"), ("Halee", "Larson");
INSERT INTO participants (first_name, last_name)
VALUES ("Tatyana", "Rosario"), ("Latifah", "Jenkins"), ("Wynne", "Rowland"), ("Nola", "Adkins"),
  ("Nicole", "Wilkerson"), ("Sybil", "Murray"), ("Cadman", "Evans"), ("Xenos", "Kramer"), ("Illana", "Riley"),
  ("Evan", "Logan");
INSERT INTO participants (first_name, last_name)
VALUES ("Risa", "Fuller"), ("Jenette", "Alvarado"), ("Colorado", "Moss"), ("Bree", "Velazquez"), ("Madonna", "Preston"),
  ("Daria", "Pearson"), ("Uta", "Hensley"), ("Paul", "Lambert"), ("Declan", "Ramirez"), ("Davis", "Mcleod");
INSERT INTO participants (first_name, last_name)
VALUES ("Wanda", "Sears"), ("Melvin", "Bowen"), ("Lareina", "Forbes"), ("Dane", "Holland"), ("Norman", "Mcleod"),
  ("Blythe", "Cruz"), ("Jayme", "Gill"), ("Adele", "Warren"), ("Candace", "Valenzuela"), ("Judith", "Blake");
INSERT INTO participants (first_name, last_name)
VALUES ("Ella", "Mcdaniel"), ("Mara", "Forbes"), ("Brynne", "Mcgowan"), ("Zelenia", "Knight"), ("Willa", "Griffith"),
  ("Austin", "Gray"), ("Mason", "Hendricks"), ("Azalia", "Fletcher"), ("Tashya", "Lawson"), ("Gavin", "Reynolds");
INSERT INTO participants (first_name, last_name)
VALUES ("Bree", "Kramer"), ("Wade", "Blake"), ("Keaton", "Melendez"), ("Charde", "Osborne"), ("Deanna", "Phelps"),
  ("Ulric", "Higgins"), ("Violet", "Ramsey"), ("Dai", "Hyde"), ("Vivien", "Howe"), ("Lila", "Levy");
INSERT INTO participants (first_name, last_name)
VALUES ("Ishmael", "Wall"), ("Yuli", "Wyatt"), ("Rina", "Rowe"), ("Yardley", "Conway"), ("Cecilia", "Alston"),
  ("Ulla", "Bailey"), ("Xandra", "Yates"), ("Zane", "Thornton"), ("Chancellor", "Diaz"), ("India", "Hensley");
INSERT INTO participants (first_name, last_name)
VALUES ("Xavier", "Williams"), ("Brynne", "Patton"), ("Vincent", "Moran"), ("Hayfa", "Arnold"), ("Melodie", "Garrett"),
  ("Ariana", "Morris"), ("Isaiah", "Moran"), ("Myra", "Crane"), ("Daphne", "Reeves"), ("Elijah", "English");
INSERT INTO participants (first_name, last_name)
VALUES ("Mason", "Weber"), ("Zoe", "Chapman"), ("David", "Conrad"), ("Marcia", "Ramos"), ("Addison", "Wynn"),
  ("Matthew", "Boyle"), ("Len", "Simmons"), ("Ashely", "Ryan"), ("Nolan", "Holt"), ("Garrison", "Chambers");
INSERT INTO participants (first_name, last_name)
VALUES ("Dale", "Glass"), ("Ezra", "Burnett"), ("Cain", "Blankenship"), ("Octavia", "Rocha"), ("Riley", "Cortez"),
  ("Reed", "Hickman"), ("Luke", "Meadows"), ("Aspen", "Mills"), ("Jason", "Bishop"), ("Zephania", "Mcmahon");
INSERT INTO participants (first_name, last_name)
VALUES ("Cody", "Mendoza"), ("Deirdre", "Floyd"), ("Melodie", "Massey"), ("Kellie", "Lynch"), ("Riley", "Mccarty"),
  ("Tyrone", "Melton"), ("Savannah", "Gay"), ("Audra", "Franklin"), ("Maxwell", "Blackwell"), ("Chastity", "Maldonado");
INSERT INTO participants (first_name, last_name)
VALUES ("Yardley", "Armstrong"), ("Nissim", "Saunders"), ("Doris", "Hendrix"), ("Burton", "Dixon"), ("Imani", "Bowers"),
  ("Gwendolyn", "Scott"), ("Leslie", "Whitley"), ("Nehru", "Klein"), ("Dante", "Page"), ("Rudyard", "Beach");
INSERT INTO participants (first_name, last_name)
VALUES ("Clare", "Warner"), ("Fatima", "Zamora"), ("Danielle", "Fields"), ("Keely", "Witt"), ("Rina", "Dale"),
  ("Lee", "Vasquez"), ("Dillon", "Smith"), ("Tanya", "Brooks"), ("Ezekiel", "Oneil"), ("Zoe", "Frost");
INSERT INTO participants (first_name, last_name)
VALUES ("Yoshio", "Wolf"), ("Damian", "Berg"), ("Lev", "Santos"), ("Illiana", "Dyer"), ("Illiana", "Buchanan"),
  ("Olga", "Booth"), ("Rhiannon", "Kaufman"), ("Brynne", "Clay"), ("Cruz", "Contreras"), ("Florence", "Herman");

--
--  Insert Data in teams
--
-- Beach volley teams
INSERT INTO teams (NAME, tournament_id) VALUES ('Badboys', 1);
INSERT INTO teams (NAME, tournament_id) VALUES ('Super Nanas', 1);
INSERT INTO teams (NAME, tournament_id) VALUES ('CPVN Crew', 1);
INSERT INTO teams (NAME, tournament_id) VALUES ('Magical Girls', 1);
INSERT INTO teams (NAME, tournament_id) VALUES ('OliverTwist', 1);
INSERT INTO teams (NAME, tournament_id) VALUES ('Scarman', 1);
INSERT INTO teams (NAME, tournament_id) VALUES ('Siomer', 1);
INSERT INTO teams (NAME, tournament_id) VALUES ('Salsadi', 1);
INSERT INTO teams (NAME, tournament_id) VALUES ('Monoster', 1);
INSERT INTO teams (NAME, tournament_id) VALUES ('Picalo', 1);
INSERT INTO teams (NAME, tournament_id) VALUES ('Dellit', 1);
INSERT INTO teams (NAME, tournament_id) VALUES ('SuperStar', 1);

-- Badminton teams
INSERT INTO teams (NAME, tournament_id) VALUES ('Masting', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Clafier', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Robert2Poche', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Alexandri', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('FanGirls', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Les Otakus', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Gamers', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Over2000', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Shinigami', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Rocketteurs', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Gilles & 2Sot-Vetage', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Maya Labeille', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Taupes ModL', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Les Pausés', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Absolute Frost', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Dark Side', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Btooom', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Stalgia', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Clattonia', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Danrell', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('RunAGround', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Believer', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Plouf', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Jokers', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Minnie and friends', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Youpi', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Mouarf', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Olakétal', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Tchôoo', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Minions', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('Big fat boys', 2);
INSERT INTO teams (NAME, tournament_id) VALUES ('La loooose', 2);

-- Build 12 teams of 4 with first 48 persons for beachvolley
INSERT INTO participant_team (participant_id, team_id, isCaptain) SELECT
                                                                    id,
                                                                    FLOOR((id + 3) / 4),
                                                                    (id % 4 = 0)
                                                                  FROM participants
                                                                  WHERE id <= 48;

-- Build 32 pairs with next 64 persons for badminton
INSERT INTO participant_team (participant_id, team_id, isCaptain) SELECT
                                                                    id,
                                                                    12 + FLOOR((id - 47) / 2),
                                                                    (id % 2 = 0)
                                                                  FROM participants
                                                                  WHERE id BETWEEN 49 AND 112;

-- ################################################################################
--                                  Beach Volley
-- ################################################################################

-- ================= stage 1 =====================

-- pools id 1-3
INSERT INTO pools (tournament_id, start_time, end_time, poolName, mode_id, game_type_id, poolSize, stage, isFinished)
VALUES
  (1, '09:30', '11:45', 'A', 1, 1, 4, 1, 0),
  (1, '09:30', '11:45', 'B', 1, 1, 4, 1, 0),
  (1, '09:30', '11:45', 'C', 1, 1, 4, 1, 0);

-- contenders are automatic: teams 1-4 -> pool 1, teams 5-8 -> pool 2, thus team X -> pool floor((X+3)/4)
INSERT INTO contenders (pool_id, team_id) SELECT
                                            FLOOR((id + 3) / 4),
                                            id
                                          FROM teams
                                          WHERE tournament_id = 1;

-- Games
INSERT INTO games (date, start_time, contender1_id, contender2_id, court_id)
VALUES
  ('2017-06-27', '09:30', 1, 2, 1),
  ('2017-06-27', '09:30', 3, 4, 2),
  ('2017-06-27', '10:15', 1, 3, 1),
  ('2017-06-27', '10:15', 2, 4, 2),
  ('2017-06-27', '11:00', 4, 1, 1),
  ('2017-06-27', '11:00', 3, 2, 2),

  ('2017-06-27', '09:45', 5, 6, 1),
  ('2017-06-27', '09:45', 7, 8, 2),
  ('2017-06-27', '10:30', 5, 7, 1),
  ('2017-06-27', '10:30', 6, 8, 2),
  ('2017-06-27', '11:15', 8, 5, 1),
  ('2017-06-27', '11:15', 7, 6, 2),

  ('2017-06-27', '10:00', 9, 10, 1),
  ('2017-06-27', '10:00', 11, 12, 2),
  ('2017-06-27', '10:45', 9, 11, 1),
  ('2017-06-27', '10:45', 10, 12, 2),
  ('2017-06-27', '11:30', 12, 9, 1),
  ('2017-06-27', '11:30', 11, 10, 2);

-- ================= stage 2 =====================

-- pools id 4-5
INSERT INTO pools (tournament_id, start_time, end_time, poolName, mode_id, game_type_id, poolSize, stage, isFinished)
VALUES
  (1, '11:45', '16:00', 'Winners', 1, 1, 6, 2, 0), (1, '11:45', '16:00', 'Fun', 1, 1, 6, 2, 0);

INSERT INTO contenders (pool_id, rank_in_pool, pool_from_id)
VALUES
  (4, 1, 1),
  (4, 2, 1),
  (4, 1, 2),
  (4, 2, 2),
  (4, 1, 3),
  (4, 2, 3),
  (5, 3, 1),
  (5, 4, 1),
  (5, 3, 2),
  (5, 4, 2),
  (5, 3, 3),
  (5, 4, 3);

-- Games
INSERT INTO games (date, start_time, contender1_id, contender2_id, court_id)
VALUES
  ('2017-06-27', '11:45', 16, 17, 1),
  ('2017-06-27', '12:00', 18, 19, 1),
  ('2017-06-27', '12:15', 20, 21, 1),
  ('2017-06-27', '13:00', 16, 18, 1),
  ('2017-06-27', '13:15', 17, 21, 1),
  ('2017-06-27', '13:30', 19, 20, 1),
  ('2017-06-27', '13:45', 16, 19, 1),
  ('2017-06-27', '14:00', 17, 20, 1),
  ('2017-06-27', '14:15', 18, 21, 1),
  ('2017-06-27', '14:30', 16, 20, 1),
  ('2017-06-27', '14:45', 17, 18, 1),
  ('2017-06-27', '15:00', 19, 21, 1),
  ('2017-06-27', '15:15', 16, 21, 1),
  ('2017-06-27', '15:30', 17, 19, 1),
  ('2017-06-27', '15:45', 18, 20, 1),

  ('2017-06-27', '11:45', 22, 23, 2),
  ('2017-06-27', '12:00', 24, 25, 2),
  ('2017-06-27', '12:15', 26, 27, 2),
  ('2017-06-27', '13:00', 22, 24, 2),
  ('2017-06-27', '13:15', 23, 27, 2),
  ('2017-06-27', '13:30', 25, 26, 2),
  ('2017-06-27', '13:45', 22, 25, 2),
  ('2017-06-27', '14:00', 23, 26, 2),
  ('2017-06-27', '14:15', 24, 27, 2),
  ('2017-06-27', '14:30', 22, 26, 2),
  ('2017-06-27', '14:45', 23, 24, 2),
  ('2017-06-27', '15:00', 25, 27, 2),
  ('2017-06-27', '15:15', 22, 27, 2),
  ('2017-06-27', '15:30', 23, 25, 2),
  ('2017-06-27', '15:45', 24, 26, 2);

DELIMITER $$
CREATE PROCEDURE AddBadmintonTournament()
  -- Tournament structure:
  -- 32 teams
  -- round 1: 8 pools of 4 teams
  -- round 2: 2 pools of 4 winners, 2 pools of 4 seconds, 2 pools of 4 third, 2 pools of 4 fourth
  -- round 3: finals rank for rank across pools of the same level
  BEGIN
    DECLARE firstPoolStage1 INT;
    DECLARE firstPoolStage2 INT;
    DECLARE firstFinal INT;
    DECLARE firstTeam INT DEFAULT (SELECT id
                                   FROM teams
                                   WHERE tournament_id = 2
                                   LIMIT 1); -- first of the 32 badminton pairs
    DECLARE firstContender INT;

    -- Stage 1
    INSERT INTO pools (tournament_id, start_time, end_time, poolName, mode_id, game_type_id, poolSize, stage, isFinished)
    VALUES
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '13:30', '14:45', 'A', 1, 1, 4, 1, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '13:30', '14:45', 'B', 1, 1, 4, 1, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '13:30', '14:45', 'C', 1, 1, 4, 1, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '13:30', '14:45', 'D', 1, 1, 4, 1, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '13:30', '14:45', 'E', 1, 1, 4, 1, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '13:30', '14:45', 'F', 1, 1, 4, 1, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '13:30', '14:45', 'G', 1, 1, 4, 1, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '13:30', '14:45', 'H', 1, 1, 4, 1, 0);
    SET firstPoolStage1 = LAST_INSERT_ID();

    -- contenders are automatic: teams 1-4 -> pool 1, teams 5-8 -> pool 2, thus team X -> pool floor((X+3)/4)
    INSERT INTO contenders (pool_id, team_id) SELECT
                                                firstPoolStage1 + FLOOR((id - firstTeam) / 4),
                                                id
                                              FROM teams
                                              WHERE tournament_id = 2;

    -- Games pool A
    SET firstContender = LAST_INSERT_ID();
    INSERT INTO games (date, start_time, contender1_id, contender2_id, court_id)
    VALUES
      ('2017-06-27', '13:30', firstContender + 0, firstContender + 1, 3),
      ('2017-06-27', '13:40', firstContender + 2, firstContender + 3, 5),
      ('2017-06-27', '13:50', firstContender + 0, firstContender + 2, 7),
      ('2017-06-27', '14:10', firstContender + 1, firstContender + 3, 3),
      ('2017-06-27', '14:20', firstContender + 0, firstContender + 3, 5),
      ('2017-06-27', '14:30', firstContender + 1, firstContender + 2, 7);

    -- Games pool B
    SET firstContender = firstContender + 4;
    INSERT INTO games (date, start_time, contender1_id, contender2_id, court_id)
    VALUES
      ('2017-06-27', '13:30', firstContender + 0, firstContender + 1, 4),
      ('2017-06-27', '13:40', firstContender + 2, firstContender + 3, 6),
      ('2017-06-27', '13:50', firstContender + 0, firstContender + 2, 8),
      ('2017-06-27', '14:10', firstContender + 1, firstContender + 3, 4),
      ('2017-06-27', '14:20', firstContender + 0, firstContender + 3, 6),
      ('2017-06-27', '14:30', firstContender + 1, firstContender + 2, 8);

    -- Games pool C
    SET firstContender = firstContender + 4;
    INSERT INTO games (date, start_time, contender1_id, contender2_id, court_id)
    VALUES
      ('2017-06-27', '13:30', firstContender + 0, firstContender + 1, 5),
      ('2017-06-27', '13:40', firstContender + 2, firstContender + 3, 7),
      ('2017-06-27', '14:00', firstContender + 0, firstContender + 2, 3),
      ('2017-06-27', '14:10', firstContender + 1, firstContender + 3, 5),
      ('2017-06-27', '14:20', firstContender + 0, firstContender + 3, 7),
      ('2017-06-27', '14:40', firstContender + 1, firstContender + 2, 3);

    -- Games pool D
    SET firstContender = firstContender + 4;
    INSERT INTO games (date, start_time, contender1_id, contender2_id, court_id)
    VALUES
      ('2017-06-27', '13:30', firstContender + 0, firstContender + 1, 6),
      ('2017-06-27', '13:40', firstContender + 2, firstContender + 3, 8),
      ('2017-06-27', '14:00', firstContender + 0, firstContender + 2, 4),
      ('2017-06-27', '14:10', firstContender + 1, firstContender + 3, 6),
      ('2017-06-27', '14:20', firstContender + 0, firstContender + 3, 8),
      ('2017-06-27', '14:40', firstContender + 1, firstContender + 2, 4);

    -- Games pool E
    SET firstContender = firstContender + 4;
    INSERT INTO games (date, start_time, contender1_id, contender2_id, court_id)
    VALUES
      ('2017-06-27', '13:30', firstContender + 0, firstContender + 1, 7),
      ('2017-06-27', '13:50', firstContender + 2, firstContender + 3, 3),
      ('2017-06-27', '14:00', firstContender + 0, firstContender + 2, 5),
      ('2017-06-27', '14:10', firstContender + 1, firstContender + 3, 7),
      ('2017-06-27', '14:30', firstContender + 0, firstContender + 3, 3),
      ('2017-06-27', '14:40', firstContender + 1, firstContender + 2, 5);

    -- Games pool F
    SET firstContender = firstContender + 4;
    INSERT INTO games (date, start_time, contender1_id, contender2_id, court_id)
    VALUES
      ('2017-06-27', '13:30', firstContender + 0, firstContender + 1, 8),
      ('2017-06-27', '13:50', firstContender + 2, firstContender + 3, 4),
      ('2017-06-27', '14:00', firstContender + 0, firstContender + 2, 6),
      ('2017-06-27', '14:10', firstContender + 1, firstContender + 3, 8),
      ('2017-06-27', '14:30', firstContender + 0, firstContender + 3, 4),
      ('2017-06-27', '14:40', firstContender + 1, firstContender + 2, 6);

    -- Games pool G
    SET firstContender = firstContender + 4;
    INSERT INTO games (date, start_time, contender1_id, contender2_id, court_id)
    VALUES
      ('2017-06-27', '13:40', firstContender + 0, firstContender + 1, 3),
      ('2017-06-27', '13:50', firstContender + 2, firstContender + 3, 5),
      ('2017-06-27', '14:00', firstContender + 0, firstContender + 2, 7),
      ('2017-06-27', '14:20', firstContender + 1, firstContender + 3, 3),
      ('2017-06-27', '14:30', firstContender + 0, firstContender + 3, 5),
      ('2017-06-27', '14:40', firstContender + 1, firstContender + 2, 7);

    -- Games pool H
    SET firstContender = firstContender + 4;
    INSERT INTO games (date, start_time, contender1_id, contender2_id, court_id)
    VALUES
      ('2017-06-27', '13:40', firstContender + 0, firstContender + 1, 4),
      ('2017-06-27', '13:50', firstContender + 2, firstContender + 3, 6),
      ('2017-06-27', '14:00', firstContender + 0, firstContender + 2, 8),
      ('2017-06-27', '14:20', firstContender + 1, firstContender + 3, 4),
      ('2017-06-27', '14:30', firstContender + 0, firstContender + 3, 6),
      ('2017-06-27', '14:40', firstContender + 1, firstContender + 2, 8);

    -- Stage 2
    INSERT INTO pools (tournament_id, start_time, end_time, poolName, mode_id, game_type_id, poolSize, stage, isFinished)
    VALUES
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '14:45', '16:00', '1A', 1, 1, 4, 2, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '14:45', '16:00', '1B', 1, 1, 4, 2, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '14:45', '16:00', '2A', 1, 1, 4, 2, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '14:45', '16:00', '2B', 1, 1, 4, 2, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '14:45', '16:00', '3A', 1, 1, 4, 2, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '14:45', '16:00', '3B', 1, 1, 4, 2, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '14:45', '16:00', '4A', 1, 1, 4, 2, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '14:45', '16:00', '4B', 1, 1, 4, 2, 0);
    SET firstPoolStage2 = LAST_INSERT_ID();

    INSERT INTO contenders (pool_id, rank_in_pool, pool_from_id)
    VALUES
      (firstPoolStage2 + 0, 1, firstPoolStage1 + 0),
      (firstPoolStage2 + 0, 1, firstPoolStage1 + 1),
      (firstPoolStage2 + 0, 1, firstPoolStage1 + 2),
      (firstPoolStage2 + 0, 1, firstPoolStage1 + 3),
      (firstPoolStage2 + 1, 1, firstPoolStage1 + 4),
      (firstPoolStage2 + 1, 1, firstPoolStage1 + 5),
      (firstPoolStage2 + 1, 1, firstPoolStage1 + 6),
      (firstPoolStage2 + 1, 1, firstPoolStage1 + 7),
      (firstPoolStage2 + 2, 2, firstPoolStage1 + 0),
      (firstPoolStage2 + 2, 2, firstPoolStage1 + 1),
      (firstPoolStage2 + 2, 2, firstPoolStage1 + 2),
      (firstPoolStage2 + 2, 2, firstPoolStage1 + 3),
      (firstPoolStage2 + 3, 2, firstPoolStage1 + 4),
      (firstPoolStage2 + 3, 2, firstPoolStage1 + 5),
      (firstPoolStage2 + 3, 2, firstPoolStage1 + 6),
      (firstPoolStage2 + 3, 2, firstPoolStage1 + 7),
      (firstPoolStage2 + 4, 3, firstPoolStage1 + 0),
      (firstPoolStage2 + 4, 3, firstPoolStage1 + 1),
      (firstPoolStage2 + 4, 3, firstPoolStage1 + 2),
      (firstPoolStage2 + 4, 3, firstPoolStage1 + 3),
      (firstPoolStage2 + 5, 3, firstPoolStage1 + 4),
      (firstPoolStage2 + 5, 3, firstPoolStage1 + 5),
      (firstPoolStage2 + 5, 3, firstPoolStage1 + 6),
      (firstPoolStage2 + 5, 3, firstPoolStage1 + 7),
      (firstPoolStage2 + 6, 4, firstPoolStage1 + 0),
      (firstPoolStage2 + 6, 4, firstPoolStage1 + 1),
      (firstPoolStage2 + 6, 4, firstPoolStage1 + 2),
      (firstPoolStage2 + 6, 4, firstPoolStage1 + 3),
      (firstPoolStage2 + 7, 4, firstPoolStage1 + 4),
      (firstPoolStage2 + 7, 4, firstPoolStage1 + 5),
      (firstPoolStage2 + 7, 4, firstPoolStage1 + 6),
      (firstPoolStage2 + 7, 4, firstPoolStage1 + 7);

    -- Games pool 1A
    SET firstContender = LAST_INSERT_ID();
    INSERT INTO games (date, start_time, contender1_id, contender2_id, court_id)
    VALUES
      ('2017-06-27', '14:45', firstContender + 0, firstContender + 1, 3),
      ('2017-06-27', '14:55', firstContender + 2, firstContender + 3, 5),
      ('2017-06-27', '15:05', firstContender + 0, firstContender + 2, 7),
      ('2017-06-27', '15:25', firstContender + 1, firstContender + 3, 3),
      ('2017-06-27', '15:35', firstContender + 0, firstContender + 3, 5),
      ('2017-06-27', '15:45', firstContender + 1, firstContender + 2, 7);

    -- Games pool 1B
    SET firstContender = firstContender + 4;
    INSERT INTO games (date, start_time, contender1_id, contender2_id, court_id)
    VALUES
      ('2017-06-27', '14:45', firstContender + 0, firstContender + 1, 4),
      ('2017-06-27', '14:55', firstContender + 2, firstContender + 3, 6),
      ('2017-06-27', '15:05', firstContender + 0, firstContender + 2, 8),
      ('2017-06-27', '15:25', firstContender + 1, firstContender + 3, 4),
      ('2017-06-27', '15:35', firstContender + 0, firstContender + 3, 6),
      ('2017-06-27', '15:45', firstContender + 1, firstContender + 2, 8);

    -- Games pool 2A
    SET firstContender = firstContender + 4;
    INSERT INTO games (date, start_time, contender1_id, contender2_id, court_id)
    VALUES
      ('2017-06-27', '14:45', firstContender + 0, firstContender + 1, 5),
      ('2017-06-27', '14:55', firstContender + 2, firstContender + 3, 7),
      ('2017-06-27', '15:15', firstContender + 0, firstContender + 2, 3),
      ('2017-06-27', '15:25', firstContender + 1, firstContender + 3, 5),
      ('2017-06-27', '15:35', firstContender + 0, firstContender + 3, 7),
      ('2017-06-27', '15:55', firstContender + 1, firstContender + 2, 3);

    -- Games pool 2B
    SET firstContender = firstContender + 4;
    INSERT INTO games (date, start_time, contender1_id, contender2_id, court_id)
    VALUES
      ('2017-06-27', '14:45', firstContender + 0, firstContender + 1, 6),
      ('2017-06-27', '14:55', firstContender + 2, firstContender + 3, 8),
      ('2017-06-27', '15:15', firstContender + 0, firstContender + 2, 4),
      ('2017-06-27', '15:25', firstContender + 1, firstContender + 3, 6),
      ('2017-06-27', '15:35', firstContender + 0, firstContender + 3, 8),
      ('2017-06-27', '15:55', firstContender + 1, firstContender + 2, 4);

    -- Games pool 3A
    SET firstContender = firstContender + 4;
    INSERT INTO games (date, start_time, contender1_id, contender2_id, court_id)
    VALUES
      ('2017-06-27', '14:45', firstContender + 0, firstContender + 1, 7),
      ('2017-06-27', '15:05', firstContender + 2, firstContender + 3, 3),
      ('2017-06-27', '15:15', firstContender + 0, firstContender + 2, 5),
      ('2017-06-27', '15:25', firstContender + 1, firstContender + 3, 7),
      ('2017-06-27', '15:45', firstContender + 0, firstContender + 3, 3),
      ('2017-06-27', '15:55', firstContender + 1, firstContender + 2, 5);

    -- Games pool 3B
    SET firstContender = firstContender + 4;
    INSERT INTO games (date, start_time, contender1_id, contender2_id, court_id)
    VALUES
      ('2017-06-27', '14:45', firstContender + 0, firstContender + 1, 8),
      ('2017-06-27', '15:05', firstContender + 2, firstContender + 3, 4),
      ('2017-06-27', '15:15', firstContender + 0, firstContender + 2, 6),
      ('2017-06-27', '15:25', firstContender + 1, firstContender + 3, 8),
      ('2017-06-27', '15:45', firstContender + 0, firstContender + 3, 4),
      ('2017-06-27', '15:55', firstContender + 1, firstContender + 2, 6);

    -- Games pool 4A
    SET firstContender = firstContender + 4;
    INSERT INTO games (date, start_time, contender1_id, contender2_id, court_id)
    VALUES
      ('2017-06-27', '14:55', firstContender + 0, firstContender + 1, 3),
      ('2017-06-27', '15:05', firstContender + 2, firstContender + 3, 5),
      ('2017-06-27', '15:15', firstContender + 0, firstContender + 2, 7),
      ('2017-06-27', '15:35', firstContender + 1, firstContender + 3, 3),
      ('2017-06-27', '15:45', firstContender + 0, firstContender + 3, 5),
      ('2017-06-27', '15:55', firstContender + 1, firstContender + 2, 7);

    -- Games pool 4B
    SET firstContender = firstContender + 4;
    INSERT INTO games (date, start_time, contender1_id, contender2_id, court_id)
    VALUES
      ('2017-06-27', '14:55', firstContender + 0, firstContender + 1, 4),
      ('2017-06-27', '15:05', firstContender + 2, firstContender + 3, 6),
      ('2017-06-27', '15:15', firstContender + 0, firstContender + 2, 8),
      ('2017-06-27', '15:35', firstContender + 1, firstContender + 3, 4),
      ('2017-06-27', '15:45', firstContender + 0, firstContender + 3, 6),
      ('2017-06-27', '15:55', firstContender + 1, firstContender + 2, 8);

    -- Stage 3: finals
    INSERT INTO pools (tournament_id, start_time, end_time, poolName, mode_id, game_type_id, poolSize, stage, isFinished)
    VALUES
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '16:15', '16:00', 'Finale 1-2', 1, 1, 2, 3, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '16:15', '16:00', 'Finale 3-4', 1, 1, 2, 3, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '16:15', '16:00', 'Finale 5-6', 1, 1, 2, 3, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '16:15', '16:00', 'Finale 7-8', 1, 1, 2, 3, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '16:15', '16:00', 'Finale 9-10', 1, 1, 2, 3, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '16:15', '16:00', 'Finale 11-12', 1, 1, 2, 3, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '16:15', '16:00', 'Finale 13-14', 1, 1, 2, 3, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '16:15', '16:00', 'Finale 15-16', 1, 1, 2, 3, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '16:15', '16:00', 'Finale 17-18', 1, 1, 2, 3, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '16:15', '16:00', 'Finale 19-20', 1, 1, 2, 3, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '16:15', '16:00', 'Finale 21-22', 1, 1, 2, 3, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '16:15', '16:00', 'Finale 23-14', 1, 1, 2, 3, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '16:15', '16:00', 'Finale 25-26', 1, 1, 2, 3, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '16:15', '16:00', 'Finale 27-28', 1, 1, 2, 3, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '16:15', '16:00', 'Finale 29-30', 1, 1, 2, 3, 0),
      ((SELECT id
        FROM tournaments
        WHERE name = 'Badminton'), '16:15', '16:00', 'Finale 31-32', 1, 1, 2, 3, 0);
    SET firstFinal = LAST_INSERT_ID();

    INSERT INTO contenders (pool_id, rank_in_pool, pool_from_id)
    VALUES
      (firstFinal + 0, 1, firstPoolStage2 + 0),
      (firstFinal + 0, 1, firstPoolStage2 + 1),
      (firstFinal + 1, 2, firstPoolStage2 + 0),
      (firstFinal + 1, 2, firstPoolStage2 + 1),
      (firstFinal + 2, 3, firstPoolStage2 + 0),
      (firstFinal + 2, 3, firstPoolStage2 + 1),
      (firstFinal + 3, 4, firstPoolStage2 + 0),
      (firstFinal + 3, 4, firstPoolStage2 + 1),
      (firstFinal + 4, 1, firstPoolStage2 + 2),
      (firstFinal + 4, 1, firstPoolStage2 + 3),
      (firstFinal + 5, 2, firstPoolStage2 + 2),
      (firstFinal + 5, 2, firstPoolStage2 + 3),
      (firstFinal + 6, 3, firstPoolStage2 + 2),
      (firstFinal + 6, 3, firstPoolStage2 + 3),
      (firstFinal + 7, 4, firstPoolStage2 + 2),
      (firstFinal + 7, 4, firstPoolStage2 + 3),
      (firstFinal + 8, 1, firstPoolStage2 + 4),
      (firstFinal + 8, 1, firstPoolStage2 + 5),
      (firstFinal + 9, 2, firstPoolStage2 + 4),
      (firstFinal + 9, 2, firstPoolStage2 + 5),
      (firstFinal + 10, 3, firstPoolStage2 + 4),
      (firstFinal + 10, 3, firstPoolStage2 + 5),
      (firstFinal + 11, 4, firstPoolStage2 + 4),
      (firstFinal + 11, 4, firstPoolStage2 + 5),
      (firstFinal + 12, 1, firstPoolStage2 + 6),
      (firstFinal + 12, 1, firstPoolStage2 + 7),
      (firstFinal + 13, 2, firstPoolStage2 + 6),
      (firstFinal + 13, 2, firstPoolStage2 + 7),
      (firstFinal + 14, 3, firstPoolStage2 + 6),
      (firstFinal + 14, 3, firstPoolStage2 + 7),
      (firstFinal + 15, 4, firstPoolStage2 + 6),
      (firstFinal + 15, 4, firstPoolStage2 + 7);

    -- Games pool 1A
    SET firstContender = LAST_INSERT_ID();
    INSERT INTO games (date, start_time, contender1_id, contender2_id, court_id)
    VALUES
      ('2017-06-27', '16:45', firstContender + 0, firstContender + 1, 3),
      ('2017-06-27', '16:45', firstContender + 2, firstContender + 3, 6),
      ('2017-06-27', '16:45', firstContender + 4, firstContender + 5, 4),
      ('2017-06-27', '16:45', firstContender + 6, firstContender + 7, 7),
      ('2017-06-27', '16:30', firstContender + 8, firstContender + 9, 8),
      ('2017-06-27', '16:30', firstContender + 10, firstContender + 11, 7),
      ('2017-06-27', '16:30', firstContender + 12, firstContender + 13, 6),
      ('2017-06-27', '16:30', firstContender + 14, firstContender + 15, 5),
      ('2017-06-27', '16:30', firstContender + 16, firstContender + 17, 4),
      ('2017-06-27', '16:30', firstContender + 18, firstContender + 19, 3),
      ('2017-06-27', '16:15', firstContender + 20, firstContender + 21, 8),
      ('2017-06-27', '16:15', firstContender + 22, firstContender + 23, 7),
      ('2017-06-27', '16:15', firstContender + 24, firstContender + 25, 6),
      ('2017-06-27', '16:15', firstContender + 26, firstContender + 27, 5),
      ('2017-06-27', '16:15', firstContender + 28, firstContender + 29, 4),
      ('2017-06-27', '16:15', firstContender + 30, firstContender + 31, 3);


  END;


$$
CALL AddBadmintonTournament();
DROP PROCEDURE AddBadmintonTournament;

-- Temporarily for ease of testing: create admin and writer

INSERT INTO joutes.users (username, password, role)
VALUES ('writer', '$2y$10$1nlzftBwvtxq6yueKHvROukJ9acntgG1pmu.qb1UY80pJWFchadP6', 'writer');
INSERT INTO joutes.users (username, password, role)
VALUES ('admin', '$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'administrator');
