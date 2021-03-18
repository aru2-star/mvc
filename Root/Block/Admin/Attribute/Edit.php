<?php


Mage::loadFileByClassName(
'Block_Core_Template');
class Block_Admin_Attribute_Edit extends Block_Core_Template {

	protected $attribute = [];

	public function __construct() {
		 $this->templateName  = './View/admin/attribute/edit.php';
	}

	public function setAttribute($attribute = NULL) {
		if(!$attribute){
			$attribute = Mage::getModel('Model_Attribute');
			if ($id = $this->getRequest()->getGet('attributeId')) {
				$attribute = $attribute->load($id);
			}
		}
		$this->attribute = $attribute;
		return $this;
	}

	public function getAttribute() {
		if (!$this->attribute) {
			$this->setAttribute();
		}
		return $this->attribute;
	}
}

?>
