CREATE SCHEMA IF NOT EXISTS `blog` DEFAULT CHARACTER SET utf8;

use blog;

CREATE TABLE IF NOT EXISTS `blog`.`post` (
`user_id` INT(11) NOT NULL,
`id` INT(11) NOT NULL,
`title` VARCHAR(100) NOT NULL,
`body` VARCHAR(300) NOT NULL,
PRIMARY KEY (`id`)) 
ENGINE=InnoDB
DEFAULT CHARACTER SET utf8;

CREATE TABLE IF NOT EXISTS `blog`.`comment` (
`post_id` INT(11) NOT NULL,
`id` INT(11) NOT NULL,
`name` VARCHAR(100) NOT NULL,
`email` VARCHAR(100) NOT NULL,
`body` VARCHAR(300) NOT NULL,
PRIMARY KEY (`id`),
CONSTRAINT `fk_comment_post` 
FOREIGN KEY (`post_id`) 
REFERENCES `blog`.`post` (`id`) 
ON DELETE NO ACTION
ON UPDATE NO ACTION)
ENGINE=InnoDB
DEFAULT CHARACTER SET utf8;