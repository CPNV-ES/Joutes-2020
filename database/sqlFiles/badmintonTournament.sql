USE joutes;

ALTER TABLE contenders AUTO_INCREMENT=1;
ALTER TABLE courts AUTO_INCREMENT=1;
ALTER TABLE events AUTO_INCREMENT=1;
ALTER TABLE game_types AUTO_INCREMENT=1;
ALTER TABLE games AUTO_INCREMENT=1;
ALTER TABLE pool_modes AUTO_INCREMENT=1;
ALTER TABLE pools AUTO_INCREMENT=1;
ALTER TABLE roles AUTO_INCREMENT=1;
ALTER TABLE sports AUTO_INCREMENT=1;
ALTER TABLE team_user AUTO_INCREMENT=1;
ALTER TABLE teams AUTO_INCREMENT=1;
ALTER TABLE tournaments AUTO_INCREMENT=1;
ALTER TABLE users AUTO_INCREMENT=1;

-- ========================================== Data ==============================================

--
--  Insert Data in events
--

INSERT INTO joutes.events(NAME) VALUES ('joutes 2020');

--
--  Insert Data in sports
--

INSERT INTO sports(NAME, description) VALUES ('Badminton', 'En double');

--
--  Insert Data in courts
--

INSERT INTO courts(NAME, sport_id) VALUES ('Terrain A', 1),('Terrain B', 1),('Terrain C', 1),('Terrain D', 1);

--
--  Insert Data in tournaments
--

INSERT INTO tournaments(NAME, start_date, event_id, sport_id) VALUES ('Tournoi de Bad', '2020-06-11', 1, 1);

--
--  Insert Data in game_types
--

INSERT INTO game_types(game_type_description) VALUES ('Modalités de jeu');

--
--  Insert Data in pool_modes
--

INSERT INTO pool_modes(mode_description,planningAlgorithm) VALUES ('Matches simples',1),('Aller-retour',2),('Elimination directe',3);

--
--  Insert Data in roles
--

INSERT INTO roles(slug,name) VALUES ("STUD","student"),("PROF","professor"),("ADMIN","administrator");

--
--  Insert Data in users
--

INSERT INTO users(first_name,last_name) VALUES ("Ahmed","Casey"),("Chester","Day"),("Riley","Garrison"),("Duncan","Roy"),("Remedios","Black"),("Mark","Molina"),("Dana","Justice"),("Linus","Leon"),("Cairo","Farmer"),("Nyssa","Gallagher");
INSERT INTO users(first_name,last_name) VALUES ("Allegra","Waller"),("Emery","Copeland"),("Illana","Mcgowan"),("Magee","Bauer"),("Patricia","Briggs"),("Samuel","Meyers"),("Nelle","Holcomb"),("Shay","David"),("Kai","Quinn"),("Brendan","Macdonald");
INSERT INTO users(first_name,last_name) VALUES ("Justin","Jones"),("Erich","Shepherd"),("Joseph","Compton"),("Moses","Pope"),("Hedley","Thornton"),("Deborah","Wells"),("Kay","Ortega"),("Dorothy","Johnston"),("Irene","Alston"),("Doris","Baird");
INSERT INTO users(first_name,last_name) VALUES ("Zorita","Ellis"),("Yen","Hale"),("Madison","Marshall"),("Angela","Perry"),("Michael","Woodard"),("Karyn","Riddle"),("Carol","Lang"),("Malik","Padilla"),("Maxine","Rowland"),("Halee","Larson");
INSERT INTO users(first_name,last_name) VALUES ("Tatyana","Rosario"),("Latifah","Jenkins"),("Wynne","Rowland"),("Nola","Adkins"),("Nicole","Wilkerson"),("Sybil","Murray"),("Cadman","Evans"),("Xenos","Kramer"),("Illana","Riley"),("Evan","Logan");
INSERT INTO users(first_name,last_name) VALUES ("Risa","Fuller"),("Jenette","Alvarado"),("Colorado","Moss"),("Bree","Velazquez"),("Madonna","Preston"),("Daria","Pearson"),("Uta","Hensley"),("Paul","Lambert"),("Declan","Ramirez"),("Davis","Mcleod");
INSERT INTO users(first_name,last_name) VALUES ("Wanda","Sears"),("Melvin","Bowen"),("Lareina","Forbes"),("Dane","Holland"),("Norman","Mcleod"),("Blythe","Cruz"),("Jayme","Gill"),("Adele","Warren"),("Candace","Valenzuela"),("Judith","Blake");

