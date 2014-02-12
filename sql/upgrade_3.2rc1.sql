ALTER TABLE `sitebar_favicon` DROP `accessed`;

UPDATE `sitebar_config`
    SET `release` = '3.2 RC2';
