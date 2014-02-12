ALTER TABLE `sitebar_node`
  DROP `sort_mode`,
  DROP `custom_order`;

ALTER TABLE `sitebar_link`
  DROP `hits`;

DROP TABLE `sitebar_visit`;

DROP TABLE `sitebar_favicon`;

UPDATE `sitebar_config`
   SET `release` = '3.1.2';
