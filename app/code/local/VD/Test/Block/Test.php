<?php

class VD_Test_Block_Test extends Mage_Core_Block_Template
{
    public function addTestLink() {
        $parentBlock = $this->getParentBlock();
        if ($parentBlock && $this->helper('testmodule')->moduleEnabled()) {$text = $this->__('Testmodule');
            $url = 'test';$position = 120;
        $parentBlock->addLink($text, $url , $text, $prepare=true, $urlParams=array(), $position , null, 'class="top-link-testmodule"');
        }

        return $this;
}
    public function getTestCollection()
    {
        $page = Mage::app()->getRequest()->getParam('p');
        $limit = Mage::app()->getRequest()->getParam('limit');
        $testCollection = Mage::getModel('vdtest/test')->getCollection();

        $testCollection->setCurPage($page);
        if($limit){
            $testCollection->setPageSize($limit);
        }else{
            $testCollection->setPageSize(2);
        }
        $testCollection->setOrder('created_time', 'DESC');
        return $testCollection;
    }

    public function _prepareLayout() {
        parent::_prepareLayout();

        $pager = $this->getLayout()->createBlock('page/html_pager', 'custom.pager');
        $pager->setAvailableLimit(array(2=>2,5=>5,10=>10,20=>20,'all'=>'all'));
        $pager->setCollection($this->getTestCollection());

        $this->setChild('pager', $pager);
        $this->getTestCollection()->load();
        return $this;
    }

    public function getPagerHtml() {
        return $this->getChildHtml('pager');

    }

    public function getFormUrl() {
        return $this->helper('test')->getFormUrl();
    }

}