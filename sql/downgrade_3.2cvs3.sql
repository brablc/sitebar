ALTER TABLE `sitebar_node`
    DROP `sort_mode`,
    DROP `custom_order`;

UPDATE `sitebar_config`
   SET `release` = '3.2 CVS2';
