ALTER TABLE `sitebar_user`
    DROP `email`;

ALTER TABLE `sitebar_user`
    CHANGE `username` `email` VARCHAR( 50 ) NOT NULL;

ALTER TABLE `sitebar_user`
    DROP INDEX `username` ,
    ADD UNIQUE `email` ( `email` );

UPDATE `sitebar_config`
    SET `release` = '3.3.6';
