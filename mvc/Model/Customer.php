<?php
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');

    class Customer extends \Model\Core\Table{

        const STATUS_ENABLED = 1;
        const  STATUS_DISABLED = 0;
        
        public function __construct() {
            
            $this->tableName = 'customer';
            $this->primaryKey = 'customerId';
        }

        public function getStatusOption(){
            return [
                self::STATUS_ENABLED => "Enabled",
                self::STATUS_DISABLED => "Disabled",
            ];
        }

        public function getCustomerBillingAddress()
        {
        $customerBillingAddress = \Mage::getModel('Model\Customer\Address');
        $query = "SELECT * FROM `customer_address` WHERE `customerId` = '{$this->customerId}' AND `addressType` = 'Billing'";
        $this->customerBillingAddress = $customerBillingAddress->fetchRow($query);
        return $this->customerBillingAddress;
        }

        public function getCustomerShippingAddress()
        {
        $customerShippingAddress = \Mage::getModel('Model\Customer\Address');
        $query = "SELECT * FROM `customer_address` WHERE `customerId` = '{$this->customerId}' AND `addressType` = 'Shipping'";
        $this->customerShippingAddress = $customerShippingAddress->fetchRow($query);
        return $this->customerShippingAddress;
        }
    }

?>