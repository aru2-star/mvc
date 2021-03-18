<?php
Mage::loadFileByClassName('Block_Bore_Template');


class Block_Payment_Edit extends Block_Core_Template
{
    protected $payment = null;
    protected $templateName = null;


    public function __construct()
    {
        $this->templateName  = './View/payment/form.php';
    }

    public function setPayment($payment = null)
    {
        if ($payment) {
            $this->payment = $payment;
        }

        $payment = Mage::getModel('Model_Payment');

        if ($id = (int) $this->getRequest()->getGet('id')) {
            $payment = $payment->load($id);
        }

        $this->payment = $payment;
        return $this;
    }

    public function getPayment()
    {
        if (!$this->payment) {
            $this->setPayment();
        }

        return $this->payment;
    }
}
