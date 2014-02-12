ALTER TABLE `sitebar_favicon`
    CHANGE `ico` `ico` BLOB NOT NULL ,
    CHANGE `changed` `t_changed` timestamp(14) NOT NULL;

ALTER TABLE `sitebar_link`
    CHANGE `changed` `t_changed` timestamp(14) NOT NULL,
    CHANGE `tested` `t_tested` timestamp(14) NOT NULL,
    DROP `validate`;

ALTER TABLE `sitebar_visit`
    CHANGE `visit` `t_visit` timestamp(14) NOT NULL;

ALTER TABLE `sitebar_session`
    CHANGE `created` `created` datetime NOT NULL;

UPDATE `sitebar_config`
    SET `release` = '3.2';
