<?php
class VD_Test_Block_Adminhtml_Test extends Mage_Adminhtml_Block_Abstract
{

    protected function _construct()
    {
        parent::_construct();

        $helper = Mage::helper('vdtest');
        $this->_blockGroup = 'vdtest';
        $this->_controller = 'adminhtml_test';

        $this->_headerText = $helper->__('Test Management');
        $this->_addButtonLabel = $helper->__('Add Test');
    }
//    public function _toHtml()
//    {
//        return '<h1>News Module: Admin section</h1>';
//    }

}