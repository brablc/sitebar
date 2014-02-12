ALTER TABLE sitebar_user
    ADD `visited` datetime NOT  NULL DEFAULT  '0000-00-00 00:00:00',
    ADD `visits` int( 11  ) unsigned NOT  NULL DEFAULT  '0';

UPDATE `sitebar_config`
    SET `release` = '3.3';
