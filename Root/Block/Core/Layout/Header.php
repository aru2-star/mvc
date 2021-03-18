<?php
require_once "./Block/Core/Template.php";


class Block_Core_Layout_Header extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("View/core/layout/header.php");
    }
}
?>