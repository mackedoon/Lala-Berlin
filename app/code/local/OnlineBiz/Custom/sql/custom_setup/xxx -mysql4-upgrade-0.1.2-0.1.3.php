<?php



$installer = $this;
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();

// $installer->run("ALTER TABLE  `cms_block` ADD  `sort_order` SMALLINT( 6 ) NULL");

$installer->endSetup();