<?php

namespace Controller\Core;

class Abstracts  
{
	protected $layout = null;
	protected $request = null;
	protected $session = null;
	protected $message = null;

	public function __construct() {
		$this->setRequest();
		$this->setLayout();
		
	}

	function setRequest() {
		$this->request = \Mage::getModel('Model\Core\Request');
		return $this;
	}

	function getRequest() {
		return $this->request;
	}

	function getSession() {
		return $this->session;
	}

	function getMessage() {
		return $this->message;
	}

	public function redirect($actionName = null,$controllerName=null,$params=[],$resetParam = false)
	{
		return header('Location: '.$this->getUrl($actionName,$controllerName,$params,$resetParam));
	}

	public function getUrl($actionName = null,$controllerName=null,$params=[],$resetParam = false) {

		$urls = $this->getRequest()->getGet();
		if ($resetParam) {
			$urls = [];
		}
		if ($actionName == NULL) {
			$actionName = $_GET['a'];
		}
		if ($controllerName == NULL) {
			$controllerName = $_GET['c'];
		}
		$urls['c'] = $controllerName;
		$urls['a'] = $actionName;

		if (is_array($params)) {
			$urls = array_merge($urls,$params);
		}
		$query_String = http_build_query($urls);
		unset($urls);
		return "http://localhost/Test/index.php?$query_String";
		
	
	}

	public function setLayout(\Block\Core\Layout $layout = null)
	{
		if (!$layout) {
			$layout = \Mage::getBlock('Block\Core\Layout');
		}
		$this->layout = $layout;
		return $this;
	}

	public function getLayout()
	{
		return $this->layout;
	}

	public function renderLayout()
	{
		return $this->getLayout()->toHtml();
	}
	
}

?>