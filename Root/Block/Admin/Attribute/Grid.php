<?php

Mage::loadFileByClassName('Block_Core_Template');
class Block_Admin_Attribute_Grid extends Block_Core_Template {
	protected $attributes = [];
	protected $templateName = null;

	public function __construct() {
		$this->templateName  = './View/admin/attribute/grid.php';
	}

	public function setAttributes($attributes = null) {
		if (!$attributes) {
            $attribute = Mage::getModel('Model_Attributes');
            $attributes = $attribute->fetchAll();

            if ($attributes) {
                $attributes = $attributes->getData();
            }
        }

        $this->attributes = $attributes;
        return $this;
	}

	public function getAttributes() {
		if(!$this->attributes) {
			$this->setAttributes();
		}
		return $this->attributes;
	}
}

?>
