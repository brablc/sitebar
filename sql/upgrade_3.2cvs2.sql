ALTER TABLE `sitebar_node`
    ADD `sort_mode` char(10) default 'user',
    ADD `custom_order` text;

UPDATE `sitebar_config`
    SET `release` = '3.2 CVS3';
