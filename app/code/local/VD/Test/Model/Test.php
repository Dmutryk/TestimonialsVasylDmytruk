<?php
class VD_Test_Model_Test extends Mage_Core_Model_Abstract
{

public function _construct()
{
parent::_construct();
$this->_init('vdtest/test');
//$this->_init('vdtest/connection');
}

}