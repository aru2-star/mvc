<?php
namespace Block\Admin\PaymentMethod\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template'); 	

class Form extends \Block\Core\Template
{
	
	protected $methods = null;
	protected $tableRow = null;
	function __construct() {
		parent::__construct();
		$this->setTemplate('./View/admin/paymentmethod/edit/tabs/form.php');
	}

    /*public function setPaymentMethods($methods = null) {

		if ($methods) {
			$this->methods = $methods;
			return $this;
		}
		$methods = \Mage::getModel('Model\PaymentMethod');
		if ($id= $this->getRequest()->getGet('paymentMethodId')) {
			$methods = $methods->load($id);
			if (!$methods) {
				echo "No records found";
				$this->setTemplate('./View/admin/paymentmethod/grid.php');
				
			}
		}
		$this->methods = $methods;
		return $this;
	}

	public function getPaymentMethods() {

		if (!$this->methods) {
			$this->setPaymentMethods();
		}
		return $this->methods;
	}*/

	public function setTableRow(\Model\PaymentMethod $tableRow)
	{
		$this->tableRow = $tableRow;
		return $this;
	}
	public function getTableRow()
	{
		return $this->tableRow;
	}
}
?>