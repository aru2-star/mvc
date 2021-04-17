<?php
namespace Controller\Admin\Product;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Attribute extends \Controller\Core\Admin
{
    public function gridAction()
    {
        try {
            $productId = (int) $this->getRequest()->getGet('id');

            $product = \Mage::getModel('Model\Product');
            $product->load($productId);
            if ($productId) {
                if(!$product->getData()){
                    throw new \Exception("Record Not Found.");
                }
            }
            $grid = \Mage::getBlock('Block\Admin\Product\Edit')->setTableRow($product);
            $this->toHtmlLayout();
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function saveAction()
    {
        try {
            if(!$this->getRequest()->isPost()){
                throw new \Exception("Invalid Request.");
            }

            $productId = (int) $this->getRequest()->getGet('id');
            if (!$productId) {
                throw new \Exception("Id Invalid.");
            }
            
            $product = \Mage::getModel('Model\Product');
            $product->load($productId);
            if(!$product->getData()){
                throw new \Exception("Record Not Found!");
            }

            $productData = $this->getRequest()->getPost('product');
            
            foreach ($productData as $key => $value) {
                if (gettype($value) != 'array') {
                    $product->$key = $value;
                }
                else{
                    $value = implode(',', $value);
                    $product->$key = $value;
                }
            }
            if(!$product->save()){
                throw new \Exception("Invalid.");
            }
            $this->getMessage()->setSuccess('Successfull.');
        }
        catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->gridAction();
    }
}