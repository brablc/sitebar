ALTER TABLE `sitebar_config`
    DROP `changed`;

ALTER TABLE `sitebar_link`
    CHANGE `changed` `changed` TIMESTAMP(14);

ALTER TABLE `sitebar_link`
    CHANGE `tested` `tested` TIMESTAMP(14);

ALTER TABLE `sitebar_link`
    DROP `added`;

ALTER TABLE `sitebar_link`
    DROP `visited`;

ALTER TABLE `sitebar_link`
    DROP `target`;

ALTER TABLE `sitebar_visit`
    CHANGE `visited` `visit` TIMESTAMP(14);

UPDATE `sitebar_node`
   SET sort_mode='visit'
 WHERE sort_mode='waiting';

ALTER TABLE `sitebar_node`
    DROP `type`;

ALTER TABLE `sitebar_session`
    CHANGE `uid` `uid` INT(10) UNSIGNED DEFAULT '0' NOT NULL;

DROP TABLE IF EXISTS `sitebar_favicon`;
CREATE TABLE `sitebar_favicon` (
  `favicon_md5` char(32) NOT NULL,
  `ico` mediumblob NOT NULL,
  `changed` timestamp(14) NOT NULL,
  PRIMARY KEY  (`favicon_md5`)
) TYPE=MyISAM COMMENT='Contains the favicon cache.';

INSERT INTO `sitebar_favicon`
SELECT `ckey`, `cvalue`, `created`
FROM `sitebar_cache`
WHERE `type` = 'favicon';

DROP TABLE IF EXISTS `sitebar_cache`;

UPDATE `sitebar_config`
    SET `release` = '3.2.6';
