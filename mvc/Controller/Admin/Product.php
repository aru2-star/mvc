<?php
namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');
\Mage::loadFileByClassName('Block\Core\Layout');

date_default_timezone_set('Asia/Kolkata');
class Product extends \Controller\Core\Admin{
    protected $products = [];

    public function gridAction (){
       
        try{
            $gridBlock = \Mage::getBlock('Block\Admin\Product\Grid');
            $gridBlock->setController($this);
            $layout = $this->getLayout();
            $content = $layout->getChild('content');
            $content->addChild($gridBlock);
            $this->toHtmlLayout();

        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }
    

    public function saveAction(){
        try{
            $product = \Mage::getModel('Model\Product');

            if(!$this->getRequest()->isPost()){
                throw new \Exception ("Invalid Request.");
            }
            if ($id = $this->getRequest()->getGet('id')) {
                $product = $product->load($id);
                if (!$product){
                    throw new \Exception ("Record not found.");
                }
                $product->updatedDate = date("Y-m-d H:i:s");

            }
            else {
                $product->createdDate = date("Y-m-d H:i:s");
            }
            $productData = $this->getRequest()->getPost('product'); 
            $product->setData($productData);
            $product->save();
            $this->getMessage()->setSuccess('Inserted Successfully.');    
        }
        catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect("grid",null,null,true);
    }
       
    public function productUpdateAction()
    {
        try{
            $layout = $this->getLayout(); 
            $content = $layout->getChild('content');
            $layout->setTemplate('./View/core/layout/three_column.php');
            $product = \Mage::getModel('Model\Product');
            if ($id = (int)$this->getRequest()->getGet('id')){   
                $product = $product->load($id);
            }
            $editBlock =  \Mage::getBlock('Block\Admin\Product\Edit')->setTableRow($product);

            $content->addChild($editBlock);
            echo $this->toHtmlLayout();

        
        }catch(\Exception $e){
            echo $e->getMessage();
        }
        
    }
    
    public function productMediaAction()
    {
        $media = \Mage::getModel("Model\Product");
        $media->setTableName('product_media');
        $id = $this->getRequest()->getGet('id');
        if($this->getRequest()->getPost('image')){
            $name = $_FILES['imagefile']['name'];
            $extension = strtolower(substr($name, strpos($name,'.')+1));
            $type = $_FILES['imagefile']['type'];
            $tmp_name = $_FILES['imagefile']['tmp_name'];
            $location = 'skin/admin/pictures/';

            if(move_uploaded_file($tmp_name,$location.$name)){
                $media->image = $location.$name;
                $media->label = $name;
                $media->productId = $id;
                $data = $media->getData();
                $query = "INSERT INTO `{$media->getTableName()}` (".implode(",", array_keys($data)) . ") VALUES ('" . implode("','", array_values($data)) . "')"; 
                $media->save($query);
                header("location:".$this->getUrl('productUpdate'));
            }
        }
        
        if($this->getRequest()->getPost('remove')){
            $ids = $this->getRequest()->getPost('delete');

            if($ids){ 
                $media->setPrimaryKey('mediaId');              
                foreach ($ids as $key => $value) {
                    $media->load($key);
                    $id = $media->mediaId;
                    
                    if (unlink($media->image)) {
                        $query = "Delete FROM `product_media` WHERE `mediaId` = $id";
                        $media->delete($query);
                    }
                }
            }
            header("location:".$this->getUrl('productUpdate'));          
        }

        if($this->getRequest()->getPost('update')){
            $data = $this->getRequest()->getPost();
            $radio['small'] = $data['small'];
            $radio['thumb'] = $data['thumb'];
            $radio['base'] = $data['base'];
            foreach($data['label'] as $key=>$value){
                $query = "UPDATE `{$media->getTableName()}` SET `label` = '{$data['label'][$key]}',";
                foreach($radio as $key2=>$value2){
                    if($value2 == $key){
                        $query .= "`{$key2}` = 1,";
                    }else{
                        $query .= "`{$key2}` = 0,";
                    }
                }

                $query .= "`gallery` = ";
                if(array_key_exists('gallery',$data) && array_key_exists($key,$data['gallery'])){
                    $query .= "1";
                }else{
                    $query .= "0";
                }
                $query .= " WHERE `mediaId` = {$key}";
                $media->save($query);
            }
            $this->redirect('grid','Admin\Product');
        }
    }

    public function productCategoryAction()
        {
            if($productId = $this->getRequest()->getGet('productId'))
            {
                
                $postData = $this->getRequest()->getPost('productCategory');
                
                foreach ($postData as $id) {
                    $productCategoryModel = \Mage::getModel('Model\Product\Category');
                    $productCategoryModel->categoryId = $id;
                    $productCategoryModel->productId = $productId;
                    $productCategoryModel->save();  
                }   
            }

            $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
                $response = [
                    'status' => 'success',
                    'message' => 'grid',
                    'element' => [
                        [
                            'selector' => '#moduleGrid',
                            'html' => $grid
                        ]
                    ]
                ];
                header("Content-type: application/json");
                echo json_encode($response);

            
        }
    
    public function productDeleteAction()
    {
        try{
            $id = $this->getRequest()->getGet('id');
            if(!$id){
                throw new \Exception("Invalid ID.");    
            }
            $product = \Mage::getModel('Model\Product');
            $product->load($id);
            if($product->delete()) {
                $this->getMessage()->setSuccess('Deleted Successfully.');
            }
            else {
                $this->getMessage()->setFailure('Unable to Delete Record.');
            }
        }
        catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }  
        $this->redirect("grid",null,null,true);
    }

    public function filterAction()
    {
        $filters = $this->getRequest()->getPost('filter');
        $filterModel = \Mage::getModel('Model\Admin\Filter');
        $filterModel->setFilters($filters);
        $this->redirect('grid');
    } 
    
}
?>