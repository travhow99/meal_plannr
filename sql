DROP TABLE IF EXISTS `users`;
 
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(32) DEFAULT NULL,
  `lname` varchar(64) DEFAULT NULL,
  `uname` varchar(64) DEFAULT NULL,
  `password` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE (`uname`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
