<?php

namespace Block\Admin\Attribute\Edit;
\Mage::loadFileByClassName('Block\Core\Edit\Tabs');

class Tabs extends \Block\Core\Edit\Tabs
{
    
    public function prepareTabs()
    {
        $this->addTab('form', ['key' => 'form', 'label' => 'Attribute Information', 'block' => 'Block\Admin\Attribute\Edit\Tabs\Form']);
        if($id =$this->getRequest()->getGet('id')){
        $this->addTab('option', ['key' => 'Attribute Option', 'label' => 'Option', 'block' => 'Block\Admin\Attribute\Edit\Tabs\Option']);
        }
        $this->setDefaultTab('form');
        return $this;
    }
    
}
