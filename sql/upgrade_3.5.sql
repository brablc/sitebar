SET @@sql_mode = '';

ALTER TABLE `sitebar_user` 
	CHANGE `visited` `visited` DATETIME NULL DEFAULT NULL;

UPDATE `sitebar_user`
   SET `visited` = NULL
   WHERE date(`visited`) = '0000-00-00 00:00:00';

ALTER TABLE `sitebar_user` 
   ADD `last_ip` VARCHAR(15) DEFAULT NULL AFTER `visits`;

UPDATE sitebar_user su, (SELECT uid, max(ip) last_ip FROM sitebar_session GROUP BY uid) x
SET su.last_ip = x.last_ip
WHERE su.uid = x.uid;

UPDATE `sitebar_config`
   SET `release` = '3.6';
