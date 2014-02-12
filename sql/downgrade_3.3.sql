ALTER TABLE sitebar_user
    DROP `visited`,
    DROP `visits`;

UPDATE `sitebar_config`
    SET `release` = '3.3 RC1';