--
--  Insert Data in teams
--

INSERT INTO teams(NAME,tournament_id) VALUES ('Badboys',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Super Nanas',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('CPVN Crew',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Magical Girls',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('OliverTwist',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Scarman',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Siomer',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Salsadi',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Monoster',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Picalo',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Dellit',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('SuperStar',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Masting',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Clafier',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Robert2Poche',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Alexandri',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('FanGirls',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Les Otakus',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Gamers',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Over2000',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Shinigami',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Rocketteurs',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Gilles & 2Sot-Vetage',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Maya Labeille',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Taupes ModL',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Les Pausés',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Absolute Frost',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Dark Side',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Btooom',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Stalgia',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Clattonia',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Danrell',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('RunAGround',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Believer',1);
INSERT INTO teams(NAME,tournament_id) VALUES ('Warriors',1);

--
--  Insert Data in team_user
--

INSERT INTO team_user(user_id, team_id, isCaptain) SELECT id, ROUND(id/2), (id%2) FROM users LIMIT 64;

--
--  Insert Data in contenders
--

-- ================= stage 1 =====================

-- pools id 1-8
INSERT INTO pools (tournament_id, start_time, end_time, poolName, mode_id, game_type_id, poolSize, stage, isFinished)
VALUES
  (1, '08:00', '10:00', 'A', 1, 1, 4, 1, 0), (1, '08:00', '10:00', 'B', 1, 1, 4, 1, 0),
  (1, '08:00', '10:00', 'C', 1, 1, 4, 1, 0), (1, '08:00', '10:00', 'D', 1, 1, 4, 1, 0),
  (1, '08:00', '10:00', 'E', 1, 1, 4, 1, 0), (1, '08:00', '10:00', 'F', 1, 1, 4, 1, 0),
  (1, '08:00', '10:00', 'G', 1, 1, 4, 1, 0), (1, '08:00', '10:00', 'H', 1, 1, 4, 1, 0);

-- contenders are automatic: teams 1-4 -> pool 1, teams 5-8 -> pool 2, thus team X -> pool floor((X+3)/4)
INSERT INTO contenders(pool_id,team_id) SELECT FLOOR((id+3)/4),id FROM teams LIMIT 32;

-- ================= stage 2 =====================

-- pools id 9-16
INSERT INTO pools (tournament_id, start_time, end_time, poolName, mode_id, game_type_id, poolSize, stage, isFinished)
VALUES
  (1, '10:00', '12:00', 'Win1', 1, 1, 4, 2, 0), (1, '10:00', '12:00', 'Win2', 1, 1, 4, 2, 0),
  (1, '10:00', '12:00', 'Win3', 1, 1, 4, 2, 0), (1, '10:00', '12:00', 'Win4', 1, 1, 4, 2, 0),
  (1, '10:00', '12:00', 'Fun1', 1, 1, 4, 2, 0), (1, '10:00', '12:00', 'Fun2', 1, 1, 4, 2, 0),
  (1, '10:00', '12:00', 'Fun3', 1, 1, 4, 2, 0), (1, '10:00', '12:00', 'Fun4', 1, 1, 4, 2, 0);

INSERT INTO contenders (pool_id, rank_in_pool, pool_from_id)
VALUES
  (9, 1, 1),
  (9, 2, 1),
  (9, 1, 2),
  (9, 2, 2),
  (10, 1, 3),
  (10, 2, 3),
  (10, 1, 4),
  (10, 2, 4),
  (11, 1, 5),
  (11, 2, 5),
  (11, 1, 6),
  (11, 2, 6),
  (12, 1, 7),
  (12, 2, 7),
  (12, 1, 8),
  (12, 2, 8),
  (13, 3, 1),
  (13, 4, 1),
  (13, 3, 2),
  (13, 4, 2),
  (14, 3, 3),
  (14, 4, 3),
  (14, 3, 4),
  (14, 4, 4),
  (15, 3, 5),
  (15, 4, 5),
  (15, 3, 6),
  (15, 4, 6),
  (16, 3, 7),
  (16, 4, 7),
  (16, 3, 8),
  (16, 4, 8);

-- ================= stage 3 =====================

-- pools id 17-20
INSERT INTO pools (tournament_id, start_time, end_time, poolName, mode_id, game_type_id, poolSize, stage, isFinished)
VALUES
  (1, '13:30', '15:30', 'Best 1', 1, 1, 4, 3, 0), (1, '13:30', '15:30', 'Best 2', 1, 1, 4, 3, 0),
  (1, '13:30', '15:30', 'Good 1', 1, 1, 4, 3, 0), (1, '13:30', '15:30', 'Good 2', 1, 1, 4, 3, 0);

INSERT INTO contenders (pool_id, rank_in_pool, pool_from_id)
VALUES
  (17, 1, 9),
  (17, 2, 9),
  (17, 1, 10),
  (17, 2, 10),
  (18, 1, 11),
  (18, 2, 11),
  (18, 1, 12),
  (18, 2, 12),
  (19, 3, 13),
  (19, 4, 13),
  (19, 3, 14),
  (19, 4, 14),
  (20, 3, 15),
  (20, 4, 15),
  (20, 3, 16),
  (20, 4, 16);

-- ================= stage 4 (finals) =====================

-- pools id 21-24
INSERT INTO pools (tournament_id, start_time, end_time, poolName, mode_id, game_type_id, poolSize, stage, isFinished)
VALUES
  (1, '15:30', '16:30', 'Finale 1-2', 1, 1, 2, 4, 0), (1, '15:30', '16:30', 'Finale 3-4', 1, 1, 2, 4, 0),
  (1, '15:30', '16:30', 'Finale 5-6', 1, 1, 2, 4, 0), (1, '15:30', '16:30', 'Finale 7-8', 1, 1, 2, 4, 0);

INSERT INTO contenders (pool_id, rank_in_pool, pool_from_id)
VALUES
  (21, 1, 17),
  (21, 1, 17),
  (22, 2, 18),
  (22, 2, 18),
  (23, 3, 19),
  (23, 3, 19),
  (24, 4, 20),
  (24, 4, 20);

DELIMITER $$
-- XCL, 4.3.2107
-- A procedure that generates single games within a pool. !! Assumes the contender ids of the pool are contiguous !!
CREATE PROCEDURE generateGames(IN poolid INT)
BEGIN
  DECLARE c1 INT DEFAULT (SELECT id FROM contenders WHERE pool_id=poolid LIMIT 1);
  DECLARE c2 INT;
  DECLARE psize INT DEFAULT (SELECT poolSize FROM pools WHERE id=poolid);
  DECLARE pstart TIME DEFAULT (SELECT pools.start_time FROM pools WHERE id=poolid); -- pool start time
  DECLARE i,j,s1,s2 INT DEFAULT 0;
  DECLARE deltat INT;
  DECLARE gamestart TIME;
  WHILE i < psize-1 DO
    SET j=i+1;
    WHILE j < psize DO
      SET deltat = 15*(i+j-1); -- Assume 15 minutes per game
      SET gamestart = ADDTIME(pstart,MAKETIME(deltat DIV 60, deltat MOD 60, 0));
      IF gamestart < MAKETIME(10,30,0) THEN -- generate a fake result
    IF RAND() > 0.5 THEN -- contender 1 wins
      BEGIN
        SET s1 = 15;
        SET s2 = FLOOR(5+8*RAND());
      END;
    ELSE -- contender 2 wins
      BEGIN
        SET s2 = 15;
        SET s1 = FLOOR(5+8*RAND());
      END;
    END IF;
      ELSE
      BEGIN
        SET s1 = NULL;
        SET s2 = NULL;
      END;
    END IF;
      INSERT INTO games (contender1_id, contender2_id, DATE, start_time, court_id, score_contender1, score_contender2) VALUES (c1+i,c1+j,(SELECT start_date FROM pools INNER JOIN tournaments ON tournament_id = tournaments.id WHERE pools.id=poolid),gamestart,1,s1,s2);
      SET j = j + 1;
    END WHILE;
    SET i = i + 1;
  END WHILE;
END;
$$

DELIMITER $$
-- XCL, 4.3.2107
-- A procedure that generates all games !! Assumes the pool ids start at 1 and are contiguous !!
CREATE PROCEDURE generateAllGames()
BEGIN
  DECLARE n INT DEFAULT (SELECT COUNT(id) FROM pools);
  DECLARE i INT DEFAULT 1;
  WHILE i <= n DO
    CALL generateGames(i);
    SET i = i + 1;
  END WHILE;
END;
$$
DELIMITER ;

CALL generateAllGames();

DROP PROCEDURE generateGames; -- cleanup
DROP PROCEDURE generateAllGames; -- cleanup
