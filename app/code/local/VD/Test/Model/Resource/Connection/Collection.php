<?php
class VD_Test_Model_Resource_Connection_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{

    public function _construct()
    {
        parent::_construct();

        $this->_init('vdtest/connection');
    }

    public function delete()
    {
        foreach ($this as $object) {
            $object->delete();
        }
    }
}