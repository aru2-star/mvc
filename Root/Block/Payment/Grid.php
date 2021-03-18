<?php
Mage::loadFileByClassName('block_core_template');

class Block_Payment_Grid extends Block_Core_Template
{
    protected $payments = null;
    protected $templateName = null;


    public function __construct()
    {
        $this->templateName  = './View/payment/grid.php';
    }

    public function setPayments($payments = null)
    {
        if (!$payments) {
            $payments = Mage::getModel('model_payment');
            $payments = $payments->fetchAll();

            if ($payments) {
                $payments = $payments->getData();
            }
        }

        $this->payments = $payments;
        return $this;
    }

    public function getPayments()
    {
        if (!$this->payments) {
            $this->setPayments();
        }

        return $this->payments;
    }
}
