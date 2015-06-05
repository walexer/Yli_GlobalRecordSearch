<?php 

class Yli_GlobalRecordSearch_Model_Search_Customer extends Mage_Adminhtml_Model_Search_Customer
{
    public function load()
    {
       
        $arr = array();
    
        if (!$this->hasStart() || !$this->hasLimit() || !$this->hasQuery()) {
            $this->setResults($arr);
            return $this;
        }
        $collection = Mage::getResourceModel('customer/customer_collection')
        ->addNameToSelect();
        $fields = Mage::getModel('grsearch/grsearch')->getCollection()
                  ->addFieldToFilter('module','customer');
        $conditions = array();
        foreach ($fields as $field){
            if ($field->getIsFuzzy() == '1'){
                $conditions[] = array('attribute'=>$field->getField(), 'like' => $this->getQuery().'%');
            }else{
                $conditions[] = array('attribute'=>$field->getField(), 'eq' => $this->getQuery());
            }
            
        }
        $collection->addAttributeToFilter($conditions);
        $collection->setPage(1, 10)
        ->load();
    
        foreach ($collection->getItems() as $customer) {
            $arr[] = array(
                'id'            => 'customer/1/'.$customer->getId(),
                'type'          => Mage::helper('adminhtml')->__('Customer'),
                'name'          => $customer->getName(),
                'description'   => $customer->getEmail(),
                'url' => Mage::helper('adminhtml')->getUrl('*/customer/edit', array('id'=>$customer->getId())),
            );
        }
    
        $this->setResults($arr);
    
        return $this;
    }
}