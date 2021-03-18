<?php
Mage::loadFileByClassName('block_core_template');


class Block_Shipment_Edit extends Block_Core_Template
{
    protected $shipment = null;
    protected $templateName = null;


    public function __construct()
    {
        $this->templateName  = './View/shipment/form.php';
    }


    public function setShipment($shipment = null)
    {
        if ($shipment) {
            $this->shipment = $shipment;
        }

        $shipment = Mage::getModel('model_shipment');

        if ($id = (int) $this->getRequest()->getGet('id')) {
            $shipment = $shipment->load($id);
        }

        $this->shipment = $shipment;
        return $this;
    }

    public function getShipment()
    {
        if (!$this->shipment) {
            $this->setShipment();
        }

        return $this->shipment;
    }
}
