<?php

class Model_Core_Url
{

    public function __construct()
    {
        $this->setRequest();
    }

    public function getRequest()
    {
        if (!$this->request) {
            $this->setRequest();
        }

        return $this->request;
    }

    public function setRequest()
    {
        $this->request = Mage::getModel('model_core_request');
        return $this;
    }

    public function getUrl($controllerName = null, $actionName = null, $params = null, $resetprams = false)
    {
        $final = $this->getRequest()->getGet();
        if ($resetprams) {
            $final = [];
        }

        if (!$controllerName) {
            $controllerName = $this->getRequest()->getGet('c');
        }
        if (!$actionName) {
            $actionName = $this->getRequest()->getGet('a');
        }

        $final['a'] = $actionName;
        $final['c'] = $controllerName;

        if (is_array($params)) {
            $final = array_merge($final, $params);
        }

        $queryString = http_build_query($final);
        unset($final);
        return "http://localhost/Root/?{$queryString}";
    }
    /*
    public function baseUrl($subUrl = null) {
        $url = "http://localhost/Project1/View/";
        if($subUrl){
            $url = $subUrl;
        }
        return $url;
    }
    */
}
