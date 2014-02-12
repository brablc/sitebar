UPDATE `sitebar_config`
   SET `release` = '3.3.1';

UPDATE `sitebar_user`
   SET `approved` = 1
 WHERE uid < 3;
