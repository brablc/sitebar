ALTER TABLE `sitebar_group`
    DROP `is_usergroup`;

ALTER TABLE `sitebar_user`
    DROP `approved`;

UPDATE `sitebar_config`
    SET `release` = '3.3 CVS4';
