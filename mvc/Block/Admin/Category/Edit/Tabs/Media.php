<?php
namespace Block\Admin\Category\Edit\Tabs;
\Mage::getBlock("Block\Core\Edit");

class Media extends \Block\Core\Edit
{
    protected $tableRow = null;
	protected $media = null;

    public function __construct()
    {   
       $this->setTemplate('./View/admin/category/edit/tabs/media.php'); 
    }

    public function setTableRow(\Model\Core\Table $tableRow = null){
        $this->tableRow = $tableRow;
        return $this;
    }

    public function getTableRow()
    {
        return $this->tableRow;
    }

    public function setMedia($media = null) {

        if (!$media) {
            $media = \Mage::getModel('Model\Category\Media');
            if($id = $this->getTableRow()->categoryId){

                $query = "SELECT * FROM {$media->getTableName()} WHERE `categoryId` = {$id}";
                $media = $media->fetchAll($query);
            }
            
        }
        $this->media = $media;
        return $this;
    }

    public function getMedia() {

        if (!$this->media) {
            $this->setMedia();
        }
        return $this->media;
    }
}

?>