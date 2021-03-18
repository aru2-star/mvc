<?php
Mage::loadFileByClassName('controller_core_admin');

class Controller_Shipment extends Controller_Core_Admin
{


    public function gridAction()
    {
        $grid = Mage::getBlock('block_shipment_grid');

        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $content->addChild($grid);

        $this->renderLayout();
    }

    public function formAction()
    {
        try {
            $edit = Mage::getBlock('block_shipment_edit');

            $layout = $this->getLayout();
            $layout->setTemplate('View/core/layout/threeColumn.php');

            $content = $layout->getChild('content');
            $content->addChild($edit);

            $this->renderLayout();
        } catch (Exception $e) {
            echo 'Message:-' . $e->getMessage();
        }
    }

    public function addAction()
    {
        date_default_timezone_set('Asia/Kolkata');
        try {
            if ($this->getRequest()->isPost()) {

                $shipment = Mage::getModel('model_shipment');
                $id = (int)$this->getRequest()->getGet('id');

                if ($id) {
                    $result = $shipment->load($id);
                    if (!$result) {
                        throw new Exception('record not found');
                    }
                } else {
                    $shipment->createdDate = date('Y-m-d H:i:s');
                }

                $shipment->setData($this->getRequest()->getPost('shipment'));


                if (!$shipment->save()) {
                    $this->getMessage()->setFailure('Unable to insert');
                } else {
                    $this->getMessage()->setSuccess('Inserted Successfully');
                }

                $this->redirect('shipment', 'grid', null, true);
                die;
            }
            throw new Exception("Invalid Request");
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect('shipment', 'grid', null, true);
        }
    }

    public function deleteAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {

                $shipmentId = (int) $this->getRequest()->getGet('id');
                $shipment = Mage::getModel('model_shipment');

                if ($shipmentId) {
                    $result = $shipment->load($shipmentId);
                }

                if (!$result) {
                    throw new Exception("Record Not Found");
                }

                if ($shipment->delete()) {
                    $this->getMessage()->setSuccess('Deleted Successfully');
                }

                $this->redirect('shipment', 'grid', null, true);
            } else {
                throw new Exception('Invalid Request');
            }
        } catch (Exception $e) {

            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect('shipment', 'grid', null, true);
        }
    }
}
