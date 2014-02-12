ALTER TABLE `sitebar_root`
    DROP INDEX `uid`;

UPDATE `sitebar_config`
   SET `release` = '3.3.8';
