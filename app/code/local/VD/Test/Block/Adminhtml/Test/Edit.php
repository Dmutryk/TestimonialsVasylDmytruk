<?php
class VD_Test_Block_Adminhtml_Test_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    protected function _construct()
    {
        $this->_blockGroup = 'vdtest';
        $this->_controller = 'adminhtml_test';
    }

    public function getHeaderText()
    {
        $helper = Mage::helper('vdtest');
        $model = Mage::registry('current_test');

        if ($model->getId()) {
            return $helper->__("Edit Testimonial item '%s'", $this->escapeHtml($model->getTitle()));
        } else {
            return $helper->__("Add Testimonial item");
        }
    }

}