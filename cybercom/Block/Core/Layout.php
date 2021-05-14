<?php
namespace Block\Core;
\Mage::loadFileByClassName('Block\Core\Template');
class Layout extends \Block\Core\Template
{
    public function __construct()
    {
        $this->setTemplate('./View/core/layout/one_column.php');
        $this->prepareChildren();
    }
    
    public function prepareChildren()
    {
        $this->addChild($this->getBlock('Block\Core\Layout\Content'),'content');
        $this->addChild($this->getBlock('Block\Core\Layout\Header'),'header');
        $this->addChild($this->getBlock('Block\Core\Layout\Left'),'left');
        $this->addChild($this->getBlock('Block\Core\Layout\Right'),'right');
        $this->addChild($this->getBlock('Block\Core\Layout\Footer'),'footer');
    
    }

    public function getContent()
    {
        return $this->getChild('content');
    }

    
    public function getHeader()
    {
        return $this->getChild('header');
    }

    
    public function getLeft()
    {
        return $this->getChild('left');
    }

    
    public function getRight()
    {
        return $this->getChild('right');
    }

    public function getFooter()
    {
        return $this->getChild('footer');
    }
}


?>