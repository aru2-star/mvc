<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');

class Attribute extends \Controller\Core\Admin
{
	
		public function indexAction()
		{
			$layout = \Mage::getBlock('Block\Admin\Core\Layout');
			echo $this->renderLayout();
		}

		public function gridAction()
		{
			$grid = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
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

			header('Content-type: application/json');
			echo json_encode($response);
		}

		public function editAction()
		{
			try{
			$attribute = \Mage::getModel('Model\Attribute');
			$id = $this->getRequest()->getGet('attributeId');
			if ($id) {
				
				$attribute = $attribute->load($id);

				if (!$attribute) {
					throw new \Exception("No records found");
					
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

			header('Content-type: application/json');
			echo json_encode($response);
		}catch(\Exception $e) {
			echo $e->getMessage();
		}
		}

		public function saveAction()
		{
			try{
				$attribute = \Mage::getModel('Model\Attribute');
				if ($id = $this->getRequest()->getGet('attributeId')) {
					$attribute = $attribute->load($id);
					if (!$attribute) {
						$this->getMessage()->setFailure('No records Found');
					}
					$this->getMessage()->setSuccess('Records Updated Successfully');
				} else {
					$this->getMessage()->setSuccess('Records Inserted Successfully');
				}

				$attributeData = $this->getRequest()->getPost('attribute');
				$attribute->setData($attributeData);
				if($attribute->save()){
					$model = \Mage::getModel('Model\\'.ucfirst($attribute->entityTypeId));
					$type = $attribute->backendType;
			
					if($type == "VARCHAR"){
						$query = "ALTER TABLE `{$attribute->entityTypeId}` ADD COLUMN `{$attribute->name}` {$type}(20)";	
					} else{
						$query = "ALTER TABLE `{$attribute->entityTypeId}` ADD COLUMN `{$attribute->name}` {$type}";
					}

					if(!$model->alterTable($query)){
						$this->getMessage()->setFailure('Error ');	
					}
					
				}
				//$attribute->setEntityAttributes();
			$grid = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
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

			header('Content-type: application/json');
			echo json_encode($response);
		}catch(\Exception $e) {
			echo $e->getMessage();
		}

		}

	
		public function deleteAction()
		{
			try{
			$id = (int)$this->getRequest()->getGet('attributeId');
			if (!$id) {
				$this->getMessage()->setFailure('Id Not Found');
			}
			$attribute = \Mage::getModel('Model\Attribute');
			$attribute->load($id);
			$model = \Mage::getModel('Model\\'.ucfirst($attribute->entityTypeId));
			$tableName = $attribute->entityTypeId;
			$query = "ALTER TABLE `{$tableName}` DROP COLUMN `{$attribute->name}`";
			
			if($model->alterTable($query)){
				if (!$attribute->delete()) {
					$this->getMessage()->setFailure('Id Invalid');
				}	
			}
			$this->getMessage()->setSuccess('Record Deleted Successfully');
		
			$grid = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
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

			header('Content-type: application/json');
			echo json_encode($response);			
		}catch(\Exception $e) {
			echo $e->getMessage();
		}
		}


		public function filterAction()
		{
			$filters = $this->getRequest()->getPost('filter');
			
			$filterModel = \Mage::getModel('Model\Admin\Filter');
			$filterModel->setFilter($filters);
			
			$gridHtml = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
				$response = [
					'status' => 'success',
					'message' => 'you did it',
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

		public function clearFilterAction()
		{
			
		}
		
	    public function testAction() {

	    	$query = "SELECT * FROM attribute WHERE `entityTypeId` = 'product'";
	    	$attributes = \Mage::getModel('Model\Attribute')->fetchAll($query);
	    	
	    	foreach ($attributes->getData() as $key => $attribute) {
	    		
	    		print_r($attribute->getOptions());
	    		
	    	}
	    }



		
}


?>