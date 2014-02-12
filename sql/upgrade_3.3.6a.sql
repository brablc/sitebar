ALTER TABLE `sitebar_link`
    ADD `type` varchar(10) DEFAULT '';

UPDATE `sitebar_config`
   SET `release` = '3.3.6b';
