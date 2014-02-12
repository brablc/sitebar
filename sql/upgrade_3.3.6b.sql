ALTER TABLE `sitebar_link`
    ADD `is_feed` tinyint(1) NOT NULL default '0' AFTER `is_dead` ,
    ADD `is_sidebar` tinyint(1) NOT NULL default '0' AFTER `is_feed` ;

UPDATE `sitebar_config`
   SET `release` = '3.3.6c';
