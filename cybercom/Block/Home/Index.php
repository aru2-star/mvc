<?php
namespace Block\Home;
\Mage::loadFileByClassName('Block\Core\Template');

class Index extends \Block\Core\Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('./View/home/index.php');
	}

}

?>