<?php
namespace Block\Customer;
\Mage::loadFileByClassName('Block\Core\Layout');

class Layout extends \Block\Core\Layout 
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/customer/layout.php');
    }
    public function prepareChildren() {
        $this->addChild($this->createBlock('Block\Customer\Layout\Content'), 'content');
        $this->addChild($this->createBlock('Block\Customer\Layout\Header'), 'header');
        $this->addChild($this->createBlock('Block\Customer\Layout\Footer'), 'footer');
        $this->addChild($this->createBlock('Block\Customer\Layout\Left'),'left');
        $this->addChild($this->createBlock('Block\Customer\Layout\Right'), 'right');
    }

}
?>