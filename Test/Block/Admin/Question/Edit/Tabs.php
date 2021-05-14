<?php
namespace Block\Admin\Question\Edit;
\Mage::loadFileByClassName('Block\Core\Edit\Tabs');

class Tabs extends \Block\Core\Edit\Tabs
{
    protected $tabs = [];
    protected $defaultTab = null;
    public function __construct()
    {
        parent::__construct();
        $this->prepareTabs();
    }

    public function prepareTabs()
    {
        $this->addTab('question',['label'=>'Question','block'=>'Block\Admin\Question\Edit\Tabs\Form']);
        $this->addTab('choice',['label'=>'Choices','block'=>'Block\Admin\Question\Edit\Tabs\Option']);
        $this->setDefaultTab('question');
        return $this;
    }

    
}

?>