CREATE SCHEMA `Questionnaire` ;

CREATE TABLE `Questionnaire`.`questions_table` (
  
	`id` INT NOT NULL AUTO_INCREMENT,
  
	`subject` VARCHAR(100) NOT NULL,
  
	`question` VARCHAR(5000) NOT NULL,
  
	`time` TIMESTAMP NOT NULL,
  
	`answered` INT NOT NULL,
  
	PRIMARY KEY (`id`));
