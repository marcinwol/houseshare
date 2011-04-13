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
  PRIMARY KEY (`state_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_polish_ci;

CREATE UNIQUE INDEX `name_UNIQUE` ON `STATE` (`name` ASC) ;


-- -----------------------------------------------------
-- Table `MARKER`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MARKER` ;

CREATE  TABLE IF NOT EXISTS `MARKER` (
  `marker_id` INT NOT NULL AUTO_INCREMENT ,
  `lat` FLOAT(10,6) UNSIGNED NOT NULL ,
  `lng` FLOAT(10,6) UNSIGNED NOT NULL ,
  PRIMARY KEY (`marker_id`) )
ENGINE = InnoDB
COMMENT = 'Google Map marker localization';


-- -----------------------------------------------------
-- Table `CITY`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `CITY` ;

CREATE  TABLE IF NOT EXISTS `CITY` (
  `city_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `state_id` INT UNSIGNED NOT NULL ,
  `marker_id` INT NULL ,
  `description` TEXT NULL ,
  PRIMARY KEY (`city_id`) ,
  CONSTRAINT `fk_CITY_STATE1`
    FOREIGN KEY (`state_id` )
    REFERENCES `STATE` (`state_id` )
    ON DELETE RESTRICT
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CITY_MARKER1`
    FOREIGN KEY (`marker_id` )
    REFERENCES `MARKER` (`marker_id` )
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_polish_ci;

CREATE INDEX `fk_CITY_STATE1` ON `CITY` (`state_id` ASC) ;

CREATE INDEX `city_name` ON `CITY` (`name` ASC, `state_id` ASC) ;

CREATE INDEX `fk_CITY_MARKER1` ON `CITY` (`marker_id` ASC) ;


-- -----------------------------------------------------
-- Table `STREET`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `STREET` ;

CREATE  TABLE IF NOT EXISTS `STREET` (
  `street_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`street_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_polish_ci;

CREATE INDEX `name_index` ON `STREET` (`name` ASC) ;


-- -----------------------------------------------------
-- Table `ZIP`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ZIP` ;

CREATE  TABLE IF NOT EXISTS `ZIP` (
  `zip_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `value` VARCHAR(20) NOT NULL ,
  PRIMARY KEY (`zip_id`) )
ENGINE = InnoDB;

CREATE UNIQUE INDEX `value_UNIQUE` ON `ZIP` (`value` ASC) ;


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
  `marker_id` INT NULL ,
  PRIMARY KEY (`addr_id`) ,
  CONSTRAINT `fk_ADDRESS_CITY1`
    FOREIGN KEY (`city_id` )
    REFERENCES `CITY` (`city_id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ADDRESS_STREET1`
    FOREIGN KEY (`street_id` )
    REFERENCES `STREET` (`street_id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ADDRESS_ZIP1`
    FOREIGN KEY (`zip_id` )
    REFERENCES `ZIP` (`zip_id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ADDRESS_MARKER1`
    FOREIGN KEY (`marker_id` )
    REFERENCES `MARKER` (`marker_id` )
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_ADDRESS_CITY1` ON `ADDRESS` (`city_id` ASC) ;

CREATE INDEX `fk_ADDRESS_STREET1` ON `ADDRESS` (`street_id` ASC) ;

CREATE INDEX `fk_ADDRESS_ZIP1` ON `ADDRESS` (`zip_id` ASC) ;

CREATE INDEX `fk_ADDRESS_MARKER1` ON `ADDRESS` (`marker_id` ASC) ;


-- -----------------------------------------------------
-- Table `USER`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `USER` ;

CREATE  TABLE IF NOT EXISTS `USER` (
  `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(85) NOT NULL ,
  `phone` VARCHAR(45) NULL ,
  `phone_public` TINYINT(1) NULL DEFAULT 0 ,
  `created` TIMESTAMP NOT NULL ,
  `first_name` VARCHAR(45) NULL ,
  `last_name` VARCHAR(45) NULL ,
  `last_name_public` TINYINT(1) NULL DEFAULT 1 ,
  `type` ENUM('USER','ROOMATE','LOOKER','AGENT','OWNER') NOT NULL DEFAULT 'USER' ,
  `is_enabled` TINYINT(1) NOT NULL DEFAULT 1 ,
  `privilage` ENUM('BASIC','PREMIUM','ADMIN') NOT NULL DEFAULT 'BASIC' ,
  `description` TEXT NULL ,
  `email_public` TINYINT(1) NOT NULL DEFAULT 0 ,
  `nickname` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`user_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_polish_ci;

CREATE UNIQUE INDEX `email_UNIQUE` ON `USER` (`email` ASC) ;


-- -----------------------------------------------------
-- Table `TYPE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `TYPE` ;

CREATE  TABLE IF NOT EXISTS `TYPE` (
  `type_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `is_shared` TINYINT(1) NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`type_id`) )
ENGINE = InnoDB;

CREATE UNIQUE INDEX `type_id_UNIQUE` ON `TYPE` (`type_id` ASC) ;


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
  `created` TIMESTAMP NOT NULL ,
  `bond` INT UNSIGNED NOT NULL ,
  `street_address_public` TINYINT(1) NOT NULL DEFAULT 0 ,
  `short_term_ok` TINYINT(1) NOT NULL DEFAULT 1 ,
  `type_id` INT UNSIGNED NOT NULL ,
  `is_enabled` TINYINT(1) NOT NULL DEFAULT 0 ,
  `price_info` VARCHAR(255) NULL ,
  `queries_counter` INT NOT NULL DEFAULT 0 ,
  `features_info` TEXT NULL ,
  `preferences_info` TEXT NULL ,
  PRIMARY KEY (`acc_id`) ,
  CONSTRAINT `fk_ACCOMODATION_ADDRESS1`
    FOREIGN KEY (`addr_id` )
    REFERENCES `ADDRESS` (`addr_id` )
    ON DELETE RESTRICT
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ACCOMODATION_USER1`
    FOREIGN KEY (`user_id` )
    REFERENCES `USER` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ACCOMMODATION_TYPE1`
    FOREIGN KEY (`type_id` )
    REFERENCES `TYPE` (`type_id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_polish_ci
PACK_KEYS = DEFAULT;

CREATE INDEX `fk_ACCOMODATION_ADDRESS1` ON `ACCOMMODATION` (`addr_id` ASC) ;

CREATE INDEX `fk_ACCOMODATION_USER1` ON `ACCOMMODATION` (`user_id` ASC) ;

CREATE INDEX `fk_ACCOMMODATION_TYPE1` ON `ACCOMMODATION` (`type_id` ASC) ;


-- -----------------------------------------------------
-- Table `APPARTMENT`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `APPARTMENT` ;

CREATE  TABLE IF NOT EXISTS `APPARTMENT` (
  `acc_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`acc_id`) ,
  CONSTRAINT `fk_APPARTMENT_ACCOMODATION1`
    FOREIGN KEY (`acc_id` )
    REFERENCES `ACCOMMODATION` (`acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_APPARTMENT_ACCOMODATION1` ON `APPARTMENT` (`acc_id` ASC) ;


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
  `type_id` INT UNSIGNED NULL DEFAULT NULL ,
  PRIMARY KEY (`feat_id`) ,
  CONSTRAINT `fk_FEATURE_TYPE1`
    FOREIGN KEY (`type_id` )
    REFERENCES `TYPE` (`type_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'e.g. parking, internet, cable_tv, air_conditioning';

CREATE INDEX `fk_FEATURE_TYPE1` ON `FEATURE` (`type_id` ASC) ;

CREATE UNIQUE INDEX `name_UNIQUE` ON `FEATURE` (`name` ASC) ;


-- -----------------------------------------------------
-- Table `ACCOMODATION_has_FEATURE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ACCOMODATION_has_FEATURE` ;

CREATE  TABLE IF NOT EXISTS `ACCOMODATION_has_FEATURE` (
  `acc_id` INT UNSIGNED NOT NULL ,
  `feat_id` INT UNSIGNED NOT NULL ,
  `value` TINYINT(3) NOT NULL ,
  PRIMARY KEY (`acc_id`, `feat_id`) ,
  CONSTRAINT `fk_ACCOMODATION_has_FEATURE_ACCOMODATION1`
    FOREIGN KEY (`acc_id` )
    REFERENCES `ACCOMMODATION` (`acc_id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ACCOMODATION_has_FEATURE_FEATURE1`
    FOREIGN KEY (`feat_id` )
    REFERENCES `FEATURE` (`feat_id` )
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;

CREATE INDEX `fk_ACCOMODATION_has_FEATURE_FEATURE1` ON `ACCOMODATION_has_FEATURE` (`feat_id` ASC) ;


-- -----------------------------------------------------
-- Table `PATH`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PATH` ;

CREATE  TABLE IF NOT EXISTS `PATH` (
  `path_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `value` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`path_id`) )
ENGINE = InnoDB;

CREATE UNIQUE INDEX `value_UNIQUE` ON `PATH` (`value` ASC) ;


-- -----------------------------------------------------
-- Table `PHOTO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PHOTO` ;

CREATE  TABLE IF NOT EXISTS `PHOTO` (
  `photo_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `filename` VARCHAR(45) NOT NULL ,
  `path_id` INT UNSIGNED NOT NULL ,
  `acc_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`photo_id`) ,
  CONSTRAINT `fk_PHOTO_ACCOMODATION1`
    FOREIGN KEY (`acc_id` )
    REFERENCES `ACCOMMODATION` (`acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PHOTO_PATH1`
    FOREIGN KEY (`path_id` )
    REFERENCES `PATH` (`path_id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_PHOTO_ACCOMODATION1` ON `PHOTO` (`acc_id` ASC) ;

CREATE INDEX `fk_PHOTO_PATH1` ON `PHOTO` (`path_id` ASC) ;

CREATE UNIQUE INDEX `UNIQUE_PATH` ON `PHOTO` (`path_id` ASC, `filename` ASC) ;


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
  `description` TEXT NULL ,
  PRIMARY KEY (`roomates_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_polish_ci
COMMENT = 'Info about roomates';


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

CREATE UNIQUE INDEX `name_UNIQUE` ON `PREFERENCE` (`name` ASC) ;


-- -----------------------------------------------------
-- Table `ACCOMODATION_has_PREFERENCE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ACCOMODATION_has_PREFERENCE` ;

CREATE  TABLE IF NOT EXISTS `ACCOMODATION_has_PREFERENCE` (
  `acc_id` INT UNSIGNED NOT NULL ,
  `pref_id` INT UNSIGNED NOT NULL ,
  `value` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`acc_id`, `pref_id`) ,
  CONSTRAINT `fk_acc_id`
    FOREIGN KEY (`acc_id` )
    REFERENCES `ACCOMMODATION` (`acc_id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_pref_id`
    FOREIGN KEY (`pref_id` )
    REFERENCES `PREFERENCE` (`pref_id` )
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;

CREATE INDEX `fk_pref_id` ON `ACCOMODATION_has_PREFERENCE` (`pref_id` ASC) ;


-- -----------------------------------------------------
-- Table `ROOMATE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ROOMATE` ;

CREATE  TABLE IF NOT EXISTS `ROOMATE` (
  `user_id` INT UNSIGNED NOT NULL ,
  `is_owner` TINYINT(1) NOT NULL DEFAULT 0 ,
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
  `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `agancy_name` VARCHAR(100) NOT NULL ,
  `addr_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`user_id`) ,
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

CREATE INDEX `fk_AGENT_ADDRESS1` ON `AGENT` (`addr_id` ASC) ;


-- -----------------------------------------------------
-- Table `CHARACTERISTIC`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `CHARACTERISTIC` ;

CREATE  TABLE IF NOT EXISTS `CHARACTERISTIC` (
  `charac_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`charac_id`) )
ENGINE = InnoDB;

CREATE UNIQUE INDEX `name_UNIQUE` ON `CHARACTERISTIC` (`name` ASC) ;


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

CREATE INDEX `fk_LOOKER_has_CHARACTERISTIC_CHARACTERISTIC1` ON `LOOKER_has_CHARACTERISTIC` (`charac_id` ASC) ;


-- -----------------------------------------------------
-- Table `ROOMATE_has_CHARACTERISTIC`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ROOMATE_has_CHARACTERISTIC` ;

CREATE  TABLE IF NOT EXISTS `ROOMATE_has_CHARACTERISTIC` (
  `user_id` INT UNSIGNED NOT NULL ,
  `charac_id` INT UNSIGNED NOT NULL ,
  `value` TINYINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`user_id`, `charac_id`) ,
  CONSTRAINT `fk_ROOMATE_has_CHARACTERISTIC_ROOMATE1`
    FOREIGN KEY (`user_id` )
    REFERENCES `ROOMATE` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ROOMATE_has_CHARACTERISTIC_CHARACTERISTIC1`
    FOREIGN KEY (`charac_id` )
    REFERENCES `CHARACTERISTIC` (`charac_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_ROOMATE_has_CHARACTERISTIC_CHARACTERISTIC1` ON `ROOMATE_has_CHARACTERISTIC` (`charac_id` ASC) ;


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
  CONSTRAINT `fk_WANTED_ACCOMMODATION_LOOKER1`
    FOREIGN KEY (`user_id` )
    REFERENCES `LOOKER` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_WANTED_ACCOMMODATION_CITY1`
    FOREIGN KEY (`city_id` )
    REFERENCES `CITY` (`city_id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_WANTED_ACCOMMODATION_LOOKER1` ON `WANTED_ACCOMMODATION` (`user_id` ASC) ;

CREATE INDEX `fk_WANTED_ACCOMMODATION_CITY1` ON `WANTED_ACCOMMODATION` (`city_id` ASC) ;


-- -----------------------------------------------------
-- Table `SHARED`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SHARED` ;

CREATE  TABLE IF NOT EXISTS `SHARED` (
  `acc_id` INT UNSIGNED NOT NULL ,
  `roomates_id` INT UNSIGNED NULL ,
  PRIMARY KEY (`acc_id`) ,
  CONSTRAINT `fk_BED_ACCOMODATION10`
    FOREIGN KEY (`acc_id` )
    REFERENCES `ACCOMMODATION` (`acc_id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_BED_ROOMATES10`
    FOREIGN KEY (`roomates_id` )
    REFERENCES `ROOMATES` (`roomates_id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_BED_ROOMATES1` ON `SHARED` (`roomates_id` ASC) ;


-- -----------------------------------------------------
-- Table `AUTH_PROVIDER`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AUTH_PROVIDER` ;

CREATE  TABLE IF NOT EXISTS `AUTH_PROVIDER` (
  `key` VARCHAR(255) NOT NULL ,
  `provider_type` ENUM('google','myopenid','yahoo','facebook','twitter','openid') NOT NULL ,
  `user_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`key`, `user_id`) ,
  CONSTRAINT `fk_AUTH_PROVIDER_USER1`
    FOREIGN KEY (`user_id` )
    REFERENCES `USER` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_AUTH_PROVIDER_USER1` ON `AUTH_PROVIDER` (`user_id` ASC) ;


-- -----------------------------------------------------
-- Table `PASSWORD`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PASSWORD` ;

CREATE  TABLE IF NOT EXISTS `PASSWORD` (
  `user_id` INT UNSIGNED NOT NULL ,
  `password` VARCHAR(65) NOT NULL ,
  PRIMARY KEY (`user_id`) ,
  CONSTRAINT `fk_PASSWORD_USER1`
    FOREIGN KEY (`user_id` )
    REFERENCES `USER` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_polish_ci;

CREATE INDEX `fk_PASSWORD_USER1` ON `PASSWORD` (`user_id` ASC) ;


-- -----------------------------------------------------
-- Table `VIEWS_COUNTER`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `VIEWS_COUNTER` ;

CREATE  TABLE IF NOT EXISTS `VIEWS_COUNTER` (
  `views_counter_id` INT NOT NULL AUTO_INCREMENT ,
  `remote_ip` INT UNSIGNED NULL ,
  `acc_id` INT UNSIGNED NOT NULL ,
  `created` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`views_counter_id`) ,
  CONSTRAINT `fk_VIEWS_COUNTER_ACCOMMODATION1`
    FOREIGN KEY (`acc_id` )
    REFERENCES `ACCOMMODATION` (`acc_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_VIEWS_COUNTER_ACCOMMODATION1` ON `VIEWS_COUNTER` (`acc_id` ASC) ;


-- -----------------------------------------------------
-- Placeholder table for view `VIEW_CITY`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `VIEW_CITY` (`city_id` INT, `city_name` INT, `state_id` INT, `state_name` INT, `lat` INT, `lng` INT);

-- -----------------------------------------------------
-- Placeholder table for view `VIEW_ADDRESS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `VIEW_ADDRESS` (`id` INT, `unit_no` INT, `street_no` INT, `city_id` INT, `zip_id` INT, `street_id` INT, `state_id` INT, `marker_id` INT, `street` INT, `zip` INT, `city` INT, `state` INT, `lat` INT, `lng` INT);

-- -----------------------------------------------------
-- Placeholder table for view `VIEW_SHARE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `VIEW_SHARE` (`acc_id` INT, `roomates_id` INT);

-- -----------------------------------------------------
-- Placeholder table for view `VIEW_PHOTO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `VIEW_PHOTO` (`photo_id` INT, `filename` INT, `acc_id` INT, `path_id` INT, `path` INT);

-- -----------------------------------------------------
-- Placeholder table for view `VIEW_ACC_FEATURES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `VIEW_ACC_FEATURES` (`acc_id` INT, `feat_id` INT, `name` INT, `value` INT);

-- -----------------------------------------------------
-- Placeholder table for view `VIEW_ACC_PREFERENCES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `VIEW_ACC_PREFERENCES` (`acc_id` INT, `pref_id` INT, `name` INT, `value` INT);

-- -----------------------------------------------------
-- Placeholder table for view `VIEW_ACCOMMODATION`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `VIEW_ACCOMMODATION` (`first_name` INT, `last_name` INT, `acc_id` INT, `title` INT, `description` INT, `addr_id` INT, `user_id` INT, `date_avaliable` INT, `price` INT, `created` INT, `bond` INT, `street_address_public` INT, `short_term_ok` INT, `type_id` INT, `is_enabled` INT, `price_info` INT, `queries_counter` INT, `features_info` INT, `preferences_info` INT, `feat_name` INT, `pref_name` INT, `filename` INT);

-- -----------------------------------------------------
-- Placeholder table for view `VIEW_USER_FOR_AUTH`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `VIEW_USER_FOR_AUTH` (`key` INT, `provider_type` INT, `user_id` INT, `password` INT, `email` INT, `phone` INT, `phone_public` INT, `created` INT, `first_name` INT, `last_name` INT, `last_name_public` INT, `type` INT, `is_enabled` INT, `privilage` INT, `description` INT, `email_public` INT, `nickname` INT);

-- -----------------------------------------------------
-- View `VIEW_CITY`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `VIEW_CITY` ;
DROP TABLE IF EXISTS `VIEW_CITY`;
DELIMITER $$
CREATE  OR REPLACE VIEW `VIEW_CITY` AS
SELECT c.`city_id`,  c.`name` as `city_name`, c.`state_id`, s.`name` as `state_name`, m.lat as lat, m.lng as lng
FROM `CITY` c 
INNER JOIN `STATE` s USING (`state_id`)
LEFT JOIN `MARKER` m ON  c.marker_id = m.marker_id;
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
SELECT a.addr_id as id, a.unit_no, a.street_no, a.city_id, a.zip_id, a.street_id, st.state_id, a.marker_id, s.name as street, z.value as zip, c.name as city, st.name as state, m.lat as lat, m.lng as lng FROM `ADDRESS` a
INNER JOIN (`STREET` s, `ZIP` z, `CITY` c) USING (`street_id`, `zip_id`, `city_id`)
INNER JOIN `STATE` st ON c.state_id = st.state_id
LEFT JOIN `MARKER` m ON  a.marker_id = m.marker_id



$$
DELIMITER ;

;

-- -----------------------------------------------------
-- View `VIEW_SHARE`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `VIEW_SHARE` ;
DROP TABLE IF EXISTS `VIEW_SHARE`;
DELIMITER $$
CREATE  OR REPLACE VIEW `VIEW_SHARE` AS
SELECT s.* FROM `SHARED` s
INNER JOIN `ACCOMMODATION` USING (`acc_id`)
INNER JOIN `ROOMATES` USING (`roomates_id`)

$$
DELIMITER ;

;

-- -----------------------------------------------------
-- View `VIEW_PHOTO`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `VIEW_PHOTO` ;
DROP TABLE IF EXISTS `VIEW_PHOTO`;
DELIMITER $$
CREATE  OR REPLACE VIEW `VIEW_PHOTO` AS 
SELECT p.photo_id, p.filename, p.acc_id, pa.path_id, pa.value as path FROM `PHOTO` p
INNER JOIN (`PATH` pa) USING (`path_id`)

$$
DELIMITER ;

;

-- -----------------------------------------------------
-- View `VIEW_ACC_FEATURES`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `VIEW_ACC_FEATURES` ;
DROP TABLE IF EXISTS `VIEW_ACC_FEATURES`;
DELIMITER $$
CREATE  OR REPLACE VIEW `VIEW_ACC_FEATURES` AS
SELECT af.acc_id, f.feat_id, f.name, af.value  
FROM `ACCOMODATION_has_FEATURE` af INNER JOIN `FEATURE` f USING (`feat_id`) 


$$
DELIMITER ;

;

-- -----------------------------------------------------
-- View `VIEW_ACC_PREFERENCES`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `VIEW_ACC_PREFERENCES` ;
DROP TABLE IF EXISTS `VIEW_ACC_PREFERENCES`;
DELIMITER $$
CREATE  OR REPLACE VIEW `VIEW_ACC_PREFERENCES` AS
SELECT ap.acc_id, p.pref_id, p.name, ap.value  
FROM `ACCOMODATION_has_PREFERENCE` ap INNER JOIN `PREFERENCE` p USING (`pref_id`) 


$$
DELIMITER ;

;

-- -----------------------------------------------------
-- View `VIEW_ACCOMMODATION`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `VIEW_ACCOMMODATION` ;
DROP TABLE IF EXISTS `VIEW_ACCOMMODATION`;
DELIMITER $$
CREATE  OR REPLACE VIEW `VIEW_ACCOMMODATION` as
SElECT user.first_name, user.last_name,  acc.*, ad.*, feat.name as feat_name, pref.name as pref_name, photo.filename FROM `ACCOMMODATION` acc INNER JOIN `VIEW_ADDRESS` ad ON (acc.addr_id = ad.id) 
INNER JOIN USER user using (user_id)
LEFT JOIN VIEW_ACC_FEATURES feat USING (acc_id)
LEFT JOIN VIEW_ACC_PREFERENCES pref USING (acc_id)
LEFT JOIN VIEW_PHOTO photo USING (acc_id)

$$
DELIMITER ;

;

-- -----------------------------------------------------
-- View `VIEW_USER_FOR_AUTH`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `VIEW_USER_FOR_AUTH` ;
DROP TABLE IF EXISTS `VIEW_USER_FOR_AUTH`;
DELIMITER $$
CREATE  OR REPLACE VIEW `VIEW_USER_FOR_AUTH` AS
SELECT * FROM `USER` 
LEFT JOIN `PASSWORD` USING (`user_id`)
LEFT JOIN `AUTH_PROVIDER` USING (`user_id`)

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
INSERT INTO STATE (`state_id`, `name`) VALUES (NULL, 'Małopolska');
INSERT INTO STATE (`state_id`, `name`) VALUES (NULL, 'Dolnośląsk');
INSERT INTO STATE (`state_id`, `name`) VALUES (NULL, 'Mazowieckie');

COMMIT;

-- -----------------------------------------------------
-- Data for table `MARKER`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO MARKER (`marker_id`, `lat`, `lng`) VALUES (1, 51.806917, 15.716629);
INSERT INTO MARKER (`marker_id`, `lat`, `lng`) VALUES (2, 49.480059, 20.032539);
INSERT INTO MARKER (`marker_id`, `lat`, `lng`) VALUES (3, 51.117317, 17.037048);
INSERT INTO MARKER (`marker_id`, `lat`, `lng`) VALUES (4, 50.074769, 19.947739);

COMMIT;

-- -----------------------------------------------------
-- Data for table `CITY`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO CITY (`city_id`, `name`, `state_id`, `marker_id`, `description`) VALUES (1, 'Wrocław', 2, 3, NULL);
INSERT INTO CITY (`city_id`, `name`, `state_id`, `marker_id`, `description`) VALUES (2, 'Kraków', 1, 4, NULL);
INSERT INTO CITY (`city_id`, `name`, `state_id`, `marker_id`, `description`) VALUES (3, 'Nowy Targ', 1, 2, NULL);
INSERT INTO CITY (`city_id`, `name`, `state_id`, `marker_id`, `description`) VALUES (4, 'Nowa Sól', 2, 1, NULL);

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
-- Data for table `TYPE`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO TYPE (`type_id`, `name`, `is_shared`) VALUES (1, 'Bed', 1);
INSERT INTO TYPE (`type_id`, `name`, `is_shared`) VALUES (2, 'Room', 1);
INSERT INTO TYPE (`type_id`, `name`, `is_shared`) VALUES (3, 'House', 0);
INSERT INTO TYPE (`type_id`, `name`, `is_shared`) VALUES (4, 'Appartment', 0);
INSERT INTO TYPE (`type_id`, `name`, `is_shared`) VALUES (5, 'Studio', 0);
INSERT INTO TYPE (`type_id`, `name`, `is_shared`) VALUES (6, 'Townhouse', 0);

COMMIT;

-- -----------------------------------------------------
-- Data for table `FEATURE`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
INSERT INTO FEATURE (`feat_id`, `name`, `binary`, `type_id`) VALUES (1, 'internet', 1, NULL);
INSERT INTO FEATURE (`feat_id`, `name`, `binary`, `type_id`) VALUES (2, 'parking', 1, NULL);
INSERT INTO FEATURE (`feat_id`, `name`, `binary`, `type_id`) VALUES (3, 'tv', 1, NULL);
INSERT INTO FEATURE (`feat_id`, `name`, `binary`, `type_id`) VALUES (4, 'furnished', 0, NULL);
INSERT INTO FEATURE (`feat_id`, `name`, `binary`, `type_id`) VALUES (5, 'air conditioning', 1, NULL);
INSERT INTO FEATURE (`feat_id`, `name`, `binary`, `type_id`) VALUES (6, 'private bath', 1, 2);
INSERT INTO FEATURE (`feat_id`, `name`, `binary`, `type_id`) VALUES (7, 'private balcony', 1, 2);

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
