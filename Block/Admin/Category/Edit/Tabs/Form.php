<?php
namespace Block\Admin\Category\Edit\Tabs;
\Mage::getBlock("Block\Core\Edit");

class Form extends \Block\Core\Edit
{
    protected $categoryOptions=[];
    protected $categoryPath = [];

    public function __construct()
    {   
        parent::__construct();
       $this->setTemplate('./View/admin/category/edit/tabs/form.php'); 
    }

    public function getCategoryOptions()
    {
        if(!$this->categoryOptions)
        {
           $query="SELECT `categoryId`,`name` FROM `{$this->getTableRow()->getTableName()}`;";
           $options=$this->getTableRow()->getAdapter()->fetchPairs($query); 

           $pathId = " ";
           if($this->getTableRow()->pathId) {
               $pathId = $this->getTableRow()->pathId.'=%';
           }
            $query="SELECT `categoryId`,`pathId` FROM `{$this->getTableRow()->getTableName()}`;";
            
            $this->categoryOptions=$this->getTableRow()->getAdapter()->fetchPairs($query); 

            if (!$this->categoryOptions) {
                $this->categoryOptions = [];
            }

            if ($this->categoryOptions) {
               foreach ($this->categoryOptions as $categoryId => &$pathId) {
                   $pathIds = explode("=", $pathId);
                   foreach ($pathIds as $key => &$id) {
                       if(array_key_exists($id, $options)){
                            $pathIds[$key] = $options[$id];
                       }
                   }
                   $this->categoryOptions[$categoryId] = implode("/",$pathIds);
               }
            }
            $this->categoryOptions=["0"=>"Root Category"] + $this->categoryOptions;
        }
        return $this->categoryOptions;

    }

    public function getName()
    {
        $categoryOptions = $this->getCategoryOptions();
    }

}

?>