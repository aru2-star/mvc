<?php
namespace Block\Core\Edit; 
\Mage::loadFileByClassName('Block\Core\Template');  

class Tabs extends \Block\Core\Template
{
    protected $tabs = [];
    protected $tableRow = null;
    protected $defaultTab = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/core/edit/tabs.php');
        $this->prepareTabs();
    }

    public function prepareTabs()
    {
        return $this;
    }

    public function setTableRow(\Model\Core\Table $tableRow)
    {
        $this->tableRow = $tableRow;
        return $this;
    }

    public function getTableRow()
    {
        return $this->tableRow;
    }

    public function setDefaultTab($defaultTab)
    {
        $this->defaultTab = $defaultTab;
        return $this;
    }
    public function getDefaultTab(){
        return $this->defaultTab;
    }
    public function setTabs(array $tabs=[])
    {
        $this->tabs = $tabs;
        return $this;
    }

    public function getTabs()
    {
        return $this->tabs;
    }

    public function addTab($key,$tab=[])
    {
        $this->tabs[$key] = $tab;
        return $this;
    }

    public function getTab($key)
    {
        if (!array_key_exists($key,$this->tabs)) {
            return null;
        }
        return $this->tab[$key];
    }

    public function removeTab($key)
    {
        if (array_key_exists($key,$this->tabs)) {
            unset($this->tabs[$key]);   
        }
        return $this;
    }
}

?>