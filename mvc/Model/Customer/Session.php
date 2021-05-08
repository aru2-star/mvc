<?php
namespace Model\Customer;

\Mage::loadFileByClassName('Model\Core\Session');

class Session extends \Model\Core\Session
{
    protected $nameSpace = "customer";
    public function __construct() {
        parent::__construct();
        $this->setNameSpace($this->nameSpace);
    }
}

?>