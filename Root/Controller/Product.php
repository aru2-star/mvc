<?php

Mage::loadFileByClassName('Controller_Core_Admin');
class Controller_Product extends Controller_Core_Admin
{


    public function gridAction()
    {

        $grid = Mage::getBlock('Block_Product_Grid');

        $layout  = $this->getLayout();

        $content = $layout->getChild('content');
        $content->addChild($grid);

        $this->renderLayout();
    }

    public function formAction()
    {
        try {

            $edit = Mage::getBlock('Block_product_edit');
            $tabs = Mage::getBlock('Block_Product_Edit_Tabs');

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

                $product = Mage::getModel('Model_Product');
                $id = (int)$this->getRequest()->getGet('id');
                if ($id) {

                    $result = $product->load($id);
                    if (!$result) {
                        throw new Exception("Record Not Found.");
                    }

                    $product->updatedDate = date('Y-m-d H:i:s');
                } else {

                    $product->createdDate = date('Y-m-d H:i:s');
                    $product->updatedDate = date('Y-m-d H:i:s');
                }

                $product->setData($this->getRequest()->getPost('product'));


                if (!$product->save()) {
                    $this->getMessage()->setFailure('Insertion Failed.');
                } else {
                    $this->getMessage()->setSuccess('Inserted Successfully.');
                }

                $this->redirect('product', 'grid', null, true);
                die;
            }
            throw new Exception("Invalid Request.");
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect('product', 'grid', null, true);
        }
    }

    public function deleteAction()
    {

        try {
            if (!$this->getRequest()->isPost()) {

                $productId = (int) $this->getRequest()->getGet('id');
                $product = Mage::getModel('model_product');

                if ($productId) {
                    $result = $product->load($productId);
                }

                if (!$result) {
                    throw new Exception("Record Not Found");
                }

                if ($product->delete()) {
                    $this->getMessage()->setSuccess('Deleted Successfully');
                }

                $this->redirect('product', 'grid', null, true);
            } else {
                throw new Exception('Invalid Request');
            }
        } catch (Exception $e) {

            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect('product', 'grid', null, true);
        }
    }
}
