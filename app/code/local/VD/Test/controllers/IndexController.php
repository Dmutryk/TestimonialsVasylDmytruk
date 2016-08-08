<?php
/**
 * Created by PhpStorm.
 * User: Sladar
 * Date: 01.08.2016
 * Time: 17:47
 */
class VD_Test_IndexController extends Mage_Core_Controller_Front_Action{


    public function indexAction()
    {
            $this->loadLayout();
            $this->renderLayout();
    }

    public function viewAction()
    {
        $testId = Mage::app()->getRequest()->getParam('id', 0);
        $test = Mage::getModel('vdtest/test')->load($testId);

        if ($test->getId() > 0) {
            $this->loadLayout();
            $this->getLayout()->getBlock('test.content')->assign(array(
                "testItem" => $test,
            ));
            $this->renderLayout();
        } else {
            $this->_forward('noRoute');
        }
    }
    public function thankmessageAction() {
        $message='Thank You for your testimonial!';

        Mage::getSingleton('core/session')->addSuccess($message);

        $this->_redirect('*/index');

    }
}