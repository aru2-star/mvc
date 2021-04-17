<?php
namespace Block\Admin\Payment;
\Mage::loadFileByClassName('Block\Core\Template');
\Mage::loadFileByClassName('Model\Payment');

class Grid extends \Block\Core\Template{
    protected $payments = [];

    public function __construct()
    {
       $this->setTemplate('./View/admin/payment/grid.php'); 
    }

    public function setPayments($payments =NULL) {

            if(!$payments) {
                $payments = \Mage::getModel('Model\Payment');
                $payments = $payments->fetchAll();
            }
            $this->payments = $payments;
            return $this;
    }

    public function getPayments() {
        if (!$this->payments) {
            $this->setPayments();
        }
        return $this->payments;
    }

}