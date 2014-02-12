CREATE TABLE `sitebar_user_data` (
  `type` varchar(10) NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `dkey` varchar(255) NOT NULL,
  `dvalue` LONGBLOB NOT NULL,
  PRIMARY KEY (`type`, `uid`, `dkey`)
)
COMMENT='Offers multipurpose user data storage space.';

UPDATE `sitebar_config`
   SET `release` = '3.3.6';
