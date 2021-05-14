<?php
namespace Model\Core;

class Request 
{
	public function getPost($key = null,$optional = null) {
		if (!$key) {
			return $_POST;
			//return $_POST['name'];

		}
		if (!array_key_exists($key, $_POST)) {
			return $optional;
		}
		return$_POST[$key];

	}

	public function getGet($key = null,$optional=null) {

		if (!$key) {
			return $_GET;
			//return $_GET['name'];
		}
		if (!array_key_exists($key, $_GET)) {
			return $optional;
		}
		return$_GET[$key];
	}



	public function isPost() {

		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			return false;
		}
		return true;
	}

	function getActionName() {
		return $this->getGet('a','index');
	
	}

	function getControllerName() {
		return $this->getGet('c','admin_index');
	}

	
}

?>