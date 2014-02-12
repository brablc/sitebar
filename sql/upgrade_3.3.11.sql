ALTER TABLE `sitebar_group`
    ADD `uid` int(10) unsigned NOT NULL;

UPDATE `sitebar_group`
   SET `uid` = 1;

ALTER TABLE `sitebar_group`
    DROP `allow_addself`;

ALTER TABLE `sitebar_group`
    DROP `allow_contact`;

ALTER TABLE `sitebar_group`
    DROP `is_usergroup`;

ALTER TABLE `sitebar_group`
    DROP `auto_join`;

ALTER TABLE `sitebar_group`
    DROP `cannot_leave`;

ALTER TABLE `sitebar_group`
    DROP `join_on_signup`;

ALTER TABLE `sitebar_config`
    DROP `gid_admins`;

ALTER TABLE `sitebar_config`
    DROP `gid_everyone`;

ALTER TABLE `sitebar_member`
    ADD `share` tinyint(1) NOT NULL DEFAULT '0',
    ADD `confirmed` tinyint(1) NOT NULL DEFAULT '0',
    ADD `invitator` int(10) unsigned DEFAULT NULL;

UPDATE `sitebar_member`
    SET `confirmed`=1;

UPDATE `sitebar_group`
   SET `uid` = 1;

UPDATE `sitebar_config`
   SET `release` = '3.3.12';
