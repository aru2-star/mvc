<?php
namespace Block\Admin\Payment\Edit\Tabs;
\Mage::getBlock("Block\Core\Edit");

class Form extends \Block\Core\Edit
{
    protected $payment = NULL;
    public function __construct()
    {   
        parent::__construct();
       $this->setTemplate('./View/admin/payment/edit/tabs/form.php'); 
    }
    
}

?>