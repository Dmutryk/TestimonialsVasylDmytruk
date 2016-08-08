<?php
class VD_Test_Block_Adminhtml_Test_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('vdtest/test')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $helper = Mage::helper('vdtest');

        $this->addColumn('testimonial_id', array(
            'header' => $helper->__('Testimonial ID'),
            'index' => 'testimonial_id'
        ));

        $this->addColumn('name', array(
            'header' => $helper->__('Name'),
            'index' => 'name',
            'type' => 'text',
        ));

        $this->addColumn('testimonial', array(
            'header' => $helper->__('Testimonial'),
            'index' => 'testimonial',
            'type' => 'text',
        ));

        $this->addColumn('created_time', array(
            'header' => $helper->__('Created'),
            'index' => 'created_time',
            'type' => 'date',
        ));

        return parent::_prepareColumns();
    }
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('testimonial_id');
        $this->getMassactionBlock()->setFormFieldName('test');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => $this->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
        ));
        return $this;
    }
    public function getRowUrl($model)
    {
        return $this->getUrl('*/*/edit', array(
            'id' => $model->getId(),
        ));
    }
}