ALTER TABLE `sitebar_acl`
    CHANGE `allow_insert` `allow_insert` TINYINT( 1 ) DEFAULT '0' NOT NULL;

ALTER TABLE `sitebar_acl`
    ADD INDEX `IGID` ( `gid` );

ALTER TABLE `sitebar_config`
    ADD `gid_everyone` int( 10 ) unsigned NOT NULL default '2';

ALTER TABLE `sitebar_group`
    ADD `allow_contact` TINYINT( 1 ) DEFAULT '0' NOT NULL AFTER `allow_addself` ;

ALTER TABLE `sitebar_link`
    ADD `private` TINYINT( 1 ) DEFAULT '0' NOT NULL AFTER `name`;

ALTER TABLE `sitebar_link`
    CHANGE `comment` `comment` TEXT;

CREATE TABLE `sitebar_session` (
  `uid` tinyint(10) unsigned NOT NULL default '0',
  `code` varchar(32) NOT NULL default '',
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `expires` int(11) NOT NULL default '0',
  `ip` varchar(15) NOT NULL default '',
  PRIMARY KEY  (`code`)
) TYPE=MyISAM COMMENT='Session management';

UPDATE `sitebar_config`
    SET `release` = '3.0rc1';
