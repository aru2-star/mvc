<?php
namespace Block\Admin\Customer\Edit\Tabs;

class Address extends \Block\Core\Template 
{
    protected $billingAddress = null;
    protected $shippingAddress = null;
    public function __construct()
    {
		parent::__construct();
		$this->setTemplate('./View/admin/customer/edit/tabs/address.php');
    }


    public function setTableRow(\Model\Customer $tableRow)
	{
		$this->tableRow = $tableRow;
		return $this;
	}
	public function getTableRow()
	{
		return $this->tableRow;
	}

    public function setBillingAddress($billingAddress = null)
	{
		if (!$billingAddress) {

			$billingAddress = \Mage::getModel('Model\Customer\Address');
			if ($id= $this->getTableRow()->customerId) {

				$query = "SELECT * FROM `{$billingAddress->getTableName()}` WHERE `address_type` = '1' AND `customerId` = {$id}";
				$billingAddress = $billingAddress->fetchRow($query);
				if (!$billingAddress) {
					$billingAddress = \Mage::getModel('Model\Customer\Address');
				}
			}
		}
		
		$this->billingAddress = $billingAddress;
		return $this;
	}

	public function getBillingAddress() {
		if (!$this->billingAddress) {
			$this->setBillingAddress();
		}
		return $this->billingAddress;
	}

	

    public function setShippingAddress($shippingAddress = null)
	{
		if (!$shippingAddress) {
			$shippingAddress = \Mage::getModel('Model\Customer\Address');
			if ($id= $this->getTableRow()->customerId) {

				$query = "SELECT * FROM `customer_address` WHERE `address_type` = '2' AND `customerId` = {$id}";
				$shippingAddress = $shippingAddress->fetchRow($query);
				if (!$shippingAddress) {
					$shippingAddress = \Mage::getModel('Model\Customer\Address');
				}
			}
		}
		
		$this->shippingAddress = $shippingAddress;
		return $this;
	}

	public function getShippingAddress() {
		if (!$this->shippingAddress) {
			$this->setShippingAddress();
		}
		return $this->shippingAddress;
	}

	
	public function getTitle()
	{
		return '<h4 class="text-muted text-weight-bold">Add/Update Address</h4>
		';
	}
	public function getFormUrl()
	{
		return $this->getUrl()->getUrl('save');
	}

}


?>