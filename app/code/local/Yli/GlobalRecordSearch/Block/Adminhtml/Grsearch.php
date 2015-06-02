<?php

class Yli_GlobalRecordSearch_Block_Adminhtml_Grsearch extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_grsearch';
        $this->_blockGroup = 'grsearch';
        $this->_headerText = Mage::helper('grsearch')->__('Fields Manager');
        $this->_addButtonLabel = Mage::helper('grsearch')->__('Add Field');
        parent::__construct();
    }
}