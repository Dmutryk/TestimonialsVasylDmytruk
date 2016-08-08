<?php
class VD_Test_Block_Adminhtml_Test_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
        $helper = Mage::helper('vdtest');
        $model = Mage::registry('current_test');

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array(
                'id' => $this->getRequest()->getParam('id')
            )),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));

        $this->setForm($form);

        $fieldset = $form->addFieldset('test_form', array('legend' => $helper->__('Test Information')));

        $fieldset->addField('testimonial_id', 'text', array(
            'label' => $helper->__('Testimonial_id'),
            'required' => true,
            'name' => 'testimonial_id',
        ));

        $fieldset->addField('name', 'editor', array(
            'label' => $helper->__('Name'),
            'required' => true,
            'name' => 'name',
        ));

        $fieldset->addField('testimonial', 'editor', array(
            'label' => $helper->__('Testimonial'),
            'required' => true,
            'name' => 'testimonial',
        ));

        $fieldset->addField('created_time', 'date', array(
            'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'label' => $helper->__('Created'),
            'name' => 'created_time'
        ));

        $form->setUseContainer(true);

        if($data = Mage::getSingleton('adminhtml/session')->getFormData()){
            $form->setValues($data);
        } else {
            $form->setValues($model->getData());
        }

        return parent::_prepareForm();
    }

}