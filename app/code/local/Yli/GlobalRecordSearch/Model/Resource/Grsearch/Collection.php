<?php

class Yli_GlobalRecordSearch_Model_Resource_Grsearch_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('grsearch/grsearch');
    }
}