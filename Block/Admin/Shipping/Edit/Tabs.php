<?php

namespace Block\Admin\Shipping\Edit;
\Mage::loadFileByClassName('Block\Core\Edit\Tabs');

class Tabs extends \Block\Core\Edit\Tabs
{

    public function prepareTabs()
    {
        $this->addTab('Shipping',['label' => 'Shipping Information','block' => 'Block\Admin\Shipping\Edit\Tabs\Form']);
        
        $this->setDefaultTab('Shipping');
        return $this;
    }

    
}
?>