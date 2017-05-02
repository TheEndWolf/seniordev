-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema Pascal_DB
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `pascal_final_db` ;

-- -----------------------------------------------------
-- Schema Pascal_DB
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `pascal_final_db` DEFAULT CHARACTER SET utf8 ;
USE `pascal_final_db` ;

-- -----------------------------------------------------
-- Table `pascal_final_db`.`permission`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pascal_final_db`.`permission` (
  `permission_id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(45) NULL,
  `permission` INT NULL,
  PRIMARY KEY (`permission_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pascal_final_db`.`role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pascal_final_db`.`role` (
  `role_id` INT NOT NULL AUTO_INCREMENT,
  `role_name` VARCHAR(45) NULL,
  `permission_id` INT NOT NULL,
  PRIMARY KEY (`role_id`, `permission_id`),
  INDEX `fk_role_permission1_idx` (`permission_id` ASC),
  CONSTRAINT `fk_role_permission1`
    FOREIGN KEY (`permission_id`)
    REFERENCES `pascal_final_db`.`permission` (`permission_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pascal_final_db`.`program_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pascal_final_db`.`program_user` (
  `user_id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NULL,
  `user_password` CHAR(32) NULL,
  `first_name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NULL,
  `userEmail` VARCHAR(45) NULL DEFAULT NULL,
  `role_id` INT NOT NULL,
  PRIMARY KEY (`user_id`, `role_id`),
  INDEX `fk_user_role1_idx` (`role_id` ASC),
  CONSTRAINT `fk_user_role1`
    FOREIGN KEY (`role_id`)
    REFERENCES `pascal_final_db`.`role` (`role_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `pascal_final_db`.`section`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pascal_final_db`.`section` (
  `section_id` INT NOT NULL AUTO_INCREMENT,
  `section_number` INT NULL,
  `term` VARCHAR(45) NULL,
  `notes` VARCHAR(500) NULL,
  `date_delivered_by` DATE NULL,
  `user_id` INT(11) NOT NULL,
  PRIMARY KEY (`section_id`, `user_id`),
  INDEX `fk_section_program_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_section_program_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `pascal_final_db`.`program_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pascal_final_db`.`assessment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pascal_final_db`.`assessment` (
  `assessment_id` INT(11) NOT NULL AUTO_INCREMENT,
  `date_data_recieved` DATETIME NULL DEFAULT NULL,
  `course_assessment_item` VARCHAR(45) NULL,
  `expected_percent_achieved` INT(11) NULL DEFAULT NULL,
  `percent_students_achieved_obj` INT(11) NULL DEFAULT NULL,
  `over_this` INT NULL,
  `assessment_notes` VARCHAR(500) NULL,
  `deadline` DATE NULL,
  `taskStream_flag` INT NULL,
  `section_id` INT NOT NULL,
  PRIMARY KEY (`assessment_id`, `section_id`),
  INDEX `fk_assessment_section1_idx` (`section_id` ASC),
  CONSTRAINT `fk_assessment_section1`
    FOREIGN KEY (`section_id`)
    REFERENCES `pascal_final_db`.`section` (`section_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `pascal_final_db`.`program`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pascal_final_db`.`program` (
  `program_id` INT(11) NOT NULL AUTO_INCREMENT,
  `program_name` VARCHAR(45) NULL,
  `program_objective` VARCHAR(45) NULL DEFAULT NULL,
  `program_CoOrdinator` INT(11) NOT NULL,
  PRIMARY KEY (`program_id`, `program_CoOrdinator`),
  INDEX `fk_program_program_user1_idx` (`program_CoOrdinator` ASC),
  CONSTRAINT `fk_program_program_user1`
    FOREIGN KEY (`program_CoOrdinator`)
    REFERENCES `pascal_final_db`.`program_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `pascal_final_db`.`course`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pascal_final_db`.`course` (
  `course_id` INT(11) NOT NULL AUTO_INCREMENT,
  `course_name` VARCHAR(45) NULL,
  `course_number` INT(11) NULL,
  `flag` INT ZEROFILL NULL,
  `course_coOrdinator` INT(11) NOT NULL,
  `program_id` INT(11) NOT NULL,
  PRIMARY KEY (`course_id`, `course_coOrdinator`, `program_id`),
  INDEX `fk_course_program1_idx` (`program_id` ASC),
  INDEX `fk_course_program_user1_idx` (`course_coOrdinator` ASC),
  CONSTRAINT `fk_course_program1`
    FOREIGN KEY (`program_id`)
    REFERENCES `pascal_final_db`.`program` (`program_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_course_program_user1`
    FOREIGN KEY (`course_coOrdinator`)
    REFERENCES `pascal_final_db`.`program_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `pascal_final_db`.`grade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pascal_final_db`.`grade` (
  `grade_id` INT NOT NULL AUTO_INCREMENT,
  `charGrade` CHAR(2) NULL,
  `grade` INT NULL,
  PRIMARY KEY (`grade_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pascal_final_db`.`course_section`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pascal_final_db`.`course_section` (
  `course_id` INT(11) NOT NULL,
  `section_id` INT NOT NULL,
  PRIMARY KEY (`course_id`, `section_id`),
  INDEX `fk_course_has_section_section1_idx` (`section_id` ASC),
  INDEX `fk_course_has_section_course1_idx` (`course_id` ASC),
  CONSTRAINT `fk_course_has_section_course1`
    FOREIGN KEY (`course_id`)
    REFERENCES `pascal_final_db`.`course` (`course_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_course_has_section_section1`
    FOREIGN KEY (`section_id`)
    REFERENCES `pascal_final_db`.`section` (`section_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `pascal_final_db`.`course_Notes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pascal_final_db`.`course_Notes` (
  `idcourse_Notes` INT NOT NULL AUTO_INCREMENT,
  `notes` VARCHAR(255) NULL,
  `noteWrittenBy` VARCHAR(45) NULL,
  `course_id` INT(11) NOT NULL,
  PRIMARY KEY (`idcourse_Notes`, `course_id`),
  INDEX `fk_course_Notes_course1_idx` (`course_id` ASC),
  CONSTRAINT `fk_course_Notes_course1`
    FOREIGN KEY (`course_id`)
    REFERENCES `pascal_final_db`.`course` (`course_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pascal_final_db`.`Report`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pascal_final_db`.`Report` (
  `report_id` INT NOT NULL AUTO_INCREMENT,
  `programName` VARCHAR(45) NULL,
  `programObjective` VARCHAR(45) NULL,
  `courseName` VARCHAR(45) NULL,
  `term` INT NULL,
  `courseNumber` INT NULL,
  `section` INT NULL,
  `assessmentName` VARCHAR(45) NULL,
  `expectedPercentAchieved` INT NULL,
  `percent_students_achieved_obje` INT NULL,
  PRIMARY KEY (`report_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `pascal_final_db`.`section_grade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pascal_final_db`.`section_grade` (
  `section_id` INT NOT NULL,
  `grade_id` INT NOT NULL,
  PRIMARY KEY (`section_id`, `grade_id`),
  INDEX `fk_section_has_grade_grade1_idx` (`grade_id` ASC),
  INDEX `fk_section_has_grade_section1_idx` (`section_id` ASC),
  CONSTRAINT `fk_section_has_grade_section1`
    FOREIGN KEY (`section_id`)
    REFERENCES `pascal_final_db`.`section` (`section_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_section_has_grade_grade1`
    FOREIGN KEY (`grade_id`)
    REFERENCES `pascal_final_db`.`grade` (`grade_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
