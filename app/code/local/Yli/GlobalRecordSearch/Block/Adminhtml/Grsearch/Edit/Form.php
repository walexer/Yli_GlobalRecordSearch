<?php

class Yli_GlobalRecordSearch_Block_Adminhtml_Grsearch_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('field_data');
    
        $form = new Varien_Data_Form(
            array(
                 'id'     => 'edit_form',
                 'action' => $this->getUrl('*/*/save'),
                 'method' => 'post'
            )
        );
        $form->setUseContainer(true);
    
        $fieldset = $form->addFieldset('field_form', array('legend'=>Mage::helper('grsearch')->__('Field information')));
    
        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }
        $fieldset->addField('module', 'text', array(
            'name' => 'module',
            'label' => Mage::helper('grsearch')->__('Field Module'),
            'title' => Mage::helper('grsearch')->__('Field Module'),
            'required' => true,
        ));
        
        $fieldset->addField('field', 'text', array(
            'name' => 'field',
            'label' => Mage::helper('grsearch')->__('Field Name'),
            'title' => Mage::helper('grsearch')->__('Field Name'),
            'required' => true,
        ));
    
        $fieldset->addField('type', 'select', array(
            'name' => 'type',
            'label' => Mage::helper('grsearch')->__('Type'),
            'title' => Mage::helper('grsearch')->__('Field Type'),
            'required' => true,
            'options' => array(
					'1' => Mage::helper('adminhtml')->__('Alphanumeric'), 
					'2' => Mage::helper('adminhtml')->__('Alphabetical'), 
					'3' => Mage::helper('adminhtml')->__('Numeric')
            ),
        ));
        
        $fieldset->addField('is_fuzzy', 'select', array(
            'name' => 'is_fuzzy',
            'label' => Mage::helper('grsearch')->__('Is Fuzzy'),
            'title' => Mage::helper('grsearch')->__('Is Fuzzy'),
            'required' => true,
            'options' => array(
                '1' => Mage::helper('adminhtml')->__('Fuzzy'),
                '2' => Mage::helper('adminhtml')->__('Precise')
            ),
        ));
    

    
        $form->setValues($model->getData());
        $this->setForm($form);
    
        return parent::_prepareForm();
    }
}