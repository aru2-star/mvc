<?php
Mage::loadFileByClassName('Model_Core_Session');

class Model_Core_Message extends Model_Core_Session
{
    public function __construct()
    {
        parent::__construct();
        $this->setNameSpace('core');
    }

    public function setSuccess($message)
    {
        $this->success = $message;
    }

    public function getSuccess()
    {
        return $this->success;
    }

    public function setFailure($message)
    {
        $this->failure = $message;
    }

    public function getFailure()
    {
        return $this->failure;
    }
}
