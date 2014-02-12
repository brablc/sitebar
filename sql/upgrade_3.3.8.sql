ALTER TABLE `sitebar_root`
    ADD INDEX `uid` (`uid`);

UPDATE `sitebar_config`
   SET `release` = '3.3.9';
