
DROP TABLE IF EXISTS `user`
#
# Table Structure for table USER
# User roles are the way to determine prevligies (0 as User, 1 Content Writer, 2 Site Admin)
#

CREATE TABLE `user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `fullname` VARCHAR(511) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `username` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `email` VARCHAR(255) NOT NULL ,
  `password_hash` VARCHAR(511) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;
# Generating first admin (username: Admin, password: admin)
INSERT INTO `user` (`id`, `fullname`, `username`, `email`, `role`, `password_hash`)
            VALUES (NULL, 'Admin', 'Admin', 'admin@upos.com', '3', '$2a$08$I1hwDNXMAGzBAdgVBpmQXOU3CPHCaqZC0EFLGPRA54lQoGIZXf6Le');



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


DROP TABLE IF EXISTS `product`
#
# Table Structure for table Product
#
CREATE TABLE `product` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `about` TEXT NOT NULL,
    `image` VARCHAR(1023) NOT NULL,
    `price` DOUBLE NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;

DROP TABLE IF EXISTS `user_product`
#
# Table Structure for table User_Product (Buy Operations)
#
CREATE TABLE `user_product` (
    `user_id` INT NOT NULL,
    `product_id` INT NOT NULL,
    `items` INT NOT NULL
) ENGINE = InnoDB;


DROP TABLE IF EXISTS `messages`
#
# Table Structure for table Messages
#
CREATE TABLE `messages` (
    `msg_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    `date` DATETIME NOT NULL,
    `message` TEXT NOT NULL,
    `by_user` TINYINT NOT NULL,
    PRIMARY KEY (`msg_id`)
) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;