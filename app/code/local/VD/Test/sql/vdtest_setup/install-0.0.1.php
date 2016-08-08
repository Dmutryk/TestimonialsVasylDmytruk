<?php

$installer = $this;

$installer->startSetup();

$installer->run("

 DROP TABLE IF EXISTS {$this->getTable('vasyldmytruk_shoptestimonial')};
CREATE TABLE {$this->getTable('vasyldmytruk_shoptestimonial')} (
  `testimonial_id` int(11) unsigned NOT NULL auto_increment,
 `name` varchar(255) NOT NULL default '',
  `testimonial` text NOT NULL default '',
 `created_time` datetime NULL,
 PRIMARY KEY (`testimonial_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 DROP TABLE IF EXISTS {$this->getTable('testomonial_user_connection')};
CREATE TABLE `{$installer->getTable('testomonial_user_connection')}` (
`connection_id` int(11) NOT NULL auto_increment,
      `user_id` int(11),
      `testimonial_id` int(11),
      PRIMARY KEY  (`connection_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

$installer->endSetup();
