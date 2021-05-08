<?php

namespace Controller\Core;
\Mage::loadFileByClassName('Controller\Core\Abstracts');
class Admin  extends Abstracts
{
	function __construct()
	{
		parent::__construct();
		$this->setSession();
		$this->setMessage();
	}
	function setSession() {
		if (!$this->session) {
			$this->session = \Mage::getModel('Model\Admin\Session');
		}
		return $this;
	}

	function getSession() {
		return $this->session;
	}
	
	function setMessage() {
		if (!$this->message) {
			$this->message = \Mage::getModel('Model\Admin\Message');	
		}
		
		return $this;
	}

	function getMessage() {
		return $this->message;
	}
	
	public function setLayout(\Block\Core\Layout $layout = null)
	{
		if (!$layout) {
			$layout = \Mage::getBlock('Block\Admin\Layout');
		}

		if (!$layout instanceof \Block\Admin\Layout) {
			throw new Exception("Must be an instance of Block\Admin\Layout");
			
		}
		
		$this->layout = $layout;
		return $this;
	}

	
}

?>