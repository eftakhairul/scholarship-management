--  Eftakhairul Islam < eftakhairul@gmail.com> http://eftakhairul.com
-- 11 January, 2011

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

INSERT INTO `user_types` (`types`) VALUES
('admin'),
('user');

INSERT INTO `users` (`user_id`, `username`, `password`, `types`, `created_date`, `modified_date`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin', '2012-01-01', '0000-00-00 00:00:00');



SET FOREIGN_KEY_CHECKS=1;