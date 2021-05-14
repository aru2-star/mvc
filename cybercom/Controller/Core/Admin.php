<?php
namespace Controller\Core;
\Mage::loadFileByClassName('Controller\Core\Abstracts');

class Admin  extends Abstracts
{
	public function __construct()
	{
		parent::__construct();
		$this->setSession();
		$this->setMessage();
	}
	public function setSession() {
		if (!$this->session) {
			$this->session = \Mage::getModel('Model\Admin\Session');
		}
		return $this;
	}

	public function getSession() {
		return $this->session;
	}
	
	public function setMessage() {
		if (!$this->message) {
			$this->message = \Mage::getModel('Model\Admin\Message');	
		}
		
		return $this;
	}

	public function getMessage() {
		return $this->message;
	}
	
	public function setLayout(\Block\Core\Layout $layout = null)
	{
		if (!$layout) {
			$layout = \Mage::getBlock('Block\Admin\Layout');
		}

		if (!$layout instanceof \Block\Admin\Layout) {
			throw new Exception("Error");
			
		}
		
		$this->layout = $layout;
		return $this;
	}

	
}

?>