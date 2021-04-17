<?php

namespace Block\Admin\CustomerGroup\Edit;
\Mage::loadFileByClassName('Block\Core\Edit\Tabs');

class Tabs extends \Block\Core\Edit\Tabs
{

    public function prepareTabs()
    {
        $this->addTab('customerGroup',['label' => 'CustomerGroup Information','block' => 'Block\Admin\CustomerGroup\Edit\Tabs\Form']);
        
        $this->setDefaultTab('customerGroup');
        return $this;
    }

    
}
?>