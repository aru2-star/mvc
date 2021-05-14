<?php
namespace Controller\Admin;

class Cart extends \Controller\Core\Admin
{
	
    public function indexAction()
    {
            $gridHtml = \Mage::getBlock('Block\Admin\Cart\Grid');
            $cart = $this->getCart();
            $gridHtml->setCart($cart);
            $gridHtml = $gridHtml->toHtml();
            $response = [
                'status' => 'success',
                'message' => 'Displayed',
                'element' => [
                    [
                        'selector' => '#moduleGrid',
                        'html' => $gridHtml
                    ]
                ]
            ];
            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);    
    }

	public function addToCartAction()
	{
		try{
            
			$productId = $this->getRequest()->getGet('productId');

			$product = \Mage::getModel('Model\Product')->load($productId);
			if(!$product){
				$this->getMessage()->setFailure('Invalid Id');
			}

			$cart = $this->getCart();
			$cartItem = \Mage::getModel('Model\Cart\Item');
            $cartId = $cart->cartId;
            $query = "SELECT * FROM `{$cartItem->getTableName()}` WHERE `productId` = '{$productId}' AND `cartId` = '{$cartId}'";
            
            $cartItem = $cartItem->fetchRow($query);

            if (!$cartItem) {
                $cartItem = \Mage::getModel('Model\Cart\Item');
                $cartItem->cartId = $cartId;
                $cartItem->productId = $product->productId;
                $cartItem->basePrice = $product->price;
                $cartItem->price = $product->price;
                $cartItem->quantity = 1;
                $cartItem->discount = $product->discount;
                $cartItem->createdAt = date("Y-m-d H:i:s");
            
            } else {
            
                $cartItem->quantity = $cartItem->quantity + 1;
                $price = $cartItem->price * $cartItem->quantity;
                $cartItem->price = $price;
            }
            
            $cartItem->save();
            $this->updateCartTotal();
			$this->getMessage()->setSuccess('Item added to cart');

            $gridHtml = \Mage::getBlock('Block\Admin\Cart\Grid');
            $cart = $this->getCart();
            $gridHtml->setCart($cart);
            $gridHtml = $gridHtml->toHtml();
            $response = [
                'status' => 'success',
                'message' => 'Displayed',
                'element' => [
                    [
                        'selector' => '#moduleGrid',
                        'html' => $gridHtml
                    ]
                ]
            ];
            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response); 

		}catch (Exception $e){
			$this->getMessage()->setFailure($e->getMessage());
		}
	}

   public function getCart($customerId = null)
	{
		$session = \Mage::getModel('Model\Admin\Session');
		
		if($customerId){
			$session->customerId = $customerId;
		}

		$cart = \Mage::getModel('Model\Cart');
		$query = "SELECT * FROM `{$cart->getTableName()}` WHERE `customerId` = '{$session->customerId}'";

		$cart = $cart->fetchRow($query);

		if($cart){
			return $cart;
		}
        if($session->customerId){
    		$cart = \Mage::getModel('Model\Cart');
    		$cart->customerId = $session->customerId;
    		$cart->createdAt = date('Y-m-d H:i:s');
    		$cart->save();
    		return $cart;
        }

		return \Mage::getModel('Model\Cart');
	}


    public function updateAction(){

        try{

            $quantities = $this->getRequest()->getPost('quantity');

            $cart = $this->getCart();

            foreach($quantities as $cartItemId => $quantity){
                $cartItem = \Mage::getModel('Model\Cart\Item')->load($cartItemId);
                $cartItem->quantity = $quantity;
                $cartItem->save();
                $this->updateCartTotal();
            }

            $price = $this->getRequest()->getPost('price');
            foreach ($price as $itemId => $price) {
                $cartItem = \Mage::getModel('Model\Cart\Item');
                $cartItem = $cartItem->load($itemId);
                $cartItem->price = $price;
                $cartItem->save();
                $this->updateCartTotal();
            }

            $this->getMessage()->setSuccess('Items updated');

        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }

        $gridHtml = \Mage::getBlock('Block\Admin\Cart\Grid');
        $cart = $this->getCart();
        $gridHtml->setCart($cart);
        $gridHtml = $gridHtml->toHtml();
        $response = [
            'status' => 'success',
            'message' => 'Displayed',
            'element' => [
                [
                    'selector' => '#moduleGrid',
                    'html' => $gridHtml
                ]
            ]
        ];
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);  
    }

    public function selectCustomerAction(){
        
        $customerId = $this->getRequest()->getPost('customer');
        $this->getCart($customerId);
        $gridHtml = \Mage::getBlock('Block\Admin\Cart\Grid');
        $cart = $this->getCart();
        $gridHtml->setCart($cart);
        $gridHtml = $gridHtml->toHtml();
        $response = [
            'status' => 'success',
            'message' => 'Displayed',
            'element' => [
                [
                    'selector' => '#moduleGrid',
                    'html' => $gridHtml
                ]
            ]
        ];
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);  

    }


    public function updateCartTotal()
    {
        $cartId = $this->getCart()->cartId;
        $cart = \Mage::getModel('Model\Cart')->load($cartId);
        $total = 0;

        if ($cart->getItems()->count()) {
            foreach ($cart->getItems()->getData() as $item) {
                $total = $total + $item->price;
            }   
        }

        $cart = \Mage::getModel('Model\Cart');
        $cart->total = $total;
        $cart->cartId = $cartId;
        $cart->save();
    }

    public function updateAddressAction()
    {
        $cartId = $this->getCart()->cartId;
        if ($this->getRequest()->getGet('type') == "billing") {
            $billingAddressData = $this->getRequest()->getPost('billing');
            $billingAddress = \Mage::getModel('Model\Cart')->load($cartId)->getBillingAddress();
            $billingAddress->setData($billingAddressData);
            $billingAddress->save();
            if ($this->getRequest()->getPost('billingAddressBook')) {
                $customerAddressBook = \Mage::getModel('Model\Cart')
                                    ->load($cartId,'cartId')
                                    ->getCustomer()
                                    ->getBillingAddress();
                $customerAddressBook->setData($billingAddressData);
                $customerAddressBook->save();                   
            }

        } else {
            
            if ($this->getRequest()->getPost('sameAsBilling')) {
                $shippingAddressData = $this->getRequest()->getPost('billing');
            } else {
                $shippingAddressData = $this->getRequest()->getPost('shipping');
            }
            
            $shippingAddress = \Mage::getModel('Model\Cart')->load($cartId)->getShippingAddress();
            $shippingAddress->setData($shippingAddressData);
            $shippingAddress->sameAsBilling = 1;
            $shippingAddress->save();
            if ($this->getRequest()->getPost('shippingAddressBook')) {
                $customerAddressBook = \Mage::getModel('Model\Cart')
                                    ->load($cartId,'cartId')
                                    ->getCustomer()
                                    ->getShippingAddress();
                $customerAddressBook->setData($shippingAddressData);
                $customerAddressBook->save();                   
            }
        }
        $gridHtml = \Mage::getBlock('Block\Admin\Cart\Grid');
        $cart = $this->getCart();
        $gridHtml->setCart($cart);
        $gridHtml = $gridHtml->toHtml();
        $response = [
            'status' => 'success',
            'message' => 'Displayed',
            'element' => [
                [
                    'selector' => '#moduleGrid',
                    'html' => $gridHtml
                ]
            ]
        ];
        header("Content-type: application/json");
        echo json_encode($response); 
    }

    public function deleteAction()
    {
        try {
            $itemId = $this->getRequest()->getGet('itemId');
            $cartItem = \Mage::getModel('Model\Cart\Item');
            $cartItem = $cartItem->load($itemId);
            $cartItem->delete();
            $this->updateCartTotal();
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());      
        }

        $gridHtml = \Mage::getBlock('Block\Admin\Cart\Grid');
        $cart = $this->getCart();
        $gridHtml->setCart($cart);
        $gridHtml = $gridHtml->toHtml();
        $response = [
            'status' => 'success',
            'message' => 'Displayed',
            'element' => [
                [
                    'selector' => '#moduleGrid',
                    'html' => $gridHtml
                ]
            ]
        ];
        
        header("Content-type:application/json");
        echo json_encode($response);
    }


    public function updateShippingAction()
    {
        $methodId = $this->getRequest()->getPost('shippingMethod');

        $cartId = $this->getCart()->cartId;
        $cart = \Mage::getModel('Model\Cart');
        $cartClone = clone $cart;
        $cart->cartId = $cartId;
        $cart->shippingMethodId = $methodId;
        $cart->save();
        $cartClone->cartId = $cartId;
        
        $cartClone->shippingAmount = $cart->getShippingMethod()->amount;
        $cartClone->save();
        $gridHtml = \Mage::getBlock('Block\Admin\Cart\Grid');
        $cart = $this->getCart();
        $gridHtml->setCart($cart);
        $gridHtml = $gridHtml->toHtml();
        $response = [
            'status' => 'success',
            'message' => 'Displayed',
            'element' => [
                [
                    'selector' => '#moduleGrid',
                    'html' => $gridHtml
                ]
            ]
        ];
        
        header("Content-type:application/json");
        echo json_encode($response);

       
    }

    public function updatePaymentAction()
    {
        $methodId = $this->getRequest()->getPost('paymentMethod');
        $cartId = $this->getCart()->cartId;
        $cart = \Mage::getModel('Model\Cart');
        $cart->cartId = $cartId;
        $cart->paymentMethodId = $methodId;
        $cart->save();

        $gridHtml = \Mage::getBlock('Block\Admin\Cart\Grid');
        $cart = $this->getCart();
        $gridHtml->setCart($cart);
        $gridHtml = $gridHtml->toHtml();
        $response = [
            'status' => 'success',
            'message' => 'Displayed',
            'element' => [
                [
                    'selector' => '#moduleGrid',
                    'html' => $gridHtml
                ]
            ]
        ];
        
        header("Content-type:application/json");
        echo json_encode($response);
       
    }

    public function placeOrderAction()
    {
        $id = $this->getCart()->cartId;
        $cart = \Mage::getModel('Model\Cart')->load($id);
        $order_details = \Mage::getModel('Model\PlaceOrder');

        
        $order_details->shippingMethodId = $cart->shippingMethodId;
        $order_details->customerId = $cart->customerId;
        $order_details->discount = $cart->discount;
        $order_details->shippingAmount = $cart->shippingAmount;
        $order_details->paymentMethodId = $cart->paymentMethodId;
        $order_details->total = $cart->total;
        $order_details->save();
        /*if(!$cart->delete()){
            $this->getMessage()->setFailure('Id Invalid');
        }*/
        $session = \Mage::getModel('Model\Admin\Session');
        $session->orderId = $order_details->orderId;
        $this->addOrderItems();
        $this->addOrderAddress();

        $order = \Mage::getBlock('Block\Admin\PlaceOrder\Grid')->toHtml();
        $response = [
            'status' => 'success',
            'message' => 'Displayed',
            'element'=> [   
                [
                    'selector' => '#moduleGrid',
                    'html' => $order
                ]
            ]
        ];
        header("Content-type:application/json");
        echo json_encode($response);
    }

    public function addOrderItems()
    {
        $cartId = $this->getCart()->cartId;
        $items = \Mage::getModel('Model\Cart\Item');
        
        $orderId = \Mage::getModel('Model\Admin\Session')->orderId;
        
        $query = "SELECT * FROM {$items->getTableName()} WHERE `cartId` = '{$cartId}'";
        $items = $items->fetchAll($query);
        if($items){
            foreach ($items->getData() as $key => $item) 
            {
                $order_items = \Mage::getModel('Model\PlaceOrder\Item');
                $order_items->orderId = $orderId;
                $order_items->createdAt = date("Y-m-d H:i:s");
                $order_items->price = $item->price;
                $order_items->discount = $item->discount;
                $order_items->productId = $item->productId;
                $order_items->quantity = $item->quantity;
                $order_items->save();
            }   
                
        }

        /*$items = \Mage::getModel('Model\Cart\Item');
        $query = "DELETE FROM {$items->getTableName()} WHERE `cartId` = '{$cartId}'";
        if(!$items->getAdapter()->delete($query)){
            $this->getMessage()->setFailure('Id Invalid');
        }*/
    }

    public function addOrderAddress()
    {
        $cartId = $this->getCart()->cartId;
        
        $orderId = \Mage::getModel('Model\Admin\Session')->orderId;
        $cartAddress = \Mage::getModel('Model\Cart\Address');
        $query = "SELECT * FROM {$cartAddress->getTableName()} WHERE `cartId` = '{$cartId}' AND `address_type` = '2'";
        $cartAddress = $cartAddress->fetchRow($query);
        $orderAddress = \Mage::getModel('Model\PlaceOrder\Address');
        if($cartAddress){
            $orderAddress->orderId = $orderId;
            $orderAddress->address = $cartAddress->address;
            $orderAddress->city = $cartAddress->city;
            $orderAddress->state = $cartAddress->state;
            $orderAddress->country = $cartAddress->country;
            $orderAddress->zipcode = $cartAddress->zipcode;
            $orderAddress->sameAsBilling = $cartAddress->sameAsBilling;
            $orderAddress->address_type = 2;

        }
        $orderAddress->save();
        
        $cartBillingAddress = \Mage::getModel('Model\Cart\Address');
        $query = "SELECT * FROM {$cartBillingAddress->getTableName()} WHERE `cartId` = '{$cartId}' AND `address_type` = '1'";
        $cartBillingAddress = $cartBillingAddress->fetchRow($query);
        $orderBillingAddress = \Mage::getModel('Model\PlaceOrder\Address');
        if($cartBillingAddress){
            $orderBillingAddress->orderId = $orderId;
            $orderBillingAddress->address = $cartBillingAddress->address;
            $orderBillingAddress->city = $cartBillingAddress->city;
            $orderBillingAddress->state = $cartBillingAddress->state;
            $orderBillingAddress->country = $cartBillingAddress->country;
            $orderBillingAddress->zipcode = $cartBillingAddress->zipcode;
            $orderBillingAddress->sameAsBilling = $cartBillingAddress->sameAsBilling;
            $orderBillingAddress->address_type = 1;

        }

        $orderBillingAddress->save();
        
        /*$address = \Mage::getModel('Model\Cart\Address');
        $query = "DELETE FROM {$items->getTableName()} WHERE `cartId` = '{$cartId}'";
        if(!$address->getAdapter()->delete($query)){
            $this->getMessage()->setFailure('Id Invalid');
        }*/

    }
    
}

?>