<?php

namespace Block\Admin\Attribute;
\Mage::loadFileByClassName("Block\Core\Template");
class Grid extends \Block\Core\Template
{
    protected $attributes = [];
    protected $columns = [];

    public function __construct()
    {
        $this->setTemplate('View/admin/attribute/grid.php');
    }

    public function setAttribute($attributes = null)
    {
        if (!$attributes) {
            $attributes = \Mage::getModel('Model\Attribute')->fetchAll();
        }
        $this->attributes = $attributes;

        return $this;
    }
    public function getAttribute()
    {
        if (!$this->attributes) {
            $this->setAttribute();
        }
        return $this->attributes;
    }

}
