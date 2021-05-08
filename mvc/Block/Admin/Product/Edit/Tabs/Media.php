<?php

namespace Block\Admin\Product\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');

class Media extends \Block\Core\Template
{
    protected $media = [];
    protected $tableRow = null;
    
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/product/edit/tabs/media.php');
    }

    public function setTableRow(\Model\Product $tableRow){
    	$this->tableRow = $tableRow;
    	return $this;
    }

    public function getTableRow()
    {
    	return $this->tableRow;
    }

	public function setMedia($media = null) {

		if (!$media) {
			$media = \Mage::getModel('Model\Product\Media');
			if($id = $this->getTableRow()->productId){

				$query = "SELECT * FROM {$media->getTableName()} WHERE `productId` = {$id}";
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