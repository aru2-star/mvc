<?php
namespace Controller\Admin\Attribute;
\Mage::loadFileByClassName('Controller\Core\Admin');

class Option extends \Controller\Core\Admin
{
	
	public function saveAction()
	{
		
		$optionData = $this->getRequest()->getPost();
		
		if(array_key_exists('exist', $optionData)){
			foreach ($optionData['exist'] as $optionId => $name) {
				$optionModel = \Mage::getModel('Model\Attribute\Option');
				$optionModel->load($optionId);	
				$optionModel->name = $name['name'];
				$optionModel->sortOrder = $name['sortOrder'];
				$optionModel->save();
			}
		}

		if(array_key_exists('new', $optionData)){
			foreach ($optionData['new']['name'] as $key => $value) {
				
				$optionModel = \Mage::getModel('Model\Attribute\Option');
				$optionModel->attributeId = $this->getRequest()->getGet('attributeId');	
				$optionModel->name = $value;
				$optionModel->sortOrder = $optionData['new']['sortOrder'][$key];
				$optionModel->save();
			}
		}
		$attribute = \Mage::getModel('Model\Attribute');
			if($id = $this->getRequest()->getGet('attributeId')){
				$attribute = $attribute->load($id);
				if (!$attribute) {
					throw new \Exception("No Data Found");
				}
			}
			$edit = \Mage::getBlock('Block\Admin\Attribute\Edit')->setTableRow($attribute)->toHtml();

			$response = [
			'status' => 'success',
			'message' => 'Displayed',
			'element' => [
				[
					'selector' => '#moduleGrid',
					'html' => $edit
				]
			]
		];

		header("Content-type: application/json; charset=utf-8");
		echo json_encode($response);
	}

	public function deleteAction()
	{
		try{
			$id = (int)$this->getRequest()->getGet('optionId');
			if (!$id) {
				$this->getMessage()->setFailure('Id Not Found');
			}
			$option = \Mage::getModel('Model\Attribute\Option');
			$option->load($id);
			if (!$option->delete()) {
					$this->getMessage()->setFailure('Id Invalid');
			}
		}
		catch (Exception $e){
			$this->getMessage()->setFailure($e->getMessage());
		}

		$attribute = \Mage::getModel('Model\Attribute');
			if($id = $this->getRequest()->getGet('attributeId')){
				$attribute = $attribute->load($id);
				if (!$attribute) {
					throw new \Exception("No Data Found");
				}
			}
			$edit = \Mage::getBlock('Block\Admin\Attribute\Edit')->setTableRow($attribute)->toHtml();

			$response = [
			'status' => 'success',
			'message' => 'Displayed',
			'element' => [
				[
					'selector' => '#moduleGrid',
					'html' => $edit
				]
			]
		];

		header("Content-type: application/json; charset=utf-8");
		echo json_encode($response);
	}
		
}
?>