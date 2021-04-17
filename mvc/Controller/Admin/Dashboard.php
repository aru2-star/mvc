<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');
\Mage::loadFileByClassName('Block\Core\Layout');

class Dashboard extends \Controller\Core\Admin{
    public function gridAction()
    {
        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $grid = \Mage::getBlock('Block\Admin\Dashboard\Grid');
        $content->addChild($grid);
        $this->toHtmlLayout();   
    }

}