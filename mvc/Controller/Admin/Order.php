<?php

namespace Controller\Admin;

class Order extends \Controller\Core\Admin
{

	public function indexAction()
	{
		$layout = \Mage::getBlock('Block\Core\Layout');
		echo $this->renderLayout();
	}

	public function gridAction()
	{
		$grid = \Mage::getBlock('Block\Admin\Order\Grid')->toHtml();
		$response = [
			'status' => 'success',
			'message' => 'order displayed',
			'element' => [
				[
					'selector' => '#moduleGrid',
					'html' => $grid
				]
			]
		];

		header('Content-type: application/json');
		echo json_encode($response);
	}

	public function viewAction()
	{
		try {

			$grid = \Mage::getBlock('Block\Admin\Order\View')->toHtml();
			$response = [
				'status' => 'success',
				'message' => 'cart displayed',
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

}

?>