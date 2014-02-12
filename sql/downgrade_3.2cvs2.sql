ALTER TABLE `sitebar_link`
  DROP `hits`;

DROP TABLE `sitebar_visit`;

UPDATE `sitebar_config`
   SET `release` = '3.2 CVS';
