<?php
namespace Block\Admin\CmsPage;
\Mage::loadFileByClassName('Block\Core\Edit');

class Edit extends \Block\Core\Edit
{

    public function __construct() {
        parent::__construct();
        $this->setTabClass(\Mage::getBlock('Block\Admin\CmsPage\Edit\Tabs'));
    } 
}

?>