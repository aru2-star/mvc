<?php
namespace Block\Admin\Configuration\Edit;

class Tabs extends \Block\Core\Edit\Tabs
{
    public function prepareTabs()
    {
        $this->addTab('information',['label' => 'Information','block' => 'Block\Admin\Configuration\Edit\Tabs\Information']);
        if($id = $this->getRequest()->getGet('id')) {
            $this->addTab('configuration',['label' => 'Configuration','block' => 'Block\Admin\Configuration\Edit\Tabs\Configuration']); 
        }
        
        $this->setDefaultTab('information');
        return $this;
    }
}
?>