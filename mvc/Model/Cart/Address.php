<?php
namespace Model\Cart;
 
class Address extends \Model\Core\Table 
{
    const ADDRESS_TYPE_BILLING = 'billing';
    const ADDRESS_TYPE_SHIPPING = 'shipping';

    protected $cart = null;
    protected $customerBillingAddress = null;
    protected $customerShippingAddress = null;

    public function __construct()
    {
        $this->setTableName('cart_address');
        $this->setPrimaryKey('cartAddressId');
    }

    public function setCart(\Model\Cart $cart)
    {
        $this->cart = $cart;
        return $this;
    }

    public function getCart()
    {
        if(!$this->cartId) {
            return false;
        }
        $cart = \Mage::getModel('Model\Cart')->load($this->cartId);
        $this->setCart($cart);
        return $this->cart;
    }

    public function setCustomerBillingAddress(\Model\Customer\Address $customerBillingAddress)
    {
        $this->customerBillingAddress = $customerBillingAddress;
        return $this;
    }

    public function getCustomerBillingAddress()
    {
        if (!$this->addressId) {
            return false;
        }
        //$query = "SELECT * FROM `customer_address` WHERE `addressId` = '{$this->addressId}' AND 'addressType' = '{\Model\Customer\Address::ADDRESS_TYPE_BILLING}'";
        $customerBillingAddress = \Mage::getModel('Model\Customer\Address')->load($this->addressId);
        $this->setCustomerBillingAddress($customerBillingAddress);
        return $this->customerBillingAddress;
    }

    public function setCustomerShippingAddress(\Model\Customer\Address $customerShippingAddress)
    {
        $this->customerShippingAddress = $customerShippingAddress;
        return $this;
    }

    public function getCustomerShippingAddress()
    {
        if (!$this->addressId) {
            return false;
        }
       // $query = "SELECT * FROM `customer_address` WHERE `addressId` = '{$this->addressId}' AND 'addressType' = '{\Model\Customer\Address::ADDRESS_TYPE_SHIPPING}'";
        $customerShippingAddress = \Mage::getModel('Model\Customer\Address')->load($this->addressId);
        $this->setCustomerShippingAddress($customerShippingAddress);
        return $this->customerShippingAddress;
    }

}
