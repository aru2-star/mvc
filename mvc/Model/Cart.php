<?php
namespace Model;

class Cart extends \Model\Core\Table 
{
    protected $customer = null;
    protected $items = null;
    protected $billingAddress = null;
    protected $shippingAddress = null;
    protected $shipping = null;
    protected $payment = null;

    public function __construct()
    {
        $this->setTableName('cart');
        $this->setPrimaryKey('cartId');
    }

    public function setCustomer(\Model\Customer $customer)
    {
        $this->customer = $customer;
        return $this;
    }

    public function getCustomer()
    {
        if($this->customer) {
            return $this->customer;
        }

        if(!$this->customerId) {
            return false;
        }
        $customer = \Mage::getModel('Model\Customer')->load($this->customerId);
        if(!$customer){
            return false;
        }
        $this->setCustomer($customer);
        return $this->customer;
    }

    public function setItems(\Model\Cart\Item\Collection $items)
    {
        $this->items = $items;
        return $this;
    }

    public function getItems()
    {        
        if(!$this->cartId) {
            return false;
        }

        $query = "SELECT * FROM `cart_item` WHERE cartId = '{$this->cartId}';";
        $items = \Mage::getModel('Model\Cart\Item')->fetchAll($query);
        if(!$items){
            return false;
        }
        $this->setItems($items);
        return $items;
    }

     public function setShippingAddress(\Model\Cart\Address $shippingAddress)
    {
        $this->shippingAddress = $shippingAddress;
        return $this;
    }

    public function getShippingAddress()
    {
        if(!$this->cartId){
            return false;
        }
        $address = \Model\Cart\Address::ADDRESS_TYPE_SHIPPING;
        $query = "SELECT * FROM `cart_address` WHERE cartId = '{$this->cartId}' AND addressType = '{$address}';";
        $shippingAddress = \Mage::getModel('Model\Cart\Address')->fetchRow($query);
        if(!$shippingAddress){
            return false;
        }
        $this->setShippingAddress($shippingAddress);
        return $this->shippingAddress;
    }

    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }

    public function getBillingAddress()
    {
        if(!$this->cartId){
            return false;
        }
        $address = \Model\Cart\Address::ADDRESS_TYPE_BILLING;
        $query = "SELECT * FROM `cart_address` WHERE cartId = '{$this->cartId}' AND addressType = '{$address}';";
        $billingAddress = \Mage::getModel('Model\Cart\Address')->fetchRow($query);
        if(!$billingAddress){
            return false;
        }
        $this->setBillingAddress($billingAddress);
        return $this->billingAddress;
    }

    public function setShipping(\Model\Shipping $shipping)
    {
        $this->shipping = $shipping;
        return $this;
    }

    public function getShipping()
    {
        if (!$this->cartId) {
            return false;
        }
        $query = "SELECT * FROM `shipping` WHERE `shippingId` = '{$this->shippingId}'";
        $shipping = \Mage::getModel('Model\Shipping')->fetchRow($query);
        $this->setShipping($shipping);
        return $this->shipping; 
    }

    public function setPayment(\Model\Payment $payment)
    {
        $this->payment = $payment;
        return $this;
    }

    public function getPayment()
    {
        if (!$this->cartId) {
            return false;
        }
        $query = "SELECT * FROM `payment` WHERE `paymentId` = '{$this->paymentId}'";
        $payment = \Mage::getModel('Model\Payment')->fetchRow($query);
        $this->setPayment($payment);
        return $this->payment; 
    }

    public function addItemToCart($product,$quantity = 1,$addMode = false)
    {
        $query = "SELECT * FROM `cart_item` WHERE `cartId` = '{$this->cartId}' AND `productId` = '{$product->productId}' ";
        $cartItem = \Mage::getModel('Model\Cart\Item');
        $cartItem = $cartItem->fetchRow($query);
        if($cartItem){
            $cartItem->quantity += $quantity;
            $cartItem->save();
            return true;
        }
        $cartItem = \Mage::getModel('Model\Cart\Item');
        $cartItem->cartId = $this->cartId;
        $cartItem->productId = $product->productId;
        $cartItem->price = $product->price;
        $cartItem->quantity = $quantity;
        $cartItem->discount = $product->discount;
        $cartItem->createdDate = date("Y-m-d H:i:s");

        $cartItem->save();
        return true;

    }   
}
?>