ALTER TABLE `sitebar_favicon`
   ADD `accessed` int(10) unsigned NOT NULL default '0';

UPDATE `sitebar_config`
   SET `release` = '3.2 RC1';
