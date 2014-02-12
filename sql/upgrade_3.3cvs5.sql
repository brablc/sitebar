ALTER TABLE `sitebar_user`
    DROP `code`;

CREATE TABLE `sitebar_token` (
  `uid` int(10) unsigned NOT NULL,
  `type` varchar(10) DEFAULT '',
  `issued` datetime NOT NULL default '0000-00-00 00:00:00',
  `expires` int(11) NOT NULL DEFAULT '0',
  `token` varchar(8) DEFAULT ''
) TYPE=MyISAM PACK_KEYS=0 COMMENT='Tokes for email validation, forgotten passwords, ...';

UPDATE `sitebar_config`
    SET `release` = '3.3 CVS6';
