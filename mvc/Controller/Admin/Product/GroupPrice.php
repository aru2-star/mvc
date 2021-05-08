<?php
namespace Controller\Admin\Product;
\Mage::loadFileByClassName('Controller\Core\Admin');

class GroupPrice extends \Controller\Core\Admin
{
		public function saveAction()
		{
			$groupData = $this->getRequest()->getPost('groupPrice');
			
			$productId = $this->getRequest()->getGet('productId');

			if(array_key_exists('exist', $groupData)){
			foreach ($groupData['exist'] as $groupId => $price) {
				$query = "SELECT * FROM `product_group_price` WHERE `productId` = '{$productId}'
				AND `customerGroupId` = '{$groupId}'";

				$groupPrice = \Mage::getModel('Model\Product\Group\Price');
				$groupPrice->fetchRow($query);

				$groupPrice->price = $price;
				$groupPrice->save();	
			}
			
			}

			if(array_key_exists('new', $groupData)){
			foreach ($groupData['new'] as $groupId => $price) {
				
				$groupPrice = \Mage::getModel('Model\Product\Group\Price');
				$groupPrice->customerGroupId = $groupId;
				$groupPrice->price = $price;
				$groupPrice->productId = $productId;
				$groupPrice->save();
				
				}
			}

			$gridHtml = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
			$response = [
			'status' => 'success',
			'message' => 'you did it',
			'element' => [
				[
					'selector' => '#moduleGrid',
					'html' => $gridHtml
				],
				[
					'selector' => '#leftTabs',
					'html' => ''
				]
			]
		];

		header("Content-type: application/json; charset=utf-8");
		echo json_encode($response);
		}
}
?>