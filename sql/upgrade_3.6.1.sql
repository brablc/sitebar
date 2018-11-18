SET @@sql_mode = '';

ALTER TABLE `sitebar_cache` change `created` `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `sitebar_config` change `changed` `changed` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `sitebar_link` change `added` `added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `sitebar_message` change `sent` `sent` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `sitebar_session` change `created` `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `sitebar_token` change `issued` `issued` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP;

UPDATE `sitebar_cache` SET `expires` = NULL where date(`expires`) = '0000-00-00 00:00:00';
UPDATE `sitebar_link` SET `changed` = NULL where date(`changed`) = '0000-00-00 00:00:00';
UPDATE `sitebar_link` SET `visited` = NULL where date(`visited`) = '0000-00-00 00:00:00';
UPDATE `sitebar_link` SET `tested` = NULL where date(`tested`) = '0000-00-00 00:00:00';

UPDATE `sitebar_config`
    SET `release` = '3.6.2';
