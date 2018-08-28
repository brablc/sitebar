SET @@sql_mode = '';

ALTER TABLE `sitebar_user` 
	CHANGE `last_ip` `last_ip` VARCHAR(45) NULL DEFAULT NULL;

ALTER TABLE `sitebar_session`
    CHANGE `created` `created` DATETIME NULL DEFAULT NULL;

ALTER TABLE `sitebar_session` 
	CHANGE `ip` `ip` VARCHAR(45) NOT NULL;

UPDATE `sitebar_config`
	SET `release` = '3.6.1';
