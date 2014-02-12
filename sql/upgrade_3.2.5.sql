ALTER TABLE `sitebar_session`
    CHANGE `uid` `uid` INT(10) UNSIGNED DEFAULT '0' NOT NULL;

UPDATE `sitebar_config`
    SET `release` = '3.2.6';
