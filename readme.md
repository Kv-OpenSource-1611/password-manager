# Guide
 
System should have php version 7.1^ \
Wamp Or xammp server \

Run 127.0.0.1/phpmyadmin or localhost/phpmyadmin \

create database with name "core_php_test"

run following queries in sql section of phpmyadmin 

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1; \
\
and then
 
 CREATE TABLE IF NOT EXISTS `user_credentials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `url` text,
  `user_name` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

Set up project in you server and run 
http://localhost/dir_name 

All done. 

For the expected output video file is attached 