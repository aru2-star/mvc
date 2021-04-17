<?php

namespace Controller\Core;
\Mage::loadFileByClassName('Block\Core\Layout');
\Mage::loadFileByClassName('Controller\Core\Abstracts');

class Customer extends \Controller\Core\Abstracts{
	
	public function setLayout($layout=null) {
		if(!$layout){
			$layout = \Mage::getBlock('Block\Customer\Layout');
		}
		$this->layout = $layout;
		return $this;
	}

	public function setMessage($message = null)
	{
		$this->message =  \Mage::getModel('Model\Customer\Message');
		return $this;
	}
	
}

?>