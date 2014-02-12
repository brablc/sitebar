CREATE TABLE `sitebar_data` (
  `type` varchar(10) NOT NULL,
  `dkey` varchar(255) NOT NULL,
  `dvalue` LONGBLOB NOT NULL,
  PRIMARY KEY (`type`, `dkey`)
)
COMMENT='Offers multipurpose data strorage space.';

UPDATE `sitebar_config`
   SET `release` = '3.3.5';
