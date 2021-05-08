<?php
namespace Block\Admin\Category\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');
class Media extends \Block\Core\Template
{
	protected $tableRow = null;
	protected $media = null;
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/category/edit/tabs/media.php');
    }

    public function setTableRow(\Model\Category $tableRow){
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

    public function getStatusOptions() {
        return  [
            self::STATUS_ACTIVE =>"Yes",
            self::STATUS_INACTIVE =>"No"
        ];
    }
}
?>