<?php
/** @var Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->run("
    CREATE TABLE `global_search` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`module` VARCHAR(255) NOT NULL,
	`field` VARCHAR(255) NOT NULL,
	`type` SMALLINT(6) NOT NULL,
	`is_fuzzy` SMALLINT(6) NOT NULL,
	PRIMARY KEY (`id`)
    )
    COLLATE='utf8_general_ci'
    ENGINE=MyISAM
    ;
");

$installer->endSetup();