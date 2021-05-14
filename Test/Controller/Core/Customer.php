<?php

namespace Controller\Core;
\Mage::loadFileByClassName('Controller\Core\Abstracts');
class Customer extends Abstracts 
{
	protected $session = null;
	protected $message = null;

	function __construct(){
		parent::__construct();
		$this->setSession();
		$this->setMessage();
	}
	function setSession() {
		if($this->session){
			$this->session = \Mage::getModel('Model\Customer\Session');
		}
	}


	function setMessage() {
		if(!$this->message){
			$this->message = \Mage::getModel('Model\Customer\Message');
		}
		return $this;
	}

	function getSession() {
		return $this->session;
	}

	function getMessage() {
		return $this->message;
	}

	public function setLayout(\Block\Core\Layout $layout = null)
	{
		if (!$layout) {
			$layout = \Mage::getBlock('Block\Customer\Layout');
		}

		if (!$layout instanceof \Block\Customer\Layout) {
			throw new Exception("Must be an instance of Block\Customer\Layout");
			
		}

		$this->layout = $layout;
		return $this;
	}

}

?>