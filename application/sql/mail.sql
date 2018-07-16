
DROP TABLE IF EXISTS `user`
#
# Table Structure for table USER
#

CREATE TABLE `user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `fullname` VARCHAR(511) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `username` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `email` VARCHAR(255) NOT NULL ,
  `password_hash` VARCHAR(511) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;


DROP TABLE IF EXISTS `auth_tokens`
#
# Table Structure for table auth tokens
#
CREATE TABLE `auth_tokens` (
    `id` integer(11) not null AUTO_INCREMENT,
    `selector` char(255),
    `hashedValidator` char(255),
    `userid` integer(11) not null,
    PRIMARY KEY (`id`)
);