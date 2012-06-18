CREATE USER 'membersonly'@'localhost' IDENTIFIED BY 'iR0pyjBt';

GRANT ALL PRIVILEGES ON membersonly.* TO 'membersonly'@'localhost' WITH GRANT OPTION;

CREATE DATABASE `membersonly`;

USE `membersonly`;

CREATE TABLE `user` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`username` varchar(32) NOT NULL DEFAULT '',
`password` varchar(128) NOT NULL DEFAULT '',
PRIMARY KEY (`id`),   UNIQUE KEY `username` (`username`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
