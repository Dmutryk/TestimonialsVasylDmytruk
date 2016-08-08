<?php
class VD_Test_FormController extends Mage_Core_Controller_Front_Action {

	public function indexAction() {

		$this->loadLayout();
		$this->renderLayout();
	}

	public function save() {
        $testimonialTable = Mage::getModel('vdtest/test');
		$post = $this->getRequest()->getPost();
		$connTable = Mage::getModel('vdtest/connection');
		if ($post) {

			//Save to datatabase
			try {
				$testimonialTable->setData($post);

				$now = Mage::getModel('core/date')->timestamp(now());
				$testimonialTable->setCreatedTime(date('Y-m-d H:i:s',$now));
				$testimonialTable->save();

				//create connection data and save it
				$customerData = Mage::getSingleton('customer/session')->getCustomer();
				$testimonial_id=$testimonialTable->getData('testimonial_id');
				$user_id=$customerData->getId();
				$connectionData=array('user_id'=>$user_id,'testimonial_id'=>$testimonial_id);

				$connTable->setData($connectionData);
				$connTable->save();

				$this->_redirect('*/index/thankmessage');
			}
			catch (Exception $e) {
				echo $e->getMessage();
			}	
		}
		else
		$this->_redirect('');
	}

	public function postAction() {

		$sessionCustomer = Mage::getSingleton("customer/session");
		if(!$sessionCustomer->isLoggedIn()) {
				Mage::getSingleton('core/session')->addError('Please Log in before send your testimonial!');
				$this->_redirect('*/form');
		}
		else $this->save();					
	}

}


