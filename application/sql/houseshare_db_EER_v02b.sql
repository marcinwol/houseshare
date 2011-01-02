SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


-- -----------------------------------------------------
-- Table `STATE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `STATE` ;

CREATE  TABLE IF NOT EXISTS `STATE` (
  `state_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`state_id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CITY`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `CITY` ;

CREATE  TABLE IF NOT EXISTS `CITY` (
  `city_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `state_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`city_id`) ,
  INDEX `fk_CITY_STATE1` (`state_id` ASC) ,
  UNIQUE INDEX `UNIQUE_CITY` (`name` ASC, `state_id` ASC) ,
  CONSTRAINT `fk_CITY_STATE1`
    FOREIGN KEY (`state_id` )
    REFERENCES `STATE` (`state_id` )
    ON DELETE RESTRICT
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `STREET`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `STREET` ;

CREATE  TABLE IF NOT EXISTS `STREET` (
  `street_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`street_id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ZIP`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ZIP` ;

CREATE  TABLE IF NOT EXISTS `ZIP` (
  `zip_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `value` VARCHAR(20) NOT NULL ,
  PRIMARY KEY (`zip_id`) ,
  UNIQUE INDEX `value_UNIQUE` (`value` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ADDRESS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ADDRESS` ;

CREATE  TABLE IF NOT EXISTS `ADDRESS` (
  `addr_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `unit_no` VARCHAR(10) NOT NULL ,
  `street_no` VARCHAR(10) NOT NULL ,
  `city_id` INT UNSIGNED NOT NULL ,
  `street_id` INT UNSIGNED NOT NULL ,
  `zip_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`addr_id`) ,
  INDEX `fk_ADDRESS_CITY1` (`city_id` ASC) ,
  UNIQUE INDEX `UNIQUE_ADDRESS` (`unit_no` ASC, `street_no` ASC, `city_id` ASC, `street_id` ASC, `zip_id` ASC) ,
  INDEX `fk_ADDRESS_STREET1` (`street_id` ASC) ,
  INDEX `fk_ADDRESS_ZIP1` (`zip_id` ASC) ,
  CONSTRAINT `fk_ADDRESS_CITY1`
    FOREIGN KEY (`city_id` )
    REFERENCES `CITY` (`city_id` )
    ON DELETE RESTRICT
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ADDRESS_STREET1`
    FOREIGN KEY (`street_id` )
    REFERENCES `STREET` (`street_id` )
    ON DELETE RESTRICT
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ADDRESS_ZIP1`
    FOREIGN KEY (`zip_id` )
    REFERENCES `ZIP` (`zip_id` )
    ON DELETE RESTRICT
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `USER`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `USER` ;

CREATE  TABLE IF NOT EXISTS `USER` (
  `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(85) NOT NULL ,
  `password` VARCHAR(65) NOT NULL ,
  `phone` VARCHAR(45) NULL ,
  `phone_public` TINYINT(1) NOT NULL DEFAULT 0 ,
  `created` TIMESTAMP NULL ,
  `first_name` VARCHAR(45) NOT NULL ,
  `last_name` VARCHAR(45) NOT NULL ,
  `last_name_public` TINYINT(1) NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`user_id`) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ACCOMMODATION`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ACCOMMODATION` ;

CREATE  TABLE IF NOT EXISTS `ACCOMMODATION` (
  `acc_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `description` TEXT NOT NULL ,
  `addr_id` INT UNSIGNED NOT NULL ,
  `user_id` INT UNSIGNED NOT NULL ,
  `date_avaliable` DATE NOT NULL ,
  `price` INT UNSIGNED NOT NULL ,
  `created` TIMESTAMP NULL ,
  `bond` INT UNSIGNED NULL ,
  `street_address_public` TINYINT(1) NOT NULL DEFAULT 0 ,
  `short_term_ok` TINYINT(1) NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`acc_id`) ,
  INDEX `fk_ACCOMODATION_ADDRESS1` (`addr_id` ASC) ,
  INDEX `fk_ACCOMODATION_USER1` (`user_id` ASC) ,
  CONSTRAINT `fk_ACCOMODATION_ADDRESS1`
    FOREIGN KEY (`addr_id` )
    REFERENCES `ADDRESS` (`addr_id` )
    ON DELETE RESTRICT
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ACCOMODATION_USER1`
    FOREIGN KEY (`user_id` )
    REFERENCES `USER` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
PACK_KEYS = DEFAULT;


-- -----------------------------------------------------
-- Table `ROOMATES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ROOMATES` ;

CREATE  TABLE IF NOT EXISTS `ROOMATES` (
  `roomates_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `no_roomates` TINYINT NOT NULL ,
  `min_age` TINYINT NOT NULL ,
  `max_age` TINYINT NOT NULL ,
  `gender` TINYINT NOT NULL ,
  PRIMARY KEY (`roomates_id`) )
ENGINE = InnoDB
COMMENT = 'Info about roomates';


-- -----------------------------------------------------
-- Table `ROOM`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ROOM` ;

CREATE  TABLE IF NOT EXISTS `ROOM` (
  `acc_id` INT UNSIGNED NOT NULL ,
  `roomates_id` INT UNSIGNED NULL ,
  `private_bath` VARCHAR(45) NOT NULL ,
  `private_balcony` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`acc_id`) ,
  INDEX `fk_ROOM_ROOMATES1` (`roomates_id` ASC) ,
  CONSTRAINT `fk_ROOM_ACCOMODATION`
    FOREIGN KEY (`acc_id` )
    REFERENCES `ACCOMMODATION` (`acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ROOM_ROOMATES1`
    FOREIGN KEY (`roomates_id` )
    REFERENCES `ROOMATES` (`roomates_id` )
    ON DELETE RESTRICT
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BED`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `BED` ;

CREATE  TABLE IF NOT EXISTS `BED` (
  `acc_id` INT UNSIGNED NOT NULL ,
  `roomates_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`acc_id`) ,
  INDEX `fk_BED_ROOMATES1` (`roomates_id` ASC) ,
  CONSTRAINT `fk_BED_ACCOMODATION1`
    FOREIGN KEY (`acc_id` )
    REFERENCES `ACCOMMODATION` (`acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_BED_ROOMATES1`
    FOREIGN KEY (`roomates_id` )
    REFERENCES `ROOMATES` (`roomates_id` )
    ON DELETE RESTRICT
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `APPARTMENT`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `APPARTMENT` ;

CREATE  TABLE IF NOT EXISTS `APPARTMENT` (
  `acc_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`acc_id`) ,
  INDEX `fk_APPARTMENT_ACCOMODATION1` (`acc_id` ASC) ,
  CONSTRAINT `fk_APPARTMENT_ACCOMODATION1`
    FOREIGN KEY (`acc_id` )
    REFERENCES `ACCOMMODATION` (`acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `HOUSE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `HOUSE` ;

CREATE  TABLE IF NOT EXISTS `HOUSE` (
  `acc_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`acc_id`) ,
  CONSTRAINT `fk_HOUSE_ACCOMODATION1`
    FOREIGN KEY (`acc_id` )
    REFERENCES `ACCOMMODATION` (`acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `FEATURE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `FEATURE` ;

CREATE  TABLE IF NOT EXISTS `FEATURE` (
  `feat_id` INT UNSIGNED NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `binary` TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'To indicate whether \na feature is no/yes\nonly.' ,
  PRIMARY KEY (`feat_id`) )
ENGINE = InnoDB
COMMENT = 'e.g. parking, internet, cable_tv, air_conditioning';


-- -----------------------------------------------------
-- Table `ACCOMODATION_has_FEATURE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ACCOMODATION_has_FEATURE` ;

CREATE  TABLE IF NOT EXISTS `ACCOMODATION_has_FEATURE` (
  `acc_id` INT UNSIGNED NOT NULL ,
  `feat_id` INT UNSIGNED NOT NULL ,
  `value` TINYINT(3) NOT NULL ,
  PRIMARY KEY (`acc_id`, `feat_id`) ,
  INDEX `fk_ACCOMODATION_has_FEATURE_FEATURE1` (`feat_id` ASC) ,
  CONSTRAINT `fk_ACCOMODATION_has_FEATURE_ACCOMODATION1`
    FOREIGN KEY (`acc_id` )
    REFERENCES `ACCOMMODATION` (`acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ACCOMODATION_has_FEATURE_FEATURE1`
    FOREIGN KEY (`feat_id` )
    REFERENCES `FEATURE` (`feat_id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PHOTO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PHOTO` ;

CREATE  TABLE IF NOT EXISTS `PHOTO` (
  `photo_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `filename` VARCHAR(45) NOT NULL ,
  `path` VARCHAR(200) NOT NULL ,
  `acc_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`photo_id`) ,
  INDEX `fk_PHOTO_ACCOMODATION1` (`acc_id` ASC) ,
  CONSTRAINT `fk_PHOTO_ACCOMODATION1`
    FOREIGN KEY (`acc_id` )
    REFERENCES `ACCOMMODATION` (`acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PREFERENCE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PREFERENCE` ;

CREATE  TABLE IF NOT EXISTS `PREFERENCE` (
  `pref_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `binary` TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'This indicates whether\nthe preference is \nonly yes/no type.' ,
  PRIMARY KEY (`pref_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ACCOMODATION_has_PREFERENCE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ACCOMODATION_has_PREFERENCE` ;

CREATE  TABLE IF NOT EXISTS `ACCOMODATION_has_PREFERENCE` (
  `acc_id` INT UNSIGNED NOT NULL ,
  `pref_id` INT UNSIGNED NOT NULL ,
  `value` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`acc_id`, `pref_id`) ,
  INDEX `fk_ACCOMODATION_has_PREFERENCE_PREFERENCE1` (`pref_id` ASC) ,
  CONSTRAINT `fk_ACCOMODATION_has_PREFERENCE_ACCOMODATION1`
    FOREIGN KEY (`acc_id` )
    REFERENCES `ACCOMMODATION` (`acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ACCOMODATION_has_PREFERENCE_PREFERENCE1`
    FOREIGN KEY (`pref_id` )
    REFERENCES `PREFERENCE` (`pref_id` )
    ON DELETE RESTRICT
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ROOMATE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ROOMATE` ;

CREATE  TABLE IF NOT EXISTS `ROOMATE` (
  `user_id` INT UNSIGNED NOT NULL ,
  `is_owner` BIT NOT NULL ,
  PRIMARY KEY (`user_id`) ,
  CONSTRAINT `fk_ROOMATE_USER1`
    FOREIGN KEY (`user_id` )
    REFERENCES `USER` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `LOOKER`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `LOOKER` ;

CREATE  TABLE IF NOT EXISTS `LOOKER` (
  `user_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`user_id`) ,
  CONSTRAINT `fk_LOOKER_USER1`
    FOREIGN KEY (`user_id` )
    REFERENCES `USER` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'A person looking for accomodation.';


-- -----------------------------------------------------
-- Table `AGENT`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AGENT` ;

CREATE  TABLE IF NOT EXISTS `AGENT` (
  `user_id` INT UNSIGNED NOT NULL ,
  `agancy_name` VARCHAR(100) NOT NULL ,
  `addr_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`user_id`) ,
  INDEX `fk_AGENT_ADDRESS1` (`addr_id` ASC) ,
  CONSTRAINT `fk_AGENT_USER1`
    FOREIGN KEY (`user_id` )
    REFERENCES `USER` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_AGENT_ADDRESS1`
    FOREIGN KEY (`addr_id` )
    REFERENCES `ADDRESS` (`addr_id` )
    ON DELETE RESTRICT
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `CHARACTERISTIC`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `CHARACTERISTIC` ;

CREATE  TABLE IF NOT EXISTS `CHARACTERISTIC` (
  `charac_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`charac_id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `OWNER`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `OWNER` ;

CREATE  TABLE IF NOT EXISTS `OWNER` (
  `user_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`user_id`) ,
  CONSTRAINT `fk_OWNER_USER1`
    FOREIGN KEY (`user_id` )
    REFERENCES `USER` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `LOOKER_has_CHARACTERISTIC`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `LOOKER_has_CHARACTERISTIC` ;

CREATE  TABLE IF NOT EXISTS `LOOKER_has_CHARACTERISTIC` (
  `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `charac_id` INT UNSIGNED NOT NULL ,
  `value` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`user_id`, `charac_id`) ,
  INDEX `fk_LOOKER_has_CHARACTERISTIC_CHARACTERISTIC1` (`charac_id` ASC) ,
  CONSTRAINT `fk_LOOKER_has_CHARACTERISTIC_LOOKER1`
    FOREIGN KEY (`user_id` )
    REFERENCES `LOOKER` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_LOOKER_has_CHARACTERISTIC_CHARACTERISTIC1`
    FOREIGN KEY (`charac_id` )
    REFERENCES `CHARACTERISTIC` (`charac_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
PACK_KEYS = DEFAULT;


-- -----------------------------------------------------
-- Table `ROOMATE_has_CHARACTERISTIC`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ROOMATE_has_CHARACTERISTIC` ;

CREATE  TABLE IF NOT EXISTS `ROOMATE_has_CHARACTERISTIC` (
  `ROOMATE_user_id` INT UNSIGNED NOT NULL ,
  `CHARACTERISTIC_charac_id` INT UNSIGNED NOT NULL ,
  `value` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`ROOMATE_user_id`, `CHARACTERISTIC_charac_id`) ,
  INDEX `fk_ROOMATE_has_CHARACTERISTIC_CHARACTERISTIC1` (`CHARACTERISTIC_charac_id` ASC) ,
  CONSTRAINT `fk_ROOMATE_has_CHARACTERISTIC_ROOMATE1`
    FOREIGN KEY (`ROOMATE_user_id` )
    REFERENCES `ROOMATE` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ROOMATE_has_CHARACTERISTIC_CHARACTERISTIC1`
    FOREIGN KEY (`CHARACTERISTIC_charac_id` )
    REFERENCES `CHARACTERISTIC` (`charac_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ACCOMMODATION_TYPE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ACCOMMODATION_TYPE` ;

CREATE  TABLE IF NOT EXISTS `ACCOMMODATION_TYPE` (
  `acc_type_id` INT UNSIGNED NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`acc_type_id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WANTED_ACCOMMODATION`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WANTED_ACCOMMODATION` ;

CREATE  TABLE IF NOT EXISTS `WANTED_ACCOMMODATION` (
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
    REFERENCES `ACCOMMODATION_TYPE` (`acc_type_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_WANTED_ACCOMMODATION_LOOKER1`
    FOREIGN KEY (`user_id` )
    REFERENCES `LOOKER` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_WANTED_ACCOMMODATION_CITY1`
    FOREIGN KEY (`city_id` )
    REFERENCES `CITY` (`city_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WANTED_ACCOMMODATION_has_FEATURE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WANTED_ACCOMMODATION_has_FEATURE` ;

CREATE  TABLE IF NOT EXISTS `WANTED_ACCOMMODATION_has_FEATURE` (
  `wanted_acc_id` INT UNSIGNED NOT NULL ,
  `feat_id` INT UNSIGNED NOT NULL ,
  `value` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`wanted_acc_id`, `feat_id`) ,
  INDEX `fk_WANTED_ACCOMMODATION_has_FEATURE_FEATURE1` (`feat_id` ASC) ,
  CONSTRAINT `fk_WANTED_ACCOMMODATION_has_FEATURE_WANTED_ACCOMMODATION1`
    FOREIGN KEY (`wanted_acc_id` )
    REFERENCES `WANTED_ACCOMMODATION` (`wanted_acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_WANTED_ACCOMMODATION_has_FEATURE_FEATURE1`
    FOREIGN KEY (`feat_id` )
    REFERENCES `FEATURE` (`feat_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WANTED_ROOM`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WANTED_ROOM` ;

CREATE  TABLE IF NOT EXISTS `WANTED_ROOM` (
  `wanted_acc_id` INT UNSIGNED NOT NULL ,
  `roomates_id` INT UNSIGNED NULL ,
  PRIMARY KEY (`wanted_acc_id`) ,
  INDEX `fk_WANTED_ROOM_ROOMATES1` (`roomates_id` ASC) ,
  CONSTRAINT `fk_WANTED_ROOM_WANTED_ACCOMMODATION1`
    FOREIGN KEY (`wanted_acc_id` )
    REFERENCES `WANTED_ACCOMMODATION` (`wanted_acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_WANTED_ROOM_ROOMATES1`
    FOREIGN KEY (`roomates_id` )
    REFERENCES `ROOMATES` (`roomates_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WANTED_BED`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WANTED_BED` ;

CREATE  TABLE IF NOT EXISTS `WANTED_BED` (
  `wanted_acc_id` INT UNSIGNED NOT NULL ,
  `roomates_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`wanted_acc_id`) ,
  INDEX `fk_WANTED_BED_ROOMATES1` (`roomates_id` ASC) ,
  CONSTRAINT `fk_WANTED_BED_WANTED_ACCOMMODATION1`
    FOREIGN KEY (`wanted_acc_id` )
    REFERENCES `WANTED_ACCOMMODATION` (`wanted_acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_WANTED_BED_ROOMATES1`
    FOREIGN KEY (`roomates_id` )
    REFERENCES `ROOMATES` (`roomates_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ROOM_FEATURE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ROOM_FEATURE` ;

CREATE  TABLE IF NOT EXISTS `ROOM_FEATURE` (
  `room_feat_id` INT UNSIGNED NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `binary` TINYINT(1) NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`room_feat_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ROOM_has_ROOM_FEATURE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ROOM_has_ROOM_FEATURE` ;

CREATE  TABLE IF NOT EXISTS `ROOM_has_ROOM_FEATURE` (
  `room_feat_id` INT UNSIGNED NOT NULL ,
  `acc_id` INT UNSIGNED NOT NULL ,
  `value` TINYINT NOT NULL ,
  PRIMARY KEY (`room_feat_id`, `acc_id`) ,
  INDEX `fk_ROOM_FEATURES_has_ROOM_ROOM1` (`acc_id` ASC) ,
  CONSTRAINT `fk_ROOM_FEATURES_has_ROOM_ROOM_FEATURES1`
    FOREIGN KEY (`room_feat_id` )
    REFERENCES `ROOM_FEATURE` (`room_feat_id` )
    ON DELETE RESTRICT
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ROOM_FEATURES_has_ROOM_ROOM1`
    FOREIGN KEY (`acc_id` )
    REFERENCES `ROOM` (`acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WANTED_ROOM_has_ROOM_FEATURES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WANTED_ROOM_has_ROOM_FEATURES` ;

CREATE  TABLE IF NOT EXISTS `WANTED_ROOM_has_ROOM_FEATURES` (
  `room_feat_id` INT UNSIGNED NOT NULL ,
  `wanted_acc_id` INT UNSIGNED NOT NULL ,
  `value` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`room_feat_id`, `wanted_acc_id`) ,
  INDEX `fk_ROOM_FEATURES_has_WANTED_ROOM_WANTED_ROOM1` (`wanted_acc_id` ASC) ,
  CONSTRAINT `fk_ROOM_FEATURES_has_WANTED_ROOM_ROOM_FEATURES1`
    FOREIGN KEY (`room_feat_id` )
    REFERENCES `ROOM_FEATURE` (`room_feat_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ROOM_FEATURES_has_WANTED_ROOM_WANTED_ROOM1`
    FOREIGN KEY (`wanted_acc_id` )
    REFERENCES `WANTED_ROOM` (`wanted_acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BED_FEATURE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `BED_FEATURE` ;

CREATE  TABLE IF NOT EXISTS `BED_FEATURE` (
  `bead_feat_id` INT UNSIGNED NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `binary` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`bead_feat_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BED_has_BED_FEATURE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `BED_has_BED_FEATURE` ;

CREATE  TABLE IF NOT EXISTS `BED_has_BED_FEATURE` (
  `acc_id` INT UNSIGNED NOT NULL ,
  `bed_feat_id` INT UNSIGNED NOT NULL ,
  `value` TINYINT NOT NULL ,
  PRIMARY KEY (`acc_id`, `bed_feat_id`) ,
  INDEX `fk_BED_has_BED_FEATURE_BED_FEATURE1` (`bed_feat_id` ASC) ,
  CONSTRAINT `fk_BED_has_BED_FEATURE_BED1`
    FOREIGN KEY (`acc_id` )
    REFERENCES `BED` (`acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_BED_has_BED_FEATURE_BED_FEATURE1`
    FOREIGN KEY (`bed_feat_id` )
    REFERENCES `BED_FEATURE` (`bead_feat_id` )
    ON DELETE RESTRICT
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WANTED_BED_has_BED_FEATURE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `WANTED_BED_has_BED_FEATURE` ;

CREATE  TABLE IF NOT EXISTS `WANTED_BED_has_BED_FEATURE` (
  `wanted_acc_id` INT UNSIGNED NOT NULL ,
  `bed_feat_id` INT UNSIGNED NOT NULL ,
  `value` TINYINT NOT NULL ,
  PRIMARY KEY (`wanted_acc_id`, `bed_feat_id`) ,
  INDEX `fk_WANTED_BED_has_BED_FEATURE_BED_FEATURE1` (`bed_feat_id` ASC) ,
  CONSTRAINT `fk_WANTED_BED_has_BED_FEATURE_WANTED_BED1`
    FOREIGN KEY (`wanted_acc_id` )
    REFERENCES `WANTED_BED` (`wanted_acc_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_WANTED_BED_has_BED_FEATURE_BED_FEATURE1`
    FOREIGN KEY (`bed_feat_id` )
    REFERENCES `BED_FEATURE` (`bead_feat_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Placeholder table for view `VIEW_CITY`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `VIEW_CITY` (`city_id` INT, `city_name` INT, `state_id` INT, `state_name` INT);

-- -----------------------------------------------------
-- Placeholder table for view `VIEW_ADDRESS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `VIEW_ADDRESS` (`id` INT, `unit_no` INT, `street_no` INT, `city_id` INT, `zip_id` INT, `street_id` INT, `state_id` INT, `street` INT, `zip` INT, `city` INT, `state` INT);

-- -----------------------------------------------------
-- View `VIEW_CITY`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `VIEW_CITY` ;
DROP TABLE IF EXISTS `VIEW_CITY`;
DELIMITER $$
CREATE  OR REPLACE VIEW `VIEW_CITY` AS
SELECT c.`city_id`,  c.`name` as `city_name`, c.`state_id`, s.`name` as `state_name` 
FROM `CITY` c 
INNER JOIN `STATE` s USING (`state_id`);
$$
DELIMITER ;

;

-- -----------------------------------------------------
-- View `VIEW_ADDRESS`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `VIEW_ADDRESS` ;
DROP TABLE IF EXISTS `VIEW_ADDRESS`;
DELIMITER $$
CREATE  OR REPLACE VIEW `VIEW_ADDRESS` AS 
SELECT a.addr_id as id, a.unit_no, a.street_no, a.city_id, a.zip_id, a.street_id, st.state_id, s.name as street, z.value as zip, c.name as city, st.name as state FROM `ADDRESS` a
INNER JOIN (`STREET` s, `ZIP` z, `CITY` c) USING (`street_id`, `zip_id`, `city_id`)
INNER JOIN `STATE` st ON c.state_id = st.state_id



$$
DELIMITER ;

;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `STATE`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO STATE (`state_id`, `name`) VALUES (NULL, 'Malopolska');
INSERT INTO STATE (`state_id`, `name`) VALUES (NULL, 'Dolnyslask');
INSERT INTO STATE (`state_id`, `name`) VALUES (NULL, 'Mazowieckie');

COMMIT;

-- -----------------------------------------------------
-- Data for table `CITY`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO CITY (`city_id`, `name`, `state_id`) VALUES (1, 'Wroclaw', 2);
INSERT INTO CITY (`city_id`, `name`, `state_id`) VALUES (2, 'Krakow', 1);
INSERT INTO CITY (`city_id`, `name`, `state_id`) VALUES (3, 'Nowy Targ', 1);
INSERT INTO CITY (`city_id`, `name`, `state_id`) VALUES (4, 'Nowa Sol', 2);

COMMIT;

-- -----------------------------------------------------
-- Data for table `STREET`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO STREET (`street_id`, `name`) VALUES (1, 'Podtatrzanska');
INSERT INTO STREET (`street_id`, `name`) VALUES (2, 'Wyb. Wyspianskiego');
INSERT INTO STREET (`street_id`, `name`) VALUES (3, 'Aleja 100 lecia');
INSERT INTO STREET (`street_id`, `name`) VALUES (4, 'Plac dominikanski');

COMMIT;

-- -----------------------------------------------------
-- Data for table `ZIP`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO ZIP (`zip_id`, `value`) VALUES (1, '34-400');
INSERT INTO ZIP (`zip_id`, `value`) VALUES (2, '55-500');
INSERT INTO ZIP (`zip_id`, `value`) VALUES (3, '12-134');
INSERT INTO ZIP (`zip_id`, `value`) VALUES (4, '45-132');

COMMIT;

-- -----------------------------------------------------
-- Data for table `FEATURE`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO FEATURE (`feat_id`, `name`, `binary`) VALUES (1, 'internet', 1);
INSERT INTO FEATURE (`feat_id`, `name`, `binary`) VALUES (2, 'parking', 1);
INSERT INTO FEATURE (`feat_id`, `name`, `binary`) VALUES (3, 'tv', 1);
INSERT INTO FEATURE (`feat_id`, `name`, `binary`) VALUES (4, 'furnished', 0);
INSERT INTO FEATURE (`feat_id`, `name`, `binary`) VALUES (5, 'air conditioning', 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `PREFERENCE`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO PREFERENCE (`pref_id`, `name`, `binary`) VALUES (1, 'smokers', 1);
INSERT INTO PREFERENCE (`pref_id`, `name`, `binary`) VALUES (2, 'kids', 1);
INSERT INTO PREFERENCE (`pref_id`, `name`, `binary`) VALUES (3, 'couples', 1);
INSERT INTO PREFERENCE (`pref_id`, `name`, `binary`) VALUES (4, 'pets', 1);
INSERT INTO PREFERENCE (`pref_id`, `name`, `binary`) VALUES (5, 'gender', 0);

COMMIT;

-- -----------------------------------------------------
-- Data for table `ROOM_FEATURE`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO ROOM_FEATURE (`room_feat_id`, `name`, `binary`) VALUES (1, 'private bathroom', 1);
INSERT INTO ROOM_FEATURE (`room_feat_id`, `name`, `binary`) VALUES (2, 'private balcony', 1);

COMMIT;
