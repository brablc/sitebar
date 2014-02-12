ALTER TABLE `sitebar_group`
    ADD `cannot_leave` tinyint(1) NOT NULL default '0',
    ADD `join_on_signup` tinyint(1) NOT NULL default '0',
    ADD `moderator_sharing` tinyint(1) NOT NULL default '0';

UPDATE `sitebar_config`
   SET `release` = '3.3.10';
