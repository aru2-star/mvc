<?php
namespace Controller\Admin;
\Mage::loadFileByClassName("Controller\Core\Admin");

class PlaceOrder extends \Controller\Core\Admin
{	
	public function indexAction()
	{
		$layout = \Mage::getBlock('Block\Core\Layout');
		echo $this->renderLayout();			
	}

	public function gridAction()
	{
		try
		{			
			$grid=\Mage::getBlock('Block\Admin\PlaceOrder\Grid')->toHtml();
			$response = [
				'status' => 'success',
				'message' => 'Displayed',
				'element' => [
					[
						'selector' => '#moduleGrid',
						'html' => $grid
					]
				]
			];		
            header("content-type: application/json");
            echo json_encode($response); 

		}
		catch(\Exception $e)
		{
			$this->getMessage()->setFailure($e->getMessage());
		}
		// 	$this->redirect('grid','admin_placeorder',null,true);
		// }

	}

	public function viewAction()
	{
		try {

			$grid = \Mage::getBlock('Block\Admin\PlaceOrder\View')->toHtml();
			$response = [
				'status' => 'success',
				'message' => 'Displayed',
				'element'=> [
					[
					'selector' => '#moduleGrid',
					'html' => $grid
					]
				]
			];

			header("Content-type:application/json");
			echo json_encode($response);
		} catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());
		}
	}
	
	public function saveAction()
	{
		try
		{

			$customerId = $this->getRequest()->getGet('id');

			$cart = $this->getCart($customerId);
			
			$placeOrder = \Mage::getModel('model\placeOrder');

			$placeOrder->customerId = $cart->customerId;
			$placeOrder->total = $cart->total;
			$placeOrder->discount = $cart->discount;
			$placeOrder->paymentId = $cart->paymentId;
			$placeOrder->shippingId = $cart->shippingId;
			$placeOrder->shippingAmount = $cart->shippingAmount;
			$placeOrder->createDate = date('Y-m-d H:i:s');

			$placeOrder = $placeOrder->save();
			/*print_r($placeOrder);die();*/
			$orderId = $placeOrder->orderId;
			//$this->getPlaceOrder($customerId);
			$items = $cart->getItems();
			foreach ($items as $item) 
			{
				
				foreach ($item as $key => $data) 
				{

					$placeOrderItem = \Mage::getModel('model\placeOrder\Item');
					$placeOrderItem->orderId = $orderId;
					$placeOrderItem->productId = $data->productId;
					$placeOrderItem->quantity = $data->quantity;
					$placeOrderItem->basePrice = $data->basePrice;
					$placeOrderItem->price = $data->price;
					$placeOrderItem->discount = $data->discount;
					$placeOrderItem->createDate = date('Y-m-d H:i:s');
					$placeOrderItem->save();
				}
				
			}

			$shippingAddress = $cart->getShippingAddress();

			$placeOrderAddress = \Mage::getModel('model\placeorder\address');
			$placeOrderAddress->orderId = $orderId;
			$placeOrderAddress->addressId = $shippingAddress->addressId;
			$placeOrderAddress->addressType = $shippingAddress->addressType;
			$placeOrderAddress->address = $shippingAddress->address;
			$placeOrderAddress->city = $shippingAddress->city;
			$placeOrderAddress->state = $shippingAddress->state;
			$placeOrderAddress->country = $shippingAddress->country;
			$placeOrderAddress->zipcode = $shippingAddress->zipcode;

			$placeOrderAddress->save();


			$query = "delete from `cart` where `cartId` =".$cart->cartId;
			$cart = \Mage::getModel('model\cart')->delete();
			$grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
			$response = [
				'status' => 'success',
				'message' => 'Displayed',
				'element' => [
					[
						'selector' => '#moduleGrid',
						'html' => $grid
					]
				]
			];
			header("Content-type: application/json");
			echo json_encode($response);

	
		}catch (\Exception $e) {
			$this->getMessage()->setFailure($e->getMessage());
		}		
	}

	protected function getCart($customerId = null)
    {
        
        $session = \Mage::getModel('model\admin\session');
        $cart = \Mage::getModel('model\cart');
        //print_r($cart);
        if($customerId)
        {
          $session->customerId = $customerId;
        }
        
        $query = "select * from `{$cart->getTableName()}` where `customerId` = '{$session->customerId}'";
        $cart = $cart->fetchRow($query);
        
        
        if($cart)
        {
          return $cart;
        }
        

    }

    protected function getPlaceOrder($customerId)
    {
        
        $session = \Mage::getModel('model\admin\session');
        $order = \Mage::getModel('model\placeorder');
        //print_r($cart);
        if($customerId)
        {
          $session->customerId = $customerId;
        }
        
        $query = "select * from `{$order->getTableName()}` where `customerId` = '{$session->customerId}'";
        $order = $order->fetchRow($query);
        
        
        if($order)
        {
          return $order;
        }
        

    }
	
	
	

}


?>