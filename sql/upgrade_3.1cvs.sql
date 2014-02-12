ALTER TABLE `sitebar_link`
    DROP `urlchk`;

ALTER TABLE `sitebar_link`
    DROP INDEX `url`;

UPDATE `sitebar_config`
    SET `release` = '3.1 CVS2';
