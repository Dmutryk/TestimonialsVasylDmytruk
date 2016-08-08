<?php

class VD_Test_Model_Resource_Test extends Mage_Core_Model_Mysql4_Abstract
{

    public function _construct()
    {
        $this->_init('vdtest/table_test', 'testimonial_id');

    }

}