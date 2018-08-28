ALTER TABLE `sitebar_user` 
	CHANGE `last_ip` `last_ip` VARCHAR(15) NULL  DEFAULT NULL;

ALTER TABLE `sitebar_session` 
	CHANGE `ip` `ip` VARCHAR(15) NOT NULL DEFAULT '';

UPDATE `sitebar_config`
    SET `release` = '3.6';
