<?php 
namespace Block\Core;

\Mage::loadFileByClassName('Block\Core\Template');
\Mage::loadFileByClassName('Block\Core\Edit\EditInterface');

class Edit extends \Block\Core\Template implements \Block\Core\Edit\EditInterface{
    
    protected $tab = NULL;
    protected $tableRow = null;
    protected $tabClass = null;

    public function __construct() {
        $this->setTemplate('./View/core/edit.php');
    }

    public function getFormUrl()
    {
        return null;
    }

    public function getTabContent() {
        $tabBlock = $this->getTab();
        $tabs = $tabBlock->getTabs();
        $tab = $this->getRequest()->getGet('tab', $tabBlock->getDefaultTab());
        
        if(!array_key_exists($tab, $tabs)){
            return null;
        }
        $blockClassName = $tabs[$tab]['block'];
        $block = \Mage::getBlock($blockClassName);
        $block->setTableRow($this->getTableRow());
        echo $block->toHtml();
    }

    public function getTabHtml()
    {
        echo $this->getTab()->toHtml();
    }

    public function setTab($tab = null)
    {
        if(!$tab){
            $tab = $this->getTabClass();
        }
        $this->tab = $tab;
        return $this;
    }

    public function getTab()
    {
        if (!$this->tab) {
            $this->setTab();
        }
        return $this->tab;
    }

    public function setTableRow(\Model\Core\Table $tableRow=null)
    {
        $this->tableRow = $tableRow;
        return $this;
    }

    public function getTableRow()
    {
        if(!$this->tableRow){
            $this->setTableRow();
        }
        return $this->tableRow;
    }

    public function setTabClass($tabClass=null)
    {
        $this->tabClass = $tabClass;
        return $this;
    }

    public function getTabClass()
    {
        if(!$this->tabClass){
            $this->setTabClass();
        }
        return $this->tabClass;
    }
}


?>

