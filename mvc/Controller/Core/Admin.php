<?php

namespace Controller\Core;
\Mage::loadFileByClassName('Block\Core\Layout');
\Mage::loadFileByClassName('Controller\Core\Abstracts');

class Admin extends \Controller\Core\Abstracts{

	public function setLayout($layout=null) {
		if(!$layout){
			$layout = \Mage::getBlock('Block\Admin\Layout');
		}
		$this->layout = $layout;
		return $this;
	}
	
	public function setMessage($message = null)
	{
		$this->message =  \Mage::getModel('Model\Admin\Message');
		return $this;
	}
}

?>