ALTER TABLE `sitebar_group`
    DROP `cannot_leave`,
    DROP `join_on_signup`,
    DROP `moderator_sharing`;

UPDATE `sitebar_config`
    SET `release` = '3.3.9';
