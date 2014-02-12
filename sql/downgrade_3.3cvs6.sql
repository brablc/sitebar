ALTER TABLE `sitebar_user`
    ADD `code` int(6) DEFAULT NULL AFTER `demo`;

DROP TABLE `sitebar_token`;

UPDATE `sitebar_config`
    SET `release` = '3.3 CVS5';
