ALTER TABLE `sitebar_link`
   DROP `is_feed`;

ALTER TABLE `sitebar_link`
   DROP `is_sidebar`;

UPDATE `sitebar_config`
   SET `release` = '3.3.6b';
