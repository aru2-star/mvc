<?php
namespace Model\Customer;
\Mage::loadFileByClassName('Model\Customer\Session');

class Message extends \Model\Customer\Session{
    
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