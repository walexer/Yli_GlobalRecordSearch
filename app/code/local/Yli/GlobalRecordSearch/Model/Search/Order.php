<?php 

class Yli_GlobalRecordSearch_Model_Search_Order extends Mage_Adminhtml_Model_Search_Order
{
    public function load()
    {
       
        $arr = array();
    
        if (!$this->hasStart() || !$this->hasLimit() || !$this->hasQuery()) {
            $this->setResults($arr);
            return $this;
        }
    
        $query = $this->getQuery();
        //TODO: add full name logic
        $collection = Mage::getResourceModel('sales/order_collection')
            ->addAttributeToSelect('*');
            $fields = Mage::getModel('grsearch/grsearch')->getCollection()
            ->addFieldToFilter('module','order');
            $conditions = array();
            foreach ($fields as $field){
                if($this->isTypeSuit($field->getType(), $this->getQuery())){
                    if ($field->getIsFuzzy() == '1'){
                        $conditions[] = array('attribute'=>$field->getField(), 'like' => $this->getQuery().'%');
                    }else{
                        $conditions[] = array('attribute'=>$field->getField(), 'eq' => $this->getQuery());
                    }
                }
            }
            $collection->addAttributeToSearchFilter($conditions);
            
            $collection->setCurPage($this->getStart())
            ->setPageSize($this->getLimit())
            ->load();
    
        foreach ($collection as $order) {
            $arr[] = array(
                'id'                => 'order/1/'.$order->getId(),
                'type'              => Mage::helper('adminhtml')->__('Order'),
                'name'              => Mage::helper('adminhtml')->__('Order #%s', $order->getIncrementId()),
                'description'       => $order->getBillingFirstname().' '.$order->getBillingLastname(),
                'form_panel_title'  => Mage::helper('adminhtml')->__('Order #%s (%s)', $order->getIncrementId(), $order->getBillingFirstname().' '.$order->getBillingLastname()),
                'url' => Mage::helper('adminhtml')->getUrl('*/sales_order/view', array('order_id'=>$order->getId())),
            );
        }
    
        $this->setResults($arr);
    
        return $this;
    }
    
    protected function isTypeSuit($type,$query)
    {
        if($type == '3' && !is_numeric($query)){
            return false;
        }
    
        return true;
    }
}