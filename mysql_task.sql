
CREATE TABLE `login_history` (
 `login_history_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `login_action` enum('login','logout') NOT NULL,
 `user_id` int(11) unsigned NOT NULL,
 PRIMARY KEY (`login_history_id`),
 KEY `ix_login_history_login_time` (`login_time`),
 KEY `ix_login_history_user_id` (`user_id`),
 CONSTRAINT `fk_login_history_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table holds users login history.';


-- I did not have dummy data to test my queries this is main idea.

-- 1#
SELECT user_id, MAX(logouts) FROM (
    SELECT user_id, COUNT('logout') as logouts, login_time
    FROM login_history
    WHERE WEEKDAY(login_time) = 2 AND YEAR(login_time) = 2012
    GROUP BY user_id
  ) as logout_cout GROUP BY MONTH(login_time);

-- 2#
SELECT user_id, MAX(logouts), DATE_FORMAT(login_time, '%Y%m') as login_date FROM (
    SELECT user_id, COUNT('logout') as logouts, login_time
    FROM login_history
    GROUP BY user_id, MONTH(login_time)
  ) as logout_cout GROUP BY MONTH(login_time);

-- 3#
SELECT user_id, COUNT(*) as actions FROM login_history GROUP BY user_id;