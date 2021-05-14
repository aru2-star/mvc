<?php

namespace Model\Core;
class Url 
{
    protected $request = null;
    public function __construct()
    {
		$this->setRequest();
    }

    function setRequest() {
		$this->request = \Mage::getModel('Model\Core\Request');
		return $this;
	}

    public function getRequest()
    {
        return $this->request;
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
		return "http://localhost/cybercom/index.php?$query_String";
	
	}

	public function baseUrl($subUrl=null)
	{
		$url = 'http://localhost/cybercom/';
		if ($subUrl) {
			$url= $url.$subUrl;
		}
		return $url;
	}
}


?>