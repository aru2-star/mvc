<?php
//namespace Controller\Core;
Mage::loadFileByClassName('Block_Core_Layout');

class Controller_Core_Admin
{
    protected $request = null;
    protected $layout = null;
    protected $admin_message = null;

    public function __construct()
    {
        $this->setRequest();
    }

    public function setLayout(Block_Core_Layout $layout = null)
    {
        if (!$layout) {

            $layout = Mage::getBlock('block_core_Layout');
        }
        $this->layout = $layout;
        return $this;
    }

    public function getLayout()
    {
        if (!$this->layout) {
            $this->setLayout();
        }

        return $this->layout;
    }

    public function renderLayout()
    {
        echo $this->getLayout()->toHtml();
    }


    public function setMessage()
    {
        $this->admin_message = Mage::getModel('model_admin_message');
        return $this;
    }

    public function getMessage()
    {
        if (!$this->admin_message) {
            $this->setMessage();
        }

        return $this->admin_message;
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


    public function redirect($controllerName = null, $actionName = null, $params = null, $resetprams = false)
    {
        return header("location:{$this->getUrl($controllerName,$actionName,$params,$resetprams)}");
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
}
