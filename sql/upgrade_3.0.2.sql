ALTER TABLE `sitebar_link`
    DROP INDEX `url`;

ALTER TABLE `sitebar_link`
    CHANGE `comment` `comment` LONGTEXT DEFAULT NULL;

ALTER TABLE `sitebar_link`
    CHANGE `url` `url` TEXT NOT NULL DEFAULT '';

ALTER TABLE `sitebar_link`
    CHANGE `name` `name` VARCHAR(255) NOT NULL;

ALTER TABLE `sitebar_node`
    CHANGE `name` `name` VARCHAR(255) NOT NULL;

UPDATE `sitebar_config`
   SET `release` = '3.1';
