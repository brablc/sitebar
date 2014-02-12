CREATE TABLE `sitebar_favicon` (
    `favicon_md5` char(32) NOT NULL,
    `ico` blob NOT NULL,
    `t_changed` timestamp(14) NOT NULL,
    PRIMARY KEY  (`favicon_md5`)
) TYPE=MyISAM COMMENT='Contains the favicon cache.';

CREATE TABLE `sitebar_visit` (
    `lid` int(10) unsigned NOT NULL,
    `uid` int(10) unsigned NOT NULL,
    `t_visit` timestamp(14) NOT NULL,
    PRIMARY KEY  (`lid`,`uid`)
) TYPE=MyISAM COMMENT='Last link visit for each user';

ALTER TABLE `sitebar_link`
    CHANGE `favicon` `favicon` TEXT DEFAULT NULL;

ALTER TABLE `sitebar_link`
    ADD `hits` int(10) unsigned NOT NULL default '0';

ALTER TABLE `sitebar_node`
    ADD `sort_mode` char(10) default 'user',
    ADD `custom_order` text;

UPDATE `sitebar_config`
    SET `release` = '3.2';
