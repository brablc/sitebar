ALTER TABLE `sitebar_favicon`
    CHANGE `ico` `ico` MEDIUMBLOB NOT NULL ,
    CHANGE `t_changed` `changed` TIMESTAMP(14) NOT NULL;

ALTER TABLE `sitebar_link`
    CHANGE `comment` `comment` LONGTEXT NOT NULL,
    CHANGE `favicon` `favicon` TEXT NOT NULL,
    CHANGE `t_changed` `changed` TIMESTAMP(14) NOT NULL,
    CHANGE `t_tested` `tested` TIMESTAMP(14) NOT NULL,
    ADD    `validate` TINYINT(1) DEFAULT '1' NOT NULL;

ALTER TABLE `sitebar_visit`
    CHANGE `t_visit` `visit` TIMESTAMP(14) NOT NULL;

ALTER TABLE `sitebar_session`
    CHANGE `created` `created` datetime NOT NULL;

UPDATE `sitebar_config`
    SET `release` = '3.2.5';
