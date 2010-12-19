SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `houseshare` ;
CREATE SCHEMA IF NOT EXISTS `houseshare` DEFAULT CHARACTER SET utf8 ;
USE `houseshare` ;

-- -----------------------------------------------------
-- Table `houseshare`.`STATE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`STATE` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`STATE` (
  `state_id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`state_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`CITY`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`CITY` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`CITY` (
  `city_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `state_id` INT NOT NULL ,
  PRIMARY KEY (`city_id`) ,
  INDEX `fk_CITY_STATE1` (`state_id` ASC) ,
  CONSTRAINT `fk_CITY_STATE1`
    FOREIGN KEY (`state_id` )
    REFERENCES `houseshare`.`STATE` (`state_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`ADDRESS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`ADDRESS` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`ADDRESS` (
  `addr_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `unit_no` INT NULL ,
  `street_no` VARCHAR(10) NOT NULL ,
  `street_name` VARCHAR(100) NOT NULL ,
  `zip` VARCHAR(20) NOT NULL ,
  `city_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`addr_id`) ,
  INDEX `fk_ADDRESS_CITY1` (`city_id` ASC) ,
  CONSTRAINT `fk_ADDRESS_CITY1`
    FOREIGN KEY (`city_id` )
    REFERENCES `houseshare`.`CITY` (`city_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`USER`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`USER` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`USER` (
  `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(85) NOT NULL ,
  `password` VARCHAR(65) NOT NULL ,
  `phone` VARCHAR(45) NULL ,
  `phone_public` TINYINT(1) NULL DEFAULT 0 ,
  `created` TIMESTAMP NULL ,
  PRIMARY KEY (`user_id`) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`ACCOMMODATION`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`ACCOMMODATION` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`ACCOMMODATION` (
  `acc_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `description` TEXT NOT NULL ,
  `addr_id` INT UNSIGNED NOT NULL ,
  `user_id` INT UNSIGNED NOT NULL ,
  `date_avaliable` DATE NOT NULL ,
  `price` INT UNSIGNED NOT NULL ,
  `created` TIMESTAMP NULL ,
  PRIMARY KEY (`acc_id`) ,
  INDEX `fk_ACCOMODATION_ADDRESS1` (`addr_id` ASC) ,
  INDEX `fk_ACCOMODATION_USER1` (`user_id` ASC) ,
  CONSTRAINT `fk_ACCOMODATION_ADDRESS1`
    FOREIGN KEY (`addr_id` )
    REFERENCES `houseshare`.`ADDRESS` (`addr_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ACCOMODATION_USER1`
    FOREIGN KEY (`user_id` )
    REFERENCES `houseshare`.`USER` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
PACK_KEYS = DEFAULT;


-- -----------------------------------------------------
-- Table `houseshare`.`ROOMATES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`ROOMATES` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`ROOMATES` (
  `roomates_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `no_roomates` TINYINT NOT NULL ,
  `min_age` TINYINT NOT NULL ,
  `max_age` TINYINT NOT NULL ,
  `gender` TINYINT NOT NULL ,
  PRIMARY KEY (`roomates_id`) )
ENGINE = InnoDB
COMMENT = 'Info about roomates';


-- -----------------------------------------------------
-- Table `houseshare`.`ROOM`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`ROOM` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`ROOM` (
  `acc_id` INT UNSIGNED NOT NULL ,
  `roomates_id` INT UNSIGNED NULL ,
  `private_bath` VARCHAR(45) NOT NULL ,
  `private_balcony` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`acc_id`) ,
  INDEX `fk_ROOM_ROOMATES1` (`roomates_id` ASC) ,
  CONSTRAINT `fk_ROOM_ACCOMODATION`
    FOREIGN KEY (`acc_id` )
    REFERENCES `houseshare`.`ACCOMMODATION` (`acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ROOM_ROOMATES1`
    FOREIGN KEY (`roomates_id` )
    REFERENCES `houseshare`.`ROOMATES` (`roomates_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`BED`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`BED` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`BED` (
  `acc_id` INT UNSIGNED NOT NULL ,
  `roomates_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`acc_id`) ,
  INDEX `fk_BED_ROOMATES1` (`roomates_id` ASC) ,
  CONSTRAINT `fk_BED_ACCOMODATION1`
    FOREIGN KEY (`acc_id` )
    REFERENCES `houseshare`.`ACCOMMODATION` (`acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_BED_ROOMATES1`
    FOREIGN KEY (`roomates_id` )
    REFERENCES `houseshare`.`ROOMATES` (`roomates_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`APPARTMENT`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`APPARTMENT` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`APPARTMENT` (
  `acc_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`acc_id`) ,
  INDEX `fk_APPARTMENT_ACCOMODATION1` (`acc_id` ASC) ,
  CONSTRAINT `fk_APPARTMENT_ACCOMODATION1`
    FOREIGN KEY (`acc_id` )
    REFERENCES `houseshare`.`ACCOMMODATION` (`acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`HOUSE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`HOUSE` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`HOUSE` (
  `acc_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`acc_id`) ,
  CONSTRAINT `fk_HOUSE_ACCOMODATION1`
    FOREIGN KEY (`acc_id` )
    REFERENCES `houseshare`.`ACCOMMODATION` (`acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`FEATURE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`FEATURE` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`FEATURE` (
  `feat_id` INT UNSIGNED NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`feat_id`) )
ENGINE = InnoDB
COMMENT = 'e.g. parking, internet, cable_tv, air_conditioning';


-- -----------------------------------------------------
-- Table `houseshare`.`ACCOMODATION_has_FEATURE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`ACCOMODATION_has_FEATURE` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`ACCOMODATION_has_FEATURE` (
  `acc_id` INT UNSIGNED NOT NULL ,
  `feat_id` INT UNSIGNED NOT NULL ,
  `value` TINYINT(3) NOT NULL ,
  PRIMARY KEY (`acc_id`, `feat_id`) ,
  INDEX `fk_ACCOMODATION_has_FEATURE_FEATURE1` (`feat_id` ASC) ,
  CONSTRAINT `fk_ACCOMODATION_has_FEATURE_ACCOMODATION1`
    FOREIGN KEY (`acc_id` )
    REFERENCES `houseshare`.`ACCOMMODATION` (`acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ACCOMODATION_has_FEATURE_FEATURE1`
    FOREIGN KEY (`feat_id` )
    REFERENCES `houseshare`.`FEATURE` (`feat_id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`PHOTO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`PHOTO` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`PHOTO` (
  `photo_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `filename` VARCHAR(45) NOT NULL ,
  `path` VARCHAR(200) NOT NULL ,
  `acc_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`photo_id`) ,
  INDEX `fk_PHOTO_ACCOMODATION1` (`acc_id` ASC) ,
  CONSTRAINT `fk_PHOTO_ACCOMODATION1`
    FOREIGN KEY (`acc_id` )
    REFERENCES `houseshare`.`ACCOMMODATION` (`acc_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`PREFERENCE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`PREFERENCE` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`PREFERENCE` (
  `pref_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`pref_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`ACCOMODATION_has_PREFERENCE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`ACCOMODATION_has_PREFERENCE` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`ACCOMODATION_has_PREFERENCE` (
  `acc_id` INT UNSIGNED NOT NULL ,
  `pref_id` INT UNSIGNED NOT NULL ,
  `value` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`acc_id`, `pref_id`) ,
  INDEX `fk_ACCOMODATION_has_PREFERENCE_PREFERENCE1` (`pref_id` ASC) ,
  CONSTRAINT `fk_ACCOMODATION_has_PREFERENCE_ACCOMODATION1`
    FOREIGN KEY (`acc_id` )
    REFERENCES `houseshare`.`ACCOMMODATION` (`acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ACCOMODATION_has_PREFERENCE_PREFERENCE1`
    FOREIGN KEY (`pref_id` )
    REFERENCES `houseshare`.`PREFERENCE` (`pref_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`ROOMATE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`ROOMATE` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`ROOMATE` (
  `user_id` INT UNSIGNED NOT NULL ,
  `is_owner` BIT NOT NULL ,
  PRIMARY KEY (`user_id`) ,
  CONSTRAINT `fk_ROOMATE_USER1`
    FOREIGN KEY (`user_id` )
    REFERENCES `houseshare`.`USER` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`LOOKER`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`LOOKER` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`LOOKER` (
  `user_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`user_id`) ,
  CONSTRAINT `fk_LOOKER_USER1`
    FOREIGN KEY (`user_id` )
    REFERENCES `houseshare`.`USER` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'A person looking for accomodation.';


-- -----------------------------------------------------
-- Table `houseshare`.`AGENT`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`AGENT` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`AGENT` (
  `user_id` INT UNSIGNED NOT NULL ,
  `agancy_name` VARCHAR(100) NOT NULL ,
  `addr_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`user_id`) ,
  INDEX `fk_AGENT_ADDRESS1` (`addr_id` ASC) ,
  CONSTRAINT `fk_AGENT_USER1`
    FOREIGN KEY (`user_id` )
    REFERENCES `houseshare`.`USER` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_AGENT_ADDRESS1`
    FOREIGN KEY (`addr_id` )
    REFERENCES `houseshare`.`ADDRESS` (`addr_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`CHARACTERISTIC`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`CHARACTERISTIC` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`CHARACTERISTIC` (
  `charac_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`charac_id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`OWNER`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`OWNER` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`OWNER` (
  `user_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`user_id`) ,
  CONSTRAINT `fk_OWNER_USER1`
    FOREIGN KEY (`user_id` )
    REFERENCES `houseshare`.`USER` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`LOOKER_has_CHARACTERISTIC`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`LOOKER_has_CHARACTERISTIC` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`LOOKER_has_CHARACTERISTIC` (
  `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `charac_id` INT UNSIGNED NOT NULL ,
  `value` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`user_id`, `charac_id`) ,
  INDEX `fk_LOOKER_has_CHARACTERISTIC_CHARACTERISTIC1` (`charac_id` ASC) ,
  CONSTRAINT `fk_LOOKER_has_CHARACTERISTIC_LOOKER1`
    FOREIGN KEY (`user_id` )
    REFERENCES `houseshare`.`LOOKER` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_LOOKER_has_CHARACTERISTIC_CHARACTERISTIC1`
    FOREIGN KEY (`charac_id` )
    REFERENCES `houseshare`.`CHARACTERISTIC` (`charac_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
PACK_KEYS = DEFAULT;


-- -----------------------------------------------------
-- Table `houseshare`.`ROOMATE_has_CHARACTERISTIC`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`ROOMATE_has_CHARACTERISTIC` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`ROOMATE_has_CHARACTERISTIC` (
  `ROOMATE_user_id` INT UNSIGNED NOT NULL ,
  `CHARACTERISTIC_charac_id` INT UNSIGNED NOT NULL ,
  `value` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`ROOMATE_user_id`, `CHARACTERISTIC_charac_id`) ,
  INDEX `fk_ROOMATE_has_CHARACTERISTIC_CHARACTERISTIC1` (`CHARACTERISTIC_charac_id` ASC) ,
  CONSTRAINT `fk_ROOMATE_has_CHARACTERISTIC_ROOMATE1`
    FOREIGN KEY (`ROOMATE_user_id` )
    REFERENCES `houseshare`.`ROOMATE` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ROOMATE_has_CHARACTERISTIC_CHARACTERISTIC1`
    FOREIGN KEY (`CHARACTERISTIC_charac_id` )
    REFERENCES `houseshare`.`CHARACTERISTIC` (`charac_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`ACCOMMODATION_TYPE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`ACCOMMODATION_TYPE` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`ACCOMMODATION_TYPE` (
  `acc_type_id` INT UNSIGNED NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`acc_type_id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`WANTED_ACCOMMODATION`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`WANTED_ACCOMMODATION` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`WANTED_ACCOMMODATION` (
  `wanted_acc_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `max_price` INT UNSIGNED NOT NULL ,
  `acc_type_id` INT UNSIGNED NOT NULL ,
  `user_id` INT UNSIGNED NOT NULL ,
  `title` VARCHAR(255) NOT NULL ,
  `description` TEXT NOT NULL ,
  `city_id` INT UNSIGNED NOT NULL ,
  `created` TIMESTAMP NULL ,
  PRIMARY KEY (`wanted_acc_id`) ,
  INDEX `fk_WANTED_ACCOMMODATION_ACCOMMODATION_TYPE1` (`acc_type_id` ASC) ,
  INDEX `fk_WANTED_ACCOMMODATION_LOOKER1` (`user_id` ASC) ,
  INDEX `fk_WANTED_ACCOMMODATION_CITY1` (`city_id` ASC) ,
  CONSTRAINT `fk_WANTED_ACCOMMODATION_ACCOMMODATION_TYPE1`
    FOREIGN KEY (`acc_type_id` )
    REFERENCES `houseshare`.`ACCOMMODATION_TYPE` (`acc_type_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_WANTED_ACCOMMODATION_LOOKER1`
    FOREIGN KEY (`user_id` )
    REFERENCES `houseshare`.`LOOKER` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_WANTED_ACCOMMODATION_CITY1`
    FOREIGN KEY (`city_id` )
    REFERENCES `houseshare`.`CITY` (`city_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`WANTED_ACCOMMODATION_has_FEATURE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`WANTED_ACCOMMODATION_has_FEATURE` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`WANTED_ACCOMMODATION_has_FEATURE` (
  `wanted_acc_id` INT UNSIGNED NOT NULL ,
  `feat_id` INT UNSIGNED NOT NULL ,
  `value` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`wanted_acc_id`, `feat_id`) ,
  INDEX `fk_WANTED_ACCOMMODATION_has_FEATURE_FEATURE1` (`feat_id` ASC) ,
  CONSTRAINT `fk_WANTED_ACCOMMODATION_has_FEATURE_WANTED_ACCOMMODATION1`
    FOREIGN KEY (`wanted_acc_id` )
    REFERENCES `houseshare`.`WANTED_ACCOMMODATION` (`wanted_acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_WANTED_ACCOMMODATION_has_FEATURE_FEATURE1`
    FOREIGN KEY (`feat_id` )
    REFERENCES `houseshare`.`FEATURE` (`feat_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`WANTED_ROOM`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`WANTED_ROOM` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`WANTED_ROOM` (
  `wanted_acc_id` INT UNSIGNED NOT NULL ,
  `roomates_id` INT UNSIGNED NULL ,
  PRIMARY KEY (`wanted_acc_id`) ,
  INDEX `fk_WANTED_ROOM_ROOMATES1` (`roomates_id` ASC) ,
  CONSTRAINT `fk_WANTED_ROOM_WANTED_ACCOMMODATION1`
    FOREIGN KEY (`wanted_acc_id` )
    REFERENCES `houseshare`.`WANTED_ACCOMMODATION` (`wanted_acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_WANTED_ROOM_ROOMATES1`
    FOREIGN KEY (`roomates_id` )
    REFERENCES `houseshare`.`ROOMATES` (`roomates_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`WANTED_BED`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`WANTED_BED` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`WANTED_BED` (
  `wanted_acc_id` INT UNSIGNED NOT NULL ,
  `roomates_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`wanted_acc_id`) ,
  INDEX `fk_WANTED_BED_ROOMATES1` (`roomates_id` ASC) ,
  CONSTRAINT `fk_WANTED_BED_WANTED_ACCOMMODATION1`
    FOREIGN KEY (`wanted_acc_id` )
    REFERENCES `houseshare`.`WANTED_ACCOMMODATION` (`wanted_acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_WANTED_BED_ROOMATES1`
    FOREIGN KEY (`roomates_id` )
    REFERENCES `houseshare`.`ROOMATES` (`roomates_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`ROOM_FEATURES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`ROOM_FEATURES` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`ROOM_FEATURES` (
  `room_feat_id` INT UNSIGNED NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`room_feat_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`ROOM_has_ROOM_FEATURES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`ROOM_has_ROOM_FEATURES` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`ROOM_has_ROOM_FEATURES` (
  `room_feat_id` INT UNSIGNED NOT NULL ,
  `acc_id` INT UNSIGNED NOT NULL ,
  `value` TINYINT NOT NULL ,
  PRIMARY KEY (`room_feat_id`, `acc_id`) ,
  INDEX `fk_ROOM_FEATURES_has_ROOM_ROOM1` (`acc_id` ASC) ,
  CONSTRAINT `fk_ROOM_FEATURES_has_ROOM_ROOM_FEATURES1`
    FOREIGN KEY (`room_feat_id` )
    REFERENCES `houseshare`.`ROOM_FEATURES` (`room_feat_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ROOM_FEATURES_has_ROOM_ROOM1`
    FOREIGN KEY (`acc_id` )
    REFERENCES `houseshare`.`ROOM` (`acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`WANTED_ROOM_has_ROOM_FEATURES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`WANTED_ROOM_has_ROOM_FEATURES` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`WANTED_ROOM_has_ROOM_FEATURES` (
  `room_feat_id` INT UNSIGNED NOT NULL ,
  `wanted_acc_id` INT UNSIGNED NOT NULL ,
  `value` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`room_feat_id`, `wanted_acc_id`) ,
  INDEX `fk_ROOM_FEATURES_has_WANTED_ROOM_WANTED_ROOM1` (`wanted_acc_id` ASC) ,
  CONSTRAINT `fk_ROOM_FEATURES_has_WANTED_ROOM_ROOM_FEATURES1`
    FOREIGN KEY (`room_feat_id` )
    REFERENCES `houseshare`.`ROOM_FEATURES` (`room_feat_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ROOM_FEATURES_has_WANTED_ROOM_WANTED_ROOM1`
    FOREIGN KEY (`wanted_acc_id` )
    REFERENCES `houseshare`.`WANTED_ROOM` (`wanted_acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`BED_FEATURE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`BED_FEATURE` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`BED_FEATURE` (
  `bead_feat_id` INT UNSIGNED NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`bead_feat_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`BED_has_BED_FEATURE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`BED_has_BED_FEATURE` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`BED_has_BED_FEATURE` (
  `acc_id` INT UNSIGNED NOT NULL ,
  `bed_feat_id` INT UNSIGNED NOT NULL ,
  `value` TINYINT NOT NULL ,
  PRIMARY KEY (`acc_id`, `bed_feat_id`) ,
  INDEX `fk_BED_has_BED_FEATURE_BED_FEATURE1` (`bed_feat_id` ASC) ,
  CONSTRAINT `fk_BED_has_BED_FEATURE_BED1`
    FOREIGN KEY (`acc_id` )
    REFERENCES `houseshare`.`BED` (`acc_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_BED_has_BED_FEATURE_BED_FEATURE1`
    FOREIGN KEY (`bed_feat_id` )
    REFERENCES `houseshare`.`BED_FEATURE` (`bead_feat_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `houseshare`.`WANTED_BED_has_BED_FEATURE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `houseshare`.`WANTED_BED_has_BED_FEATURE` ;

CREATE  TABLE IF NOT EXISTS `houseshare`.`WANTED_BED_has_BED_FEATURE` (
  `wanted_acc_id` INT UNSIGNED NOT NULL ,
  `bed_feat_id` INT UNSIGNED NOT NULL ,
  `value` TINYINT NOT NULL ,
  PRIMARY KEY (`wanted_acc_id`, `bed_feat_id`) ,
  INDEX `fk_WANTED_BED_has_BED_FEATURE_BED_FEATURE1` (`bed_feat_id` ASC) ,
  CONSTRAINT `fk_WANTED_BED_has_BED_FEATURE_WANTED_BED1`
    FOREIGN KEY (`wanted_acc_id` )
    REFERENCES `houseshare`.`WANTED_BED` (`wanted_acc_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_WANTED_BED_has_BED_FEATURE_BED_FEATURE1`
    FOREIGN KEY (`bed_feat_id` )
    REFERENCES `houseshare`.`BED_FEATURE` (`bead_feat_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Placeholder table for view `houseshare`.`VIEW_CITY`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `houseshare`.`VIEW_CITY` (`city_id` INT, `city_name` INT, `state_id` INT, `state_name` INT);

-- -----------------------------------------------------
-- View `houseshare`.`VIEW_CITY`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `houseshare`.`VIEW_CITY` ;
DROP TABLE IF EXISTS `houseshare`.`VIEW_CITY`;
USE `houseshare`;
CREATE  OR REPLACE VIEW `houseshare`.`VIEW_CITY` AS
SELECT c.`city_id`,  c.`name` as `city_name`, c.`state_id`, s.`name` as `state_name` 
FROM `CITY` c 
INNER JOIN `STATE` s USING (`state_id`);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `houseshare`.`STATE`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `houseshare`;
INSERT INTO `houseshare`.`STATE` (`state_id`, `name`) VALUES (NULL, 'Malopolska');
INSERT INTO `houseshare`.`STATE` (`state_id`, `name`) VALUES (NULL, 'Dolnyslask');
INSERT INTO `houseshare`.`STATE` (`state_id`, `name`) VALUES (NULL, 'Mazowieckie');

COMMIT;

-- -----------------------------------------------------
-- Data for table `houseshare`.`CITY`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `houseshare`;
INSERT INTO `houseshare`.`CITY` (`city_id`, `name`, `state_id`) VALUES (1, 'Wroclaw', 2);
INSERT INTO `houseshare`.`CITY` (`city_id`, `name`, `state_id`) VALUES (2, 'Krakow', 1);
INSERT INTO `houseshare`.`CITY` (`city_id`, `name`, `state_id`) VALUES (3, 'Nowy Targ', 1);

COMMIT;
