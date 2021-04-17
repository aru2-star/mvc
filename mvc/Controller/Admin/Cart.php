<?php
namespace Controller\Admin;
date_default_timezone_set("Asia/Calcutta");

class Cart extends \Controller\Core\Admin
{
    public function addToCartAction()
    {

        try {
            $productId = $this->getRequest()->getGet('id');
            $product = \Mage::getModel('Model\Product')->load($productId);
            if(!$product){
                throw new \Exception("Product not found.");    
            }
            $cart = $this->getCart();
            if($cart){
                $cart->addItemToCart($product,1,true);
                $this->getMessage()->setSuccess('Item added into cart successfully.');
            }

        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('index');    
    }

    protected function getCart($customerId = null)
    {
        $cart = \Mage::getModel('Model\Cart');
        $session = \Mage::getModel('Model\Admin\Session');
        if($customerId){
            $session->customerId = $customerId;
        }
        $query = "SELECT * FROM `{$cart->getTableName()}` WHERE customerId = '{$session->customerId}' ";
        $cart = $cart->fetchRow($query);

        if($cart){
            return $cart; 
        }
        $cart = \Mage::getModel('Model\Cart');
        $cart->customerId = $session->customerId;
        $cart->createdDate = date("Y-m-d H:i:s");
        $cart->save();
        return $cart;

    }

    public function indexAction()
    {
        $grid = \Mage::getBlock('Block\Admin\Cart\Grid');
        $layout = $this->getLayout();
        $content = $layout->getChild('content')->addChild($grid);
        $cart = $this->getCart();
        $grid->setCart($cart);
        $this->toHtmlLayout();
    }

    public function updateAction()
    {
        try {
            $quantities = $this->getRequest()->getPost('quantity');
            $cart = $this->getCart();
        
            foreach ($quantities as $cartItemId => $quantity) {
                $cartItem = \Mage::getModel('Model\Cart\Item')->load($cartItemId);
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
            $this->getMessage()->setSuccess('Items are now updated');
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('index');
    }

    public function deleteAction()
    {
        try {
            $id = $this->getRequest()->getGet('id');
                if(!$id){
                    throw new \Exception("Invail Id");    
                }
                $cartItem = \Mage::getModel('Model\Cart\Item');
                $cartItem->load($id);
                if($cartItem->delete()){
                    $this->getMessage()->setSuccess("Deleted Successsfully");
                }
                else{
                $this->getMessage()->setFailure("Unable to delete record.");
                }

        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('index');
    }

    public function selectCustomerAction()
    {
        $customerId = $this->getRequest()->getPost('customer');
        $cart = $this->getCart($customerId);

        $this->redirect('index','Admin\Cart',null,true);
    }

    public function billingSaveAction()
    {
        $billing = $this->getRequest()->getPost('billing');
        $cartAddress = \Mage::getModel('Model\cart\Address');
        if ($this->getCart()->getBillingAddress()) {
            $id = $this->getCart()->getBillingAddress()->cartAddressId;
            $cartAddress->load($id);
        }
        $cartAddress->setData($billing);
        $cartAddress->addressType = 'billing';
        $cartAddress->cartId = $this->getCart()->cartId;
        echo "<pre>";
        $cartAddress->save();
        if ($this->getRequest()->getPost('bookAddressBilling')) {
            $customerBillingAddress = $this->getCart()->getBillingAddress();
            if ($customerBillingAddress) {
                $customerBillingAddress->setData($billing);
            } else {
                $customerBillingAddress = \Mage::getModel('Model\Customer\Address');
                $customerBillingAddress->setData($billing);
                $customerBillingAddress->customerId = $this->getCart()->getCustomer()->customerId;
                $customerBillingAddress->addressType = 'billing';
            }
            $customerBillingAddress->save();
        }
        $this->getMessage()->setSuccess('Address Saved');
        $this->redirect('index','Admin\Cart',null,true);
    }

    public function shippingSaveAction()
    {
        $flage = $this->getRequest()->getPost('sameAsBilling');
        if ($flage) {
            $billing = $this->getRequest()->getPost('billing');
            $cartAddress = \Mage::getModel('Model\cart\Address');
            if ($this->getCart()->getShippingAddress()) {
                $id = $this->getCart()->getShippingAddress()->cartAddressId;
                $cartAddress->load($id);
            }
            $cartAddress->setData($billing);
            $cartAddress->addressType = 'shipping';
            $cartAddress->cartId = $this->getCart()->cartId;
            $cartAddress->save();
            if ($this->getRequest()->getPost('bookAddressShipping')) {
                $customerShippingAddress = $this->getCart()->getShippingAddress();
                if ($customerShippingAddress) {
                    $customerShippingAddress->setData($billing);
                    $customerShippingAddress->save();
                } else {
                    $customerShippingAddress = \Mage::getModel('Model\Customer\Address');
                    $customerShippingAddress->setData($billing);
                    $customerShippingAddress->customerId = $this->getCart()->getCustomer()->customerId;
                    $customerShippingAddress->addressType = 'shipping';
                    $customerShippingAddress->save();
                }
            }
        } else {
            $shipping = $this->getRequest()->getPost('shipping');
            $cartAddress = \Mage::getModel('Model\cart\Address');
            if ($this->getCart()->getShippingAddress()) {
                $id = $this->getCart()->getShippingAddress()->cartAddressId;
                $cartAddress->load($id);
            }
            $cartAddress->setData($shipping);
            $cartAddress->addressType = 'shipping';
            $cartAddress->cartId = $this->getCart()->cartId;
            $cartAddress->save();

            if ($this->getRequest()->getPost('bookAddressShipping')) {
                $customerShippingAddress = $this->getCart()->getShippingAddress();
                if ($customerShippingAddress) {
                    $customerShippingAddress->setData($shipping);
                    $customerShippingAddress->save();
                } else {
                    $customerShippingAddress = \Mage::getModel('Model\Customer\Address');
                    $customerShippingAddress->setData($shipping);
                    $customerShippingAddress->customerId = $this->getCart()->getCustomer()->customerId;
                    $customerShippingAddress->addressType = 'shipping';
                    $customerShippingAddress->save();
                }
            }
        }
        $this->getMessage()->setSuccess('Address Saved');
        $this->redirect('index','Admin\Cart',null,true);
    }

    public function savePaymentAction()
    {
        $paymentId = $this->getRequest()->getPost('paymentId');
        $cart = $this->getCart();
        $payment = \Mage::getModel("Model\Payment")->load($paymentId);
        $cart->paymentId = $payment->paymentId;
        $cart->save();
        $this->redirect('index','Admin\Cart',null,true);   
    }

    public function saveShippingAction()
    {
        $shippingId = $this->getRequest()->getPost('shippingId');
        $cart = $this->getCart();
        $shipping = \Mage::getModel("Model\Shipping")->load($shippingId);
        $cart->shippingId = $shipping->shippingId;
        $cart->shippingAmount = $shipping->amount;
        $cart->save();
        $this->redirect('index','Admin\Cart',null,true);   
    }

}