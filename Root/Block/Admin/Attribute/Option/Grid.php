<?php


Mage::loadFileByClassName('Block_Core_Template');

class Block_Admin_Attribute_Option_Grid extends Block_Core_Template {
	protected $options = [];

	public function __construct() {
		$this->templateName  = './View/admin/attribute/option/grid.php';
	}

	public function setOptions($options = null) {
		if (!$options) {
            $option = Mage::getModel('Model_Attribute_Option');
            $options = $option->fetchAll();
            
            if ($options) {
                $options = $options->getData();
            }
        }

        $this->options = $options;
        return $this;
	}

	public function getOptions() {
		if(!$this->options) {
			$this->setOptions();
		}
		return $this->options;
	}
}

?>
