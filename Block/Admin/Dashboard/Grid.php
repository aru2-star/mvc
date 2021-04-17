<?php
namespace Block\Admin\Dashboard;

class Grid extends \Block\Core\Template{
    public function __construct()
    {
        $this->setTemplate('./View/admin/dashboard/grid.php');
    }
}