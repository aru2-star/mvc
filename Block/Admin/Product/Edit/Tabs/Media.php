<?php
namespace Block\Admin\Product\Edit\Tabs;
\Mage::getBlock("Block\Core\Edit");

class Media extends \Block\Core\Edit
{
    protected $media = null;
    function __construct()
    {   
       $this->setTemplate('./View/admin/product/edit/tabs/media.php'); 
    }

    public function setMedia($media = null){
        if($media){
           $this->media = $media;
           return $this; 
        }
        $product = \Mage::getModel('Model\Product');
        if($id = $this->getRequest()->getGet('id')){
            $query = "SELECT * FROM `product_media` WHERE `productId`={$id}";
            $array = $product->fetchAll($query);
            if($array)
            {
                $this->media=$array->getData();
            }
        }
        return $this;
    }

    public function getMedia(){
        if (!$this->media){
            $this->setMedia();
        }
        return $this->media;
    }
}

?>