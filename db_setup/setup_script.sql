CREATE DATABASE `checkers_data` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE checkers_data;
CREATE TABLE `games` (
  `game_id` int(11) NOT NULL,
  `red_player` int(11) DEFAULT NULL,
  `black_player` int(11) DEFAULT NULL,
  PRIMARY KEY (`game_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE `invites` (
  `invite_id` int(11) NOT NULL AUTO_INCREMENT,
  `invite_sender` int(11) DEFAULT NULL,
  `invite_recipient` int(11) DEFAULT NULL,
  `response` bit(1) DEFAULT b'0',
  `has_responded` bit(1) DEFAULT b'0',
  PRIMARY KEY (`invite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE `moves` (
  `move_id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) DEFAULT NULL,
  `x_start` tinyint(4) DEFAULT NULL,
  `y_start` tinyint(4) DEFAULT NULL,
  `x_end` tinyint(4) DEFAULT NULL,
  `y_end` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`move_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) DEFAULT NULL,
  `password` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
