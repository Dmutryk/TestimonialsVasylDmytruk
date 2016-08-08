<?php
/**
 * Created by PhpStorm.
 * User: Sladar
 * Date: 04.08.2016
 * Time: 12:41
 */


class VD_Test_Model_Resource_Test extends Mage_Core_Model_Mysql4_Abstract
{

    public function _construct()
    {
        $this->_init('vdtest/table_test', 'testimonial_id');

    }

}