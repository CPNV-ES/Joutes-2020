-- Script that creates fake results for the 'joutes' database
-- ==========================================================

use joutes;

-- Used to fake rankings for propagation to the next stages
CREATE TEMPORARY TABLE IF NOT EXISTS ranking(
    rank INT AUTO_INCREMENT PRIMARY KEY,
	pool_id INT,
    team_id INT
);

DELIMITER $$
-- XCL, 4.3.2107
-- A procedure that generates single games within a pool up to a certain time.
-- !! Assumes the contender ids of the pool are contiguous !!
CREATE PROCEDURE generateGames(IN poolid INT, IN current_time_of_day TIME)
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
      SET gamestart = addtime(pstart,maketime(deltat DIV 60, deltat MOD 60, 0));
      IF gamestart < current_time_of_day THEN -- generate a fake result
		IF rand() > 0.5 then -- contender 1 wins
			BEGIN
			  SET s1 = 15;
			  SET s2 = floor(5+8*rand());
			END;
		ELSE -- contender 2 wins
			BEGIN
			  SET s2 = 15;
			  SET s1 = floor(5+8*rand());
			END;
		END IF;
      ELSE
		  BEGIN
			  SET s1 = NULL;
			  SET s2 = NULL;
		  END;
	  END IF;
      INSERT INTO games (contender1_id, contender2_id, date, start_time, court_id, score_contender1, score_contender2) VALUES (c1+i,c1+j,(SELECT start_date FROM pools INNER JOIN tournaments ON tournament_id = tournaments.id WHERE pools.id=poolid),gamestart,1,s1,s2);
      SET j = j + 1;
    END WHILE;
    SET i = i + 1;
  END WHILE;
END;
$$

-- XCL, 29.5.2107
-- A procedure that turn implicit contenders into explicit ones, based on fake rankings
CREATE PROCEDURE makeExplicitContenders()
BEGIN
	DECLARE finished INTEGER DEFAULT 0;
    DECLARE pid INTEGER; -- Pool id
	DEClARE pools CURSOR FOR SELECT id FROM pools WHERE isFinished = 1 ORDER BY stage;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;
	OPEN pools;
	get_pool: LOOP -- Process all finished pools
		FETCH pools INTO pid;
		IF finished = 1 THEN
			LEAVE get_pool;
		END IF;
        -- Generate fake pool ranking
		TRUNCATE ranking;
        ALTER TABLE ranking AUTO_INCREMENT = 1;
        INSERT INTO ranking (pool_id,team_id) SELECT pool_id, team_id FROM contenders WHERE pool_id=pid;
        -- Use it to make explicit contenders
        UPDATE contenders INNER JOIN ranking ON contenders.pool_from_id = ranking.pool_id AND rank_in_pool=rank
		SET contenders.team_id = ranking.team_id;
	END LOOP get_pool;
	CLOSE pools;
END;
$$

-- XCL, 4.3.2107
-- A procedure that generates all games up to a certain point in time
-- !! Assumes the pool ids start at 1 and are contiguous !!
CREATE PROCEDURE generateAllGames(IN current_time_of_day TIME)
BEGIN
	DECLARE n INT DEFAULT (SELECT count(id) FROM pools);
	DECLARE i INT DEFAULT 1;
	WHILE i <= n DO
		CALL generateGames(i, current_time_of_day);
		SET i = i + 1;
	END WHILE;

	-- Mark finished pools (all games played) as such
	UPDATE pools
	SET isFinished = 1
	WHERE id NOT in
		(SELECT DISTINCT pool_id
		FROM contenders INNER JOIN games ON contenders.id = games.contender2_id
		WHERE score_contender2 IS NULL);
        
	CALL makeExplicitContenders();
END;
$$

DELIMITER ;

-- Pick one of the following
-- CALL generateAllGames(current_time());
-- CALL generateAllGames(maketime(9,30,0));
-- CALL generateAllGames(maketime(11,10,0));
-- CALL generateAllGames(maketime(14,40,0));
CALL generateAllGames(maketime(18,0,0));

-- Cleanup
DROP PROCEDURE makeExplicitContenders;
DROP PROCEDURE generateGames;
DROP PROCEDURE generateAllGames;
