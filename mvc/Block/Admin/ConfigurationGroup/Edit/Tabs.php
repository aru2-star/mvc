<?php

namespace Block\Admin\ConfigurationGroup\Edit;

class Tabs extends \Block\Core\Edit\Tabs
{
	
	function __construct()
	{
		parent::__construct();
		$this->prepareTabs();
	}

	public function prepareTabs()
	{
		$this->addTab('configurationGroup',['label' => 'ConfigurationGroup', 'block' => 'Block\Admin\ConfigurationGroup\Edit\Tabs\Form']);
		$this->addTab('configuration',['label'=>'Configuration','block'=>'Block\Admin\ConfigurationGroup\Edit\Tabs\Configuration']);
        $this->setDefaultTab('configurationGroup');
        return $this;
	}
}

?>