ALTER TABLE `sitebar_user`
    CHANGE `email` `username` VARCHAR( 50 ) NOT NULL;

ALTER TABLE `sitebar_user`
    ADD `email` VARCHAR( 50 ) AFTER `pass`;

ALTER TABLE `sitebar_user`
    DROP INDEX `email` ,
    ADD UNIQUE `username` ( `username` );

UPDATE `sitebar_user`
SET email = username
WHERE username LIKE '%@%.%';

UPDATE `sitebar_config`
   SET `release` = '3.3.6a';
