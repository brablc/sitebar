ALTER TABLE `sitebar_user` 
	DROP `last_ip`;

UPDATE `sitebar_config`
    SET `release` = '3.5';
