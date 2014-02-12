CREATE TABLE `sitebar_message`
(
  `mid` int(10) unsigned NOT NULL auto_increment,
  `uid` int(10) unsigned NOT NULL,
  `gid` int(10) unsigned,
  `sent` datetime NOT NULL default '0000-00-00 00:00:00',
  `expires` datetime NOT NULL default '0000-00-00 00:00:00',
  `role` varchar(10),
  `format` varchar(10),
  `to_label` text,
  `subject` text,
  `message` text,
  PRIMARY KEY  (`mid`)
)
COMMENT='Message body.';

CREATE TABLE `sitebar_message_folder`
(
  `mid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `folder` varchar(10) default 'inbox',
  `flag` varchar(10) default 'new',
  PRIMARY KEY  (`mid`,`uid`,`folder`)
)
COMMENT='Message body placed in a folder.';

UPDATE `sitebar_config`
   SET `release` = '3.3.13';
