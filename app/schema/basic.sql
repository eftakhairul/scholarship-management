--  Eftakhairul Islam < eftakhairul@gmail.com> http://eftakhairul.com
-- 11 January, 2012

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE IF NOT EXISTS `cgpas` (
  `cgpa_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `cgpa_name` float NOT NULL,
  `cgpa_percentage` float NOT NULL,
  PRIMARY KEY (`cgpa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `programs` (
  `program_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `code` tinyint(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `department` varchar(10) NOT NULL,
  PRIMARY KEY (`program_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `scholarships` (
  `scholarship_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(10) NOT NULL,
  `semester` tinyint(2) NOT NULL,
  `year` varchar(4) NOT NULL,
  `award` float NOT NULL,
  PRIMARY KEY (`scholarship_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `id` varchar(10) NOT NULL,
  `applicant_id` varchar(10) NOT NULL,
  `sex` tinyint(4) NOT NULL,
  `last_semester_credit` float NOT NULL,
  `current_semester_credit` float NOT NULL,
  `arch_lecture_credit` float NOT NULL,
  `arch_studio_credit` float NOT NULL,
  `credit_requirement` float NOT NULL,
  `credit_completed` float NOT NULL,
  `gpa` float NOT NULL,
  `cgpa` float NOT NULL,
  `retake` tinyint(4) NOT NULL,
  `mobile_no` varchar(12) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(35) CHARACTER SET utf8 NOT NULL,
  `types` varchar(15) CHARACTER SET utf8 NOT NULL,
  `facebook_username` varchar(100) DEFAULT NULL,
  `api_key` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  KEY `types` (`types`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `user_types` (
  `types` varchar(15) NOT NULL,
  PRIMARY KEY (`types`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`types`) REFERENCES `user_types` (`types`) ON DELETE CASCADE ON UPDATE CASCADE;

