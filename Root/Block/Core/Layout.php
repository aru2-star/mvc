<?php
Mage::loadFileByClassName('block_core_template');
Mage::loadFileByClassName('block_core_layout_content');
Mage::loadFileByClassName('block_core_layout_header');
Mage::loadFileByClassName('block_core_layout_footer');
Mage::loadFileByClassName('block_core_layout_left');
Mage::loadFileByClassName('block_core_layout_right');



class Block_Core_Layout extends Block_Core_Template
{

    public function __construct()
    {
        $this->setTemplate("View/core/layout/oneColumn.php");
        $this->prepareChildren();
    }

    public function prepareChildren()
    {

        $this->addChild(new Block_Core_Layout_Header(), 'header');
        $this->addChild(new Block_Core_Layout_Content(), 'content');
        $this->addChild(new Block_Core_Layout_Footer(), 'footer');
        $this->addChild(new Block_Core_Layout_Left(), 'left');
    }
}
