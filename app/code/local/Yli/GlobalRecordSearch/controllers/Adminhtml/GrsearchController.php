<?php

class Yli_GlobalRecordSearch_Adminhtml_GrsearchController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Global Record Search'));

        $this->loadLayout();
        $this->_setActiveMenu('system/tools');

        $this->_addContent($this->getLayout()->createBlock('grsearch/adminhtml_grsearch'));
        $this->renderLayout();
    }
    
    public function newAction()
    {
        $this->getRequest()->setParam('id', 0);
        $this->_forward('edit');
    }
    
    public function editAction()
    {
        $this->_title($this->__('Search Field'));
        
        $id = $this->getRequest()->getParam('id');
        $grsearchModel = Mage::getModel('grsearch/grsearch')->load($id);
        
        if ($grsearchModel->getId() || $id == 0) {
            $this->_title($grsearchModel->getId() ? $grsearchModel->getField() : $this->__('New Field'));
            
            Mage::register('field_data', $grsearchModel);
            
            $this->loadLayout();
            $this->_setActiveMenu('system/tools');
            
            $this->_addContent($this->getLayout()->createBlock('grsearch/adminhtml_grsearch_edit'));
            
            $this->renderLayout();
        }else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('grsearch')->__('The field does not exist.'));
            $this->_redirect('*/*/');
        }
    }
    
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
        
            $id = $this->getRequest()->getParam('id');
            $model = Mage::getModel('grsearch/grsearch')->load($id);
            if (!$model->getId() && $id) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('grsearch')->__('This field no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        
            $model->setData($data);
        
            try {
                $model->save();
        
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('grsearch')->__('The field has been saved.'));
        
                Mage::getSingleton('adminhtml/session')->setFormData(false);
        
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId(), '_current'=>true));
                    return;
                }
        
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }
    
}