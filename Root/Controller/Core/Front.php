<?php
//namespace Controller\Core;
Mage::loadFileByClassName('Model_Core_Request');
class Front
{

    public static function init()
    {
    	$request = new Model_Core_Request();
        //$request = \Mage::getModel("Model\Core\Request");
        $controllerName =  ucfirst($request->getGet('c'));
        $concat = "Controller_" . $controllerName;
        $actionName = $request->getGet('a') . "Action";
        require_once "./Controller/{$controllerName}.php";
        $controller = new $concat();
        $controller->$actionName();
    }
}
