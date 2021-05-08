<?php
namespace Model\Admin;

\Mage::loadFileByClassName('Model\Core\Session');

class Session extends \Model\Core\Session
{
    protected $nameSpace = "admin";
    public function __construct() {
        parent::__construct();
        $this->setNameSpace($this->nameSpace);
    }
}

?>