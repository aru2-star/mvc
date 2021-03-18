<?php
Mage::loadFileByClassName('Controller_Core_Admin');
class Controller_Customer extends Controller_Core_Admin
{

    public function gridAction()
    {
        $grid = Mage::getBlock('Block_Customer_Grid');

        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $content->addChild($grid);
        //echo $content;
        $this->renderLayout();
    }

    public function formAction()
    {
        try {
            $edit = Mage::getBlock('Block_Customer_Edit');
            $tabs = Mage::getBlock('Block_Customer_Edit_Tabs');

            $layout = $this->getLayout();
            $layout->setTemplate('View/core/layout/threeColumn.php');

            $content = $layout->getChild('content');
            $content->addChild($edit);

            $left = $layout->getChild('left');
            $left->addChild($tabs);

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

                $customer = Mage::getModel('Model_Customer');
                $id = (int)$this->getRequest()->getGet('id');

                if ($id) {
                    $result = $customer->load($id);
                    if (!$result) {
                        throw new Exception('record not found');
                    }
                    $customer->updatedDate = date('Y-m-d H:i:s');
                } else {
                    $customer->createdDate = date('Y-m-d H:i:s');
                    $customer->updatedDate = date('Y-m-d H:i:s');
                }

                $customer->setData($this->getRequest()->getPost('customer'));

                if (!$customer->save()) {
                    $this->getMessage()->setFailure('Unable to insert');
                } else {
                    $this->getMessage()->setSuccess('Inserted Successfully');
                }

                $this->redirect('customer', 'grid', null, true);
                die;
            }
            throw new Exception("Invalid Request");
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect('customer', 'grid', null, true);
        }
    }

    public function deleteAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {

                $customerId = (int) $this->getRequest()->getGet('id');
                $customer = Mage::getModel('model_customer');

                if ($customerId) {
                    $result = $customer->load($customerId);
                }

                if (!$result) {
                    throw new Exception("record Not found");
                }


                if ($customer->delete()) {
                    $this->getMessage()->setSuccess('Deleted Successfully');
                }

                $this->redirect('customer', 'grid', null, true);
            } else {
                throw new Exception('Invalid Request');
            }
        } catch (Exception $e) {

            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect('customer', 'grid', null, true);
        }
    }
}
