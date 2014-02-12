ALTER TABLE `sitebar_group`
    ADD `is_usergroup` tinyint(1) NOT NULL default '0' AFTER `allow_contact`;

ALTER TABLE `sitebar_user`
    ADD `approved` tinyint(1) NOT NULL default '0' AFTER `verified`;

UPDATE `sitebar_config`
    SET `release` = '3.3 CVS5';
