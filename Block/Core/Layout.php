<?php
    namespace Block\Core;
    \Mage::loadFileByClassName('Block\Core\Template');
    \Mage::loadFileByClassName('Block\Core\Layout\Content');
    \Mage::loadFileByClassName('Block\Core\Layout\Header');
    \Mage::loadFileByClassName('Block\Core\Layout\Footer');
    
    class Layout extends \Block\Core\Template{

        public function __construct(){
            $this->setTemplate('./View/admin/layout/one_column.php');
            $this->prepareChildren();
        }
        public function prepareChildren() {
            $this->addChild($this->createBlock('Block\Core\Layout\Content'), 'content');
            $this->addChild($this->createBlock('Block\Core\Layout\Header'), 'header');
            $this->addChild($this->createBlock('Block\Core\Layout\Footer'), 'footer');
            $this->addChild($this->createBlock('Block\Core\Layout\Left'),'left');
            $this->addChild($this->createBlock('Block\Core\Layout\Right'), 'right');
        }
        public function getContent(){
            return $this->getChild('content');
        } 
        public function getHeader(){
            return $this->getChild('header');
        }
        public function getLeft(){
            return $this->getChild('left');
        } 
        public function getRight()
        {
            return $right = $this->getChild('right');
        }
    
    }
?>