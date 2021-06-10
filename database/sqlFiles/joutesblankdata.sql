
INSERT INTO joutes.events (NAME) VALUES ('joutes 2018');

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

-- All password is set to "Admin"
INSERT INTO joutes.users (first_name, last_name ,username, password, email, role)
VALUES ('admin', 'admin' , 'admin','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'admin@admin.com', 'administrator'),
('Ahmed', 'Casey' , 'Ahmed','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Ahmed@Casey.com', 'participant'),
('Chester', 'Day' , 'Chester','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Ahmed@Day.com', 'participant'),
('test', 'test' , 'test','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'test@test.com', 'participant'),
('Riley', 'Garison' , 'Riley','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Riley@test.com', 'participant'),
('Duncan', 'Roy' , 'Duncan','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Duncan@test.com', 'participant'),
('Remedios', 'Black' , 'Remedios','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Remedios@test.com', 'participant'),
('Mark', 'Molina' , 'Mark','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Mark@test.com', 'participant'),
('Dana', 'Justice' , 'Dana','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Dana@test.com', 'participant');


INSERT INTO joutes.users (first_name, last_name ,username, password, email, role)
VALUES ('Allegra', 'Waller' , 'Allegra','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Allegra@admin.com', 'administrator'),
('Emery', 'Copeland' , 'Emery','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Emery@Casey.com', 'participant'),
('Illana', 'Mcgowan' , 'Illana','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Illana@Day.com', 'participant'),
('Magee', 'Bauer' , 'Magee','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Magee@test.com', 'participant'),
('Patricia', 'Briggs' , 'Patricia','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Patricia@test.com', 'participant'),
('Samuel', 'Meyers' , 'Samuel','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Samuel@test.com', 'participant'),
('Nelle', 'Holcomb' , 'Nelle','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Nelle@test.com', 'participant'),
('Shay', 'David' , 'Shay','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Shay@test.com', 'participant'),
('Brendan', 'Macdonald' , 'Brendan','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Brendan@test.com', 'participant'),
('Kai', 'Quinn' , 'Kai','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Kai@test.com', 'participant');


INSERT INTO joutes.users (first_name, last_name ,username, password, email, role)
VALUES ('Justin', 'Jones' , 'Justin','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Justin@admin.com', 'administrator'),
('Erich', 'Sheperd' , 'Erich','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Erich@Casey.com', 'participant'),
('Joseph', 'Compton' , 'Joseph','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Joseph@Day.com', 'participant'),
('Moses', 'Pope' , 'Moses','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Moses@test.com', 'participant'),
('Hedley', 'Tonton' , 'Hedley','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Hedley@test.com', 'participant'),
('Deborah', 'Wells' , 'Deborah','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Deborah@test.com', 'participant'),
('Kay', 'Heils' , 'Kay','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Kay@test.com', 'participant'),
('Dorothy', 'Joghny' , 'Dorothy','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Dorothy@test.com', 'participant'),
('Doris', 'Baird' , 'Doris','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Doris@test.com', 'participant'),
('Irene', 'Alaton' , 'Irene','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Irene@test.com', 'participant');



INSERT INTO joutes.users (first_name, last_name ,username, password, email, role)
VALUES ('Zorita', 'Ellis' , 'Zorita','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Zorita@admin.com', 'administrator'),
('Yen', 'Hale' , 'Yen','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Yen@Casey.com', 'participant'),
('Madison', 'Marshall' , 'Madison','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Madison@Day.com', 'participant'),
('Angela', 'Perry' , 'Angela','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Angela@test.com', 'participant'),
('Michael', 'Woodward' , 'Michael','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Michael@test.com', 'participant'),
('Karyn', 'Riddle' , 'Karyn','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Karyn@test.com', 'participant'),
('Carol', 'Lang' , 'Carol','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Carol@test.com', 'participant'),
('Malik', 'Padillia' , 'Malik','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Malik@test.com', 'participant'),
('Maxine', 'Rowland' , 'Maxine','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Maxine@test.com', 'participant'),
('Halee', 'Larson' , 'Halee','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Halee@test.com', 'participant');


INSERT INTO joutes.users (first_name, last_name ,username, password, email, role)
VALUES ('Tatyana', 'Rosario' , 'Tatyana','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Tatyana@admin.com', 'administrator'),
('Latifah', 'Jenkiry' , 'Latifah','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Latifah@Casey.com', 'participant'),
('Wynne', 'Rowload' , 'Wynne','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Wynne@Day.com', 'participant'),
('Nola', 'Nola' , 'Nola','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Nola@test.com', 'participant'),
('Nicole', 'WIlkys' , 'Nicole','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Nicole@test.com', 'participant'),
('Sybil', 'Murray' , 'Sybil','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Sybil@test.com', 'participant'),
('Cadman', 'Evans' , 'Cadman','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Cadman@test.com', 'participant'),
('Xenos', 'Kramer' , 'Xenos','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Xenos@test.com', 'participant'),
('Evan', 'Logan' , 'Evan','$2y$10$RsiBblUoNfis0/TAmWR3NuLQRUITxQbQmsaSAdCPyto1z4eUs4ZlW', 'Evan@test.com', 'participant');



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

-- Build 12 teams of 4 with first 48 users for beachvolley
INSERT INTO team_user (user_id, team_id, isCaptain) SELECT
                                                                    id,
                                                                    FLOOR((id + 3) / 4),
                                                                    (id % 4 = 0)
                                                                  FROM users
                                                                  WHERE id <= 48;


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


INSERT INTO `joutes`.`team_user` (`user_id`, `team_id`, `isCaptain`) VALUES ('2', '1', '1'), ('3', '2', '1');

