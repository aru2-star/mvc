<?php 
namespace Controller\Admin\Category;
\Mage::loadFileByClassName('Controller\Core\Admin');

class Media extends \Controller\Core\Admin{

	protected $media = [];
	protected $mediaModel = null;
	
	
	public function setMediaModel($mediaModel = null) {
		if (!$mediaModel) {
			$mediaModel = \Mage::getModel('Model\Category\Media');
		}
		$this->mediaModel = $mediaModel;
		return $this;
	}

	public function getMediaModel()
	{
		if (!$this->mediaModel) {
			$this->setMediaModel();
		}
		return $this->mediaModel;
	}
	
	public function setMedia($media) {
		$this->media = $media;
		return $this;
	}

	public function getMedia() {
		return $this->media;
	}
	public function uploadAction()
	{
		try{
			if (!$this->getRequest()->isPost()) {
				throw new \Exception("Invalid Request");
				
			}
			$categoryMedia = \Mage::getModel('Model\Category\Media');
			if ($id = $this->getRequest()->getGet('categoryId')) {
				$categoryMedia = $categoryMedia->load($id);

				if (!$categoryMedia) {
					$this->getMessage()->setFailure("No Records Found");	
				}
			}

				$imageName = $_FILES['file']['name'];
				$imagetmpPath = $_FILES['file']['tmp_name'];
				$randomName = 'category_'.rand(1,6).'_'.$imageName;
				$path = $_SERVER['DOCUMENT_ROOT'].'/mvc/Images/Category/';
				if (move_uploaded_file($imagetmpPath, $path.$randomName)) {
					$categoryMedia = \Mage::getModel('Model\Category\Media');
					$categoryMedia->categoryId = $this->getRequest()->getGet('categoryId');
					$categoryMedia->image = $randomName;	
					$categoryMedia->save();
					
				}
		
			$id =$this->getRequest()->getGet('categoryId');
			if ($id) {
				$category = \Mage::getModel('Model\Category');
				$category = $category->load($id);
				if (!$category) {
					throw new \Exception("No records Found");
				}
			}
			$edit = \Mage::getBlock('Block\Admin\Category\Edit')->setTableRow($category)->toHtml();

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
		
		} catch (\Exception $e) {

			echo $e->getMessage();
		}	
	}
	
	
	public function deleteAction() {

		try{
			
			$mediaId = $this->getRequest()->getPost('remove');
			$path = $_SERVER['DOCUMENT_ROOT'].'/mvc/Images/Category/';
			$mediaModel = \Mage::getModel('Model\Category\Media');
			
			foreach ($mediaId as $id =>$value) {
				$mediaModel->load($id);
				unlink($path.$mediaModel->image);
				$mediaModel->delete();	
			}
			$category = \Mage::getModel('Model\Category');
			$id =$this->getRequest()->getGet('categoryId');
			if ($id) {
				$category = $category->load($id);
				if (!$category) {
					throw new \Exception("No records Found");
				}
			}
			$edit = \Mage::getBlock('Block\Admin\Category\Edit')->setTableRow($category)->toHtml();

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
		catch(\Exception $e) { 
			echo $e->getMessage();
		}
		
	}

	public function updateAction() {
		
		try{
			
			$base = $this->getRequest()->getPost('base');
			$icon = $this->getRequest()->getPost('icon');
			$banner = $this->getRequest()->getPost('banner');
			$active = $this->getRequest()->getPost('media');

			$mediaModel = \Mage::getModel('Model\Category\Media');
			if($active) {
				foreach ($active['active'] as $id => $value) {
					$mediaModel->load($id);
					$mediaModel->active = $value;


					if($base == $id){
						$mediaModel->base = 1;
					} else {
						$mediaModel->base = 0;
					}

					if($icon == $id){
						$mediaModel->icon = 1;
					} else {
						$mediaModel->icon = 0;
					}
					$mediaModel->save();
				}
			}
			$category = \Mage::getModel('Model\Category');
			$id =$this->getRequest()->getGet('categoryId');
			if ($id) {
				$category = $category->load($id);
				if (!$category) {
					throw new \Exception("No records Found");
				}
			}
			$edit = \Mage::getBlock('Block\Admin\Category\Edit')->setTableRow($category)->toHtml();

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
		catch(\Exception $e) {
			echo $e->getMessage();
		}
		
		}


}
