<?php
namespace Block\Admin\Config\Edit;
\Mage::loadFileByClassName('Block\Core\Edit\Tabs');

class Tabs extends \Block\Core\Edit\Tabs
{
    
    public function prepareTabs()
    {
        $this->addTab('information',['label' => 'Information','block' => 'Block\Admin\Config\Edit\Tabs\Information']);
        $this->addTab('config',['label' => 'Config','block' => 'Block\Admin\Config\Edit\Tabs\Config']);
        
        $this->setDefaultTab('information');
        return $this;
    }

}
?>