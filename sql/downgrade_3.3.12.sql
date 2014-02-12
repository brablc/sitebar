ALTER TABLE `sitebar_group`
    ADD `allow_addself` tinyint(1) NOT NULL DEFAULT '0';

ALTER TABLE `sitebar_group`
    ADD `allow_contact` tinyint(1) NOT NULL DEFAULT '0';

ALTER TABLE `sitebar_group`
    ADD `is_usergroup` tinyint(1) NOT NULL default '0';

ALTER TABLE `sitebar_group`
    ADD `auto_join` text;

ALTER TABLE `sitebar_group`
    ADD `cannot_leave` tinyint(1) NOT NULL default '0';

ALTER TABLE `sitebar_group`
    ADD `join_on_signup` tinyint(1) NOT NULL default '0';

ALTER TABLE `sitebar_group`
    DROP `uid`;

ALTER TABLE `sitebar_config`
    ADD `gid_admins` int(10) unsigned NOT NULL DEFAULT '1';

ALTER TABLE `sitebar_config`
    ADD `gid_everyone` int(10) unsigned NOT NULL DEFAULT '2';

ALTER TABLE `sitebar_member`
    DROP `share`;

ALTER TABLE `sitebar_member`
    DROP `confirmed`;

ALTER TABLE `sitebar_member`
    DROP `invitator`;

UPDATE `sitebar_config`
    SET `release` = '3.3.11';
