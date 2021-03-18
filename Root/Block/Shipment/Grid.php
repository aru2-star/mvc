<?php
Mage::loadFileByClassName('block_core_template');

class Block_Shipment_Grid extends Block_Core_Template
{
    protected $shipments = null;
    protected $templateName = null;


    public function __construct()
    {
        $this->templateName  = './View/shipment/grid.php';
    }

    public function setShipments($shipments = null)
    {
        if (!$shipments) {
            $shipments = Mage::getModel('model_shipment');
            $shipments = $shipments->fetchAll();

            if ($shipments) {
                $shipments = $shipments->getData();
            }
        }

        $this->shipments = $shipments;
        return $this;
    }

    public function getShipments()
    {
        if (!$this->shipments) {
            $this->setShipments();
        }

        return $this->shipments;
    }
}
