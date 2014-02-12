ALTER TABLE `sitebar_link`
   DROP `type`;

UPDATE `sitebar_config`
   SET `release` = '3.3.6a';
