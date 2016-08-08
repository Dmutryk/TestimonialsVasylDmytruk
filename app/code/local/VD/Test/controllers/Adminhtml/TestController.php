<?php
class VD_Test_Adminhtml_TestController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout()->_setActiveMenu('vdtest');
        $this->_addContent($this->getLayout()->createBlock('vdtest/adminhtml_test_grid'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = (int) $this->getRequest()->getParam('id');
        $model = Mage::getModel('vdtest/test');

        if ($data = Mage::getSingleton('adminhtml/session')->getFormData()) {
            $model->setData($data)->setId($id);
        } else {
            $model->load($id);
        }
        Mage::register('current_test', $model);

        $this->loadLayout()->_setActiveMenu('vdtest');

        $this->getLayout()->getBlock('head')->addItem('skin_js', 'vd_test/adminhtml/scripts.js');
        $this->getLayout()->getBlock('head')->addItem('skin_css', 'vd_test/adminhtml/styles.css');

        $this->_addLeft($this->getLayout()->createBlock('vdtest/adminhtml_test_edit_tabs'));
        $this->_addContent($this->getLayout()->createBlock('vdtest/adminhtml_test_edit'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            try {
                $model = Mage::getModel('vdtest/test');
                $model->setData($data)->setId($this->getRequest()->getParam('id'));
                if(!$model->getCreated()){
                    $model->setCreated(now());
                }
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Testimonial was saved successfully'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array(
                    'id' => $this->getRequest()->getParam('id')
                ));
            }
            return;
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                Mage::getModel('vdtest/test')->setId($id)->delete();
                $connection = Mage::getModel('vdtest/connection')->getCollection()
                    ->addFieldToFilter('testimonial_id',$id);
                $connection->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Testimonial was deleted successfully'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
            }
        }
        $this->_redirect('*/*/');
    }
    public function massDeleteAction()
    {
        $testimonial_id = $this->getRequest()->getParam('test', null);

        if (is_array($testimonial_id) && sizeof($testimonial_id) > 0) {
            try {
                foreach ($testimonial_id as $id) {
                    $connection = Mage::getModel('vdtest/connection')->getCollection()
                        ->addFieldToFilter('testimonial_id',$id);
                    $connection->delete();
                    Mage::getModel('vdtest/test')->setId($id)->delete();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d testimonials have been deleted', sizeof($testimonial_id)));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        } else {
            $this->_getSession()->addError($this->__('Please select test'));
        }
        $this->_redirect('*/*');
    }

}
