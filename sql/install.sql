
/* CREATE TABLES */

CREATE TABLE `sitebar_acl` (
  `gid` int(10) unsigned NOT NULL DEFAULT '0',
  `nid` int(10) unsigned NOT NULL DEFAULT '0',
  `allow_select` tinyint(1) NOT NULL DEFAULT '1',
  `allow_update` tinyint(1) NOT NULL DEFAULT '0',
  `allow_delete` tinyint(1) NOT NULL DEFAULT '0',
  `allow_insert` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY  (`gid`,`nid`),
  KEY `IGID` (`gid`)
)
COMMENT='Access control list. Defines rights of groups to root nodes.';

CREATE TABLE `sitebar_config` (
  `release` varchar(10) NOT NULL DEFAULT '3.6.2',
  `changed` datetime NOT NULL default CURRENT_TIMESTAMP,
  `params` text
)
COMMENT='Basic Sitebar parameters';

CREATE TABLE `sitebar_group` (
  `gid` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) DEFAULT NULL,
  `comment` text,
  `uid` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`gid`)
)
COMMENT='Group for sharing.';

CREATE TABLE `sitebar_link` (
  `lid` int(10) unsigned NOT NULL auto_increment,
  `nid` int(10) unsigned NOT NULL default '0',
  `url` text NOT NULL,
  `name` varchar(255) NOT NULL default '',
  `private` tinyint(1) default '0',
  `comment` longtext,
  `favicon` text,
  `added` datetime NOT NULL default CURRENT_TIMESTAMP,
  `changed` datetime,
  `visited` datetime,
  `tested` datetime,
  `deleted_by` int(10) unsigned default NULL,
  `is_dead` tinyint(1) NOT NULL default '0',
  `is_feed` tinyint(1) NOT NULL default '0',
  `is_sidebar` tinyint(1) NOT NULL default '0',
  `hits` int(10) unsigned NOT NULL default '0',
  `validate` tinyint(1) NOT NULL default '1',
  `target` varchar(32),
  `type` varchar(10) DEFAULT '',
  PRIMARY KEY  (`lid`),
  UNIQUE KEY `name` (`nid`,`name`)
)
COMMENT='Each link must belong to a node.';

CREATE TABLE `sitebar_visit` (
  `lid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `visited` datetime,
  PRIMARY KEY  (`lid`,`uid`)
)
COMMENT='Last link visit for each user';

CREATE TABLE `sitebar_member` (
  `gid` int(10) unsigned NOT NULL default '0',
  `uid` int(10) unsigned NOT NULL default '0',
  `share` tinyint(1) NOT NULL default '0',
  `moderator` tinyint(1) NOT NULL default '0',
  `confirmed` tinyint(1) NOT NULL default '0',
  `invitator` int(10) unsigned default NULL,
  PRIMARY KEY  (`gid`,`uid`)
) COMMENT='Membership';

CREATE TABLE `sitebar_node` (
  `nid` int(10) unsigned NOT NULL auto_increment,
  `nid_parent` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `comment` text,
  `sort_mode` char(10) DEFAULT 'user',
  `custom_order` text,
  `type` varchar(10) DEFAULT '',
  `deleted_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY  (`nid`),
  UNIQUE KEY `name` (`nid_parent`,`name`),
  KEY `pnid` (`nid_parent`)
)
COMMENT='Node contains other nodes and links.';

