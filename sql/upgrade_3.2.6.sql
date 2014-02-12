ALTER TABLE `sitebar_config`
    ADD `changed` DATETIME NOT NULL AFTER `release`;

ALTER TABLE `sitebar_link`
    CHANGE `changed` `changed` DATETIME NOT NULL;

ALTER TABLE `sitebar_link`
    CHANGE `tested` `tested` DATETIME NOT NULL;

ALTER TABLE `sitebar_link`
    ADD `added` DATETIME NOT NULL AFTER `favicon`;

ALTER TABLE `sitebar_link`
    ADD `visited` DATETIME NOT NULL AFTER `changed`;

ALTER TABLE `sitebar_link`
    ADD `target` varchar(32) AFTER `validate`;

UPDATE `sitebar_link`
    SET added = changed;

ALTER TABLE `sitebar_visit`
    CHANGE `visit` `visited` DATETIME NOT NULL;

UPDATE `sitebar_node`
   SET sort_mode='waiting'
 WHERE sort_mode='visit';

ALTER TABLE `sitebar_node`
    ADD `type` VARCHAR(10) NOT NULL DEFAULT '';

ALTER TABLE `sitebar_session`
    CHANGE `uid` `uid` INT(10) UNSIGNED DEFAULT '0' NOT NULL;

DROP TABLE IF EXISTS `sitebar_cache`;
CREATE TABLE `sitebar_cache` (
  `type` varchar(10) NOT NULL,
  `ckey` varchar(255) NOT NULL,
  `cvalue` LONGBLOB NOT NULL,
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `expires` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (`type`, `ckey`)
) TYPE=MyISAM COMMENT='Contains multipurpose cache.';

INSERT INTO `sitebar_cache`
SELECT 'favicon', `favicon_md5`, `ico`, `changed`, NULL
FROM `sitebar_favicon`;

DROP TABLE IF EXISTS `sitebar_favicon`;

UPDATE `sitebar_config`
    SET `release` = '3.3 CVS4';
