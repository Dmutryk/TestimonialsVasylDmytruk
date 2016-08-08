<?php
class VD_Test_Block_Form extends Mage_Core_Block_Template {


    public function _prepareLayout() {
        $this->getLayout()->getBlock('head')->setTitle(Mage::helper('vdtest')->__('Testimonial Form'));
        $this->setTemplate('vd_test/form.phtml');
        return parent::_prepareLayout();
    }


    public function isCustomerLoggedIn() {
        return Mage::getSingleton('customer/session')->isLoggedIn();
    }


    public function getCustomer () {
        return Mage::getSingleton('customer/session')->getCustomer();
    }

}