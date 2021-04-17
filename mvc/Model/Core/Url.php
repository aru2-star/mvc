<?php
namespace Model\Core;
class Url
{
    protected $request = null;
    
    public function setRequest() {
		$this->request = \Mage::getModel('Model\Core\Request');
		return $this;
	}
	public function getRequest() {
		if(!$this->request){
			$this->setRequest();
		}
		return $this->request;
    }
    public function getUrl($actionName = Null, $controllerName = Null, $params = Null, $resetParams = false) {
		$final = $_GET;
		if($resetParams) {
			$final = [];
		}
		if($actionName == Null) {
			$actionName	= $_GET['a'];
		}
		if($controllerName == Null) {
			$controllerName = $_GET['c'];
		}
		if($params == Null) {
			$params = [];
		}

		$final['c'] = $controllerName;
		$final['a'] = $actionName;

		$final = array_merge($final,$params);
		$queryString = http_build_query($final);
		unset($final);
		return "http://localhost/mvc/index.php?{$queryString}";
	}
	public function baseUrl($subUrl = null){
		$url = "http://localhost/mvc/";
		if($subUrl){
			$url .=$subUrl;
		}
		return $url;
	}
}

?>