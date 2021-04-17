<?php
namespace Model\Admin;
\Mage::loadFileByClassName('Model\Admin\Session');

class Message extends \Model\Admin\Session{
    
    public function setSuccess($message = null)
    {
        $this->success = $message;
        return $this;
    }

    public function getSuccess()
    {
        return $this->success;
    }
    public function clearSuccess()
    {
        unset($this->success);
    }
    
    public function setFailure($message = null)
    {
        $this->failure = $message;
        return $this;
    }

    public function getFailure()
    {
        return $this->failure;
    }
    public function clearFailure()
    {
        unset($this->failure);
    }
}
?>