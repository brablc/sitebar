ALTER TABLE `sitebar_user`
  ADD `demo` TINYINT( 1 ) DEFAULT '0' NOT NULL AFTER `verified`;

UPDATE `sitebar_config`
   SET `release` = '3.0.1';
