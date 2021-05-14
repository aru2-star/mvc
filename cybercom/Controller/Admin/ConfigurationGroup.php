<?php 
namespace Controller\Admin;

class ConfigurationGroup extends \Controller\Core\Admin
{
	
	public function indexAction()
	{
		$layout = \Mage::getBlock('Block\Core\Layout');
		echo $this->renderLayout();
	}

	public function gridAction()
	{
		$gridHtml = \Mage::getBlock('Block\Admin\ConfigurationGroup\Grid')->toHtml();

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

		header('Content-type: application/json');
		echo json_encode($response);
	}

	public function saveAction()
	{
		//insert remaining
		date_default_timezone_set('Asia/Kolkata');
		try{
			$configurationGroup = \Mage::getModel('Model\ConfigurationGroup');
			if ($id = $this->getRequest()->getGet('configurationGroupId')) {
				$configurationGroup = $configurationGroup->load($id);
				if (!$configurationGroup) {
					$this->getMessage()->setFailure('No records Found');
				}
				$this->getMessage()->setSuccess('Records Updated Successfully');
			} else {
				$this->getMessage()->setSuccess('Records Inserted Successfully');
			}

			$configurationGroupData = $this->getRequest()->getPost('configurationGroups');
			$configurationGroup->setData($configurationGroupData);
			$configurationGroup->save();

		}catch(Exception $e){
			$this->getMessage()->setFailure($e->getMessage());
		}

		$gridHtml = \Mage::getBlock('Block\Admin\ConfigurationGroup\Grid')->toHtml();

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

		header('Content-type: application/json');
		echo json_encode($response);


	}
	public function editAction()
	{
		try{
				$configurationGroup = \Mage::getModel('Model\ConfigurationGroup');
				$id = $this->getRequest()->getGet('configurationGroupId');
			if ($id) {
				$configurationGroup = $configurationGroup->load($id);
				if (!$configurationGroup) {
					throw new \Exception("No records found");
					
				}
			}
		} catch (\Exception $e){
				echo $e->getMessage();
		}
				$edit = \Mage::getBlock('Block\Admin\ConfigurationGroup\Edit')->setTableRow($configurationGroup)->toHtml();
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

		header('Content-type: application/json');
		echo json_encode($response);


	}

	public function deleteAction()
	{
		try{
			$id = $this->getRequest()->getGet('configurationGroupId');
			if(!$id){
				$this->getMessage()->setFailure('Id not found');
			}
			$group = \Mage::getModel('Model\ConfigurationGroup')->load($id);
			if(!$group->delete()){
				$this->getMessage()->setFailure('Id invalid');
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
				'message' => 'Displayed',
				'element' => [
					[
						'selector' => '#moduleGrid',
						'html' => $edit
					]
				]
			];

			header("Content-type: application/json");
			echo json_encode($response);

		}catch(\Exception $e) {
				echo $e->getMessage();
		}
		$this->redirect("grid", null, null, true);	
	}	
}
?>