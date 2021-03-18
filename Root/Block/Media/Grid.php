<?php
// namespace Block\Media;
// new Block\Media\Grid();

Mage::loadFileByClassName('Block_Core_Template');

class Grid extends Block_Core_Template
{
    
    public function __construct()
    {
        $this->templateName  = './View/media/grid.php';
    }
}
?>