CREATE TABLE `sitebar_root` (
  `nid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY  (`nid`),
  UNIQUE KEY `nid` (`nid`,`uid`),
  KEY `uid` (`uid`)
)
COMMENT='Contains list of trees and their respective owners.';

CREATE TABLE `sitebar_user` (
  `uid` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(50) NOT NULL default '',
  `pass` varchar(32) default NULL,
  `email` varchar(50) default NULL,
  `name` varchar(50) default NULL,
  `verified` tinyint(1) NOT NULL default '0',
  `approved` tinyint(1) NOT NULL default '0',
  `demo` tinyint(1) NOT NULL default '0',
  `comment` text,
  `params` text,
  `visited` datetime,
  `visits` int(11) unsigned NOT NULL default '0',
  `last_ip` varchar(45) DEFAULT NULL,
  PRIMARY KEY  (`uid`),
  UNIQUE KEY `username` (`username`)
)
COMMENT='Users of the application.';

CREATE TABLE `sitebar_token` (
  `uid` int(10) unsigned NOT NULL,
  `type` varchar(10) DEFAULT '',
  `issued` datetime NOT NULL default CURRENT_TIMESTAMP,
  `expires` int(11) NOT NULL DEFAULT '0',
  `token` varchar(8) DEFAULT ''
)
COMMENT='Tokens for email validation, forgotten passwords, ...';

CREATE TABLE `sitebar_session` (
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `code` varchar(32) NOT NULL DEFAULT '',
  `created` datetime NOT NULL,
  `expires` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY  (`code`)
)
COMMENT='Session management';

CREATE TABLE `sitebar_message`
(
  `mid` int(10) unsigned NOT NULL auto_increment,
  `uid` int(10) unsigned NOT NULL,
  `gid` int(10) unsigned,
  `sent` datetime NOT NULL default CURRENT_TIMESTAMP,
  `expires` datetime,
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

CREATE TABLE `sitebar_cache` (
  `type` varchar(10) NOT NULL,
  `ckey` varchar(255) NOT NULL,
  `cvalue` LONGBLOB NOT NULL,
  `created` datetime NOT NULL default CURRENT_TIMESTAMP,
  `expires` datetime,
  PRIMARY KEY (`type`, `ckey`)
)
COMMENT='Contains multipurpose cache.';

CREATE TABLE `sitebar_data` (
  `type` varchar(10) NOT NULL,
  `dkey` varchar(255) NOT NULL,
  `dvalue` LONGBLOB NOT NULL,
  PRIMARY KEY (`type`, `dkey`)
)
COMMENT='Offers multipurpose data storage space.';

CREATE TABLE `sitebar_user_data` (
  `type` varchar(10) NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `dkey` varchar(255) NOT NULL,
  `dvalue` LONGBLOB NOT NULL,
  PRIMARY KEY (`type`, `uid`, `dkey`)
)
COMMENT='Offers multipurpose user data storage space.';

/* INSERT DEFAULT DATA
   - this data can be modified, however this is standard setup and
     any change here might lead to malfunction of SiteBar 3.
*/

INSERT INTO `sitebar_config` VALUES();

INSERT INTO `sitebar_user` (`uid`, `username`, `comment`, `verified`, `approved`)
VALUES (1, 'Admin', 'Administrator of the system', 1, 1);

INSERT INTO `sitebar_user` (`uid`, `username`, `name`, `verified`, `approved`, `params`)
VALUES (2, 'Anonymous', 'Anonymous user', 1, 1, 'root_order=2~1');

INSERT INTO `sitebar_group` VALUES (1, 'Admins', 'Hardcoded group for administrators', 1);
INSERT INTO `sitebar_group` VALUES (2, 'Publishers', 'Group of people that can publish', 1);

INSERT INTO `sitebar_node` (`nid`,`nid_parent`,`name`,`comment`)
VALUES (1, 0, 'Admin Bookmarks', 'Bookmarks of SiteBar Administrators');

INSERT INTO `sitebar_node` (`nid`,`nid_parent`,`name`,`comment`)
VALUES (2, 0, 'Public Bookmarks',  NULL);

INSERT INTO `sitebar_node` (`nid`,`nid_parent`,`name`,`comment`, `sort_mode`)
VALUES (3, 2, 'SiteBar Project', 'Bookmarks related to the SiteBar open source project.', 'custom');

INSERT INTO `sitebar_node` (`nid`,`nid_parent`,`name`,`comment`, `sort_mode`)
VALUES (4, 2, 'Web Search', 'Type a search term in the toolbar and click on one of the links to search this term using that search engine. Using the SiteBar Sidebar Extension for Mozilla Firefox you can middle click on the folder to search all engines each in its own tab.', 'custom');

INSERT INTO `sitebar_member` (`gid`,`uid`,`share`,`moderator`,`confirmed`,`invitator`)
VALUES (1, 1, 1, 1, 1, NULL);
INSERT INTO `sitebar_member` (`gid`,`uid`,`share`,`moderator`,`confirmed`,`invitator`)
VALUES (2, 1, 1, 1, 1, NULL);
INSERT INTO `sitebar_member` (`gid`,`uid`,`share`,`moderator`,`confirmed`,`invitator`)
VALUES (2, 2, 0, 0, 1, NULL);

INSERT INTO `sitebar_root` VALUES (1, 1);
INSERT INTO `sitebar_root` VALUES (2, 1);

INSERT INTO `sitebar_acl` VALUES (1, 1, 1, 1, 1, 1);
INSERT INTO `sitebar_acl` VALUES (1, 2, 1, 1, 1, 1);
INSERT INTO `sitebar_acl` VALUES (2, 2, 1, 0, 0, 0);
