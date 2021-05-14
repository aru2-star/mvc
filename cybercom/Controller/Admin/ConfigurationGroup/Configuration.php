<?php
namespace Controller\Admin\ConfigurationGroup;

class Configuration extends \Controller\Core\Admin
{
	
	public function saveAction()
	{
		
		$configurationData = $this->getRequest()->getPost();
		
		if(array_key_exists('exist', $configurationData)){
			foreach ($configurationData['exist'] as $configId => $name) {
				$configModel = \Mage::getModel('Model\ConfigurationGroup\Configuration');
				$configModel->load($configId);	
				$configModel->title = $name['title'];
				$configModel->code = $name['code'];
				$configModel->value = $name['value'];
				$configModel->save();
			}
		}

		if(array_key_exists('new', $configurationData)){
			foreach ($configurationData['new']['title'] as $key => $value) {
				
				$optionModel = \Mage::getModel('Model\ConfigurationGroup\Configuration');
				$optionModel->groupId = $this->getRequest()->getGet('configurationGroupId');	
				$optionModel->title = $value;
				$optionModel->code = $configurationData['new']['code'][$key];
				$optionModel->value = $configurationData['new']['value'][$key];
				$optionModel->save();
			}
		}

		$configurationGroup = \Mage::getModel('Model\ConfigurationGroup');
			if($id = $this->getRequest()->getGet('configurationGroupId')){
				$configurationGroup = $configurationGroup->load($id);
				if (!$configurationGroup) {
					throw new \Exception("No Data Found");
				}
			}
			$edit = \Mage::getBlock('Block\Admin\ConfigurationGroup\Edit')->setTableRow($configurationGroup)->toHtml();

			$response = [
			'status' => 'success',
			'message' => 'you did it',
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
		$id = $this->getRequest()->getGet('configId');
		if(!$id){
			$this->getMessage()->setFailure('Id Not Found');
		}
		$configModel = \Mage::getModel('Model\ConfigurationGroup\Configuration')->load($id); 
		if(!$configModel->delete()){
			$this->getMessage()->setFailure('Id Invalid');
		}

		$configurationGroup = \Mage::getModel('Model\ConfigurationGroup');
		if($id = $this->getRequest()->getGet('configurationGroupId')){
			$configurationGroup = $configurationGroup->load($id);
			if (!$configurationGroup) {
				throw new \Exception("No Data Found");
			}
		}
		$edit = \Mage::getBlock('Block\Admin\ConfigurationGroup\Edit')->setTableRow($configurationGroup)->toHtml();

		$response = [
			'status' => 'success',
			'message' => 'you did it',
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