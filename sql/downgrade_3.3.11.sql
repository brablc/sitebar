ALTER TABLE `sitebar_group`
    ADD `moderator_sharing` tinyint(1) NOT NULL default '0';

ALTER TABLE `sitebar_acl`
    ADD `allow_purge` tinyint(1) NOT NULL DEFAULT '0',
    ADD `allow_grant` tinyint(1) NOT NULL DEFAULT '0';

UPDATE `sitebar_config`
    SET `release` = '3.3.10';
