<?php
namespace Block\Admin\Payment\Edit;
\Mage::loadFileByClassName('Block\Core\Edit\Tabs');

class Tabs extends \Block\Core\Edit\Tabs
{
    
    public function prepareTabs()
    {
        $this->addTab('payment',['label' => 'Payment Information','block' => 'Block\Admin\Payment\Edit\Tabs\Form']);
        
        $this->setDefaultTab('payment');
        return $this;
    }

}
?>