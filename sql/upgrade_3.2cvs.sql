CREATE TABLE `sitebar_visit` (
    `lid` int(10) unsigned NOT NULL,
    `uid` int(10) unsigned NOT NULL,
    `t_visit` timestamp(14) NOT NULL,
    PRIMARY KEY  (`lid`,`uid`)
) TYPE=MyISAM COMMENT='Last link visit for each user';

ALTER TABLE `sitebar_link`
    ADD `hits` int(10) unsigned NOT NULL default '0';

UPDATE `sitebar_config`
    SET `release` = '3.2 CVS2';
