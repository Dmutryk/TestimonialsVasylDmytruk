<?php

class VD_Test_Model_Resource_Connection extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('vdtest/table_connection', 'connection_id');
    }

}