ALTER TABLE `sitebar_group`
    DROP `moderator_sharing`;

ALTER TABLE `sitebar_acl`
    DROP `allow_purge`,
    DROP `allow_grant`;

UPDATE `sitebar_config`
   SET `release` = '3.3.11';
