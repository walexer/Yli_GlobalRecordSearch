<?php 

class Yli_GlobalRecordSearch_Block_Adminhtml_Grsearch_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('grsearchGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }
    
     protected function _prepareCollection()
    {
        $collection = Mage::getModel('grsearch/grsearch')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    } 
    
    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header' => Mage::helper('grsearch')->__('ID'),
            'align' =>'left',
            'width' => '50px',
            'index' => 'id',
        ));
        
        $this->addColumn('module', array(
            'header' => Mage::helper('grsearch')->__('Module'),
            'align' =>'left',
            'width' => '50px',
            'index' => 'module',
        ));
        
        $this->addColumn('field', array(
            'header' => Mage::helper('grsearch')->__('Field'),
            'align' =>'left',
            'width' => '50px',
            'index' => 'field',
        ));
        
        $this->addColumn('type', array(
            'header' => Mage::helper('grsearch')->__('Type'),
            'align' =>'left',
            'width' => '50px',
            'index' => 'type',
            'type'    => 'options',
            'options' => array(
					'1' => Mage::helper('adminhtml')->__('Alphanumeric'), 
					'2' => Mage::helper('adminhtml')->__('Alphabetical'), 
					'3' => Mage::helper('adminhtml')->__('Numeric')
            ),
        ));
        
        $this->addColumn('is_fuzzy', array(
            'header' => Mage::helper('grsearch')->__('Is Fuzzy'),
            'align' =>'left',
            'width' => '50px',
            'index' => 'is_fuzzy',
            'type'    => 'options',
            'options' => array(
                '1' => Mage::helper('adminhtml')->__('Fuzzy'),
                '2' => Mage::helper('adminhtml')->__('Precise')
            ),
        ));
        return parent::_prepareColumns();
    }
    
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
    
    
}