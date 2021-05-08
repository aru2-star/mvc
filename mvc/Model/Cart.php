<?php 
namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');

class Cart extends \Model\Core\Table{
    protected $customer = null;
    protected $items = null;
    protected $billingAddress = null;
    protected $shippingAddress = null;
    protected $paymentMethod = null;
    protected $shippingMethod = null;

    public function __construct(){
        $this->setTableName('cart');
        $this->setPrimaryKey('cartId');
    }

    public function setCustomer(\Model\Customer $customer){
        $this->customer = $customer;
        return $this;
    }

    public function getCustomer(){
        if(!$this->customerId)
        {
            return null;
        }
        $customer = \Mage::getModel('Model\Customer')->load($this->customerId);
        if (!$customer) {
            return null;
        }
        return $customer;
    }

    public function setItems(\Model\Cart\Item\Collection $items){
        $this->items = $items;
        return $this;
    }

    public function getItems(){
        if(!$this->cartId){
            return false;
        }
        $query = "SELECT * FROM cart_item WHERE cartId='{$this->cartId}'";
        $items = \Mage::getModel('Model\Cart\Item')->fetchAll($query);
        if(!$items){
            return null;
        }
        $this->setItems($items);
        return $items;
    }

        public function getBillingAddress()
    {
        $key = $this->getPrimaryKey();
        $billingAddress = \Mage::getModel('Model\Cart\Address');
        $query = "SELECT * FROM `{$billingAddress->getTableName()}` WHERE `{$key}` = '{$this->$key}' AND `address_type` = '1'";
        $billingAddress = $billingAddress->fetchRow($query);
        return $billingAddress;
    }

    public function getShippingAddress()
    {
        $key = $this->getPrimaryKey();
        $shippingAddress = \Mage::getModel('Model\Cart\Address');
        $query = "SELECT * FROM `{$shippingAddress->getTableName()}` WHERE `{$key}` = '{$this->$key}' AND `address_type` = '2'";
        $shippingAddress = $shippingAddress->fetchRow($query);
        return $shippingAddress;
    }


    public function getShippingMethod()
	{
		if(!$this->shippingMethodId)
		{
			return null;
		}
		$shipping = \Mage::getModel('Model\ShippingMethod')->load($this->shippingMethodId);
		
		if (!$shipping) {
			return null;
		}
		return $shipping;
	}

	public function getPaymentMethod()
	{
		if(!$this->paymentMethodId)
		{
			return null;
		}
		$payment = \Mage::getModel('Model\PaymentMethod')->load($this->paymentMethodId);
		if (!$payment) {
			return null;
		}
		return $payment;
	}
    
    public function addItemToCart($product,$quantity,$addMode = false){
        
        $query = "SELECT * FROM `cart_item` WHERE `cartId` = '{$this->cartId}' AND 'productId' = '{$product->productId}'";

        $cartItem = \Mage::getModel('Model\Cart\Item');
        $cartItem = $cartItem->fetchRow($query);

        if($cartItem){
            $cartItem->quantity += $quantity;
            $cartItem->save();
            return true;
        }
        
        $cartModelItem = \Mage::getModel('Model\Cart\Item');
        $cartModelItem->cartId = $this->cartId;
        $cartModelItem->productId = $product->productId;
        $cartModelItem->price = $product->price;
        $cartModelItem->quantity = $quantity;
        $cartModelItem->discount = $product->discount;
        $cartModelItem->createdAt = date("Y-m-d H:i:s");

        $cartModelItem->save();

        return true;
    }
}
?>