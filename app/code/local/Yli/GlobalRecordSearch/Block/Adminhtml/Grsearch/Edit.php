<?php

class Yli_GlobalRecordSearch_Block_Adminhtml_Grsearch_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'grsearch';
        $this->_controller = 'adminhtml_grsearch';
    
        parent::__construct();
    
        $this->_updateButton('save', 'label', Mage::helper('grsearch')->__('Save Field'));
        $this->_updateButton('delete', 'label', Mage::helper('grsearch')->__('Delete Field'));
    }
    
    public function getHeaderText()
    {
        if(Mage::registry('field_data') && Mage::registry('field_data')->getId()) {
            return Mage::helper('grsearch')->__("Edit Field '%s'", $this->htmlEscape(Mage::registry('field_data')->getField()));
        } else {
            return Mage::helper('grsearch')->__('Add Field');
        }
    }
}