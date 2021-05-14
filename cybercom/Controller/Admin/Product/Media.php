<?php 
namespace Controller\Admin\Product;
\Mage::loadFileByClassName('Controller\Core\Admin');

class Media extends \Controller\Core\Admin{

	protected $media = [];
	protected $mediaModel = null;
	
	public function setMediaModel($mediaModel = null) {
		if (!$mediaModel) {
			$mediaModel = \Mage::getModel('Model\Product\Media');
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
	
	public function uploadAction() {
			
		date_default_timezone_set('Asia/Kolkata');
		try{
			if (!$this->getRequest()->isPost()) {
				throw new \Exception("Invalid Request");
				
			}
			$product = \Mage::getModel('Model\Product');
			$media = \Mage::getModel('Model\Product\Media');
			if ($id = $this->getRequest()->getGet('mediaId')) {
				$media = $media->load($id);

				if (!$media) {
					$this->getMessage()->setFailure("No Records Found");	
				}
			}
			$imageName = $_FILES['file']['name'];
			$imagetmpPath = $_FILES['file']['tmp_name'];
			$path = $_SERVER['DOCUMENT_ROOT'].'/cybercom/Images/Product/';
			$randomName = 'product'.rand(1,6).'_'.$imageName;
			if (move_uploaded_file($imagetmpPath, $path.$randomName)) {
				$media = \Mage::getModel('Model\Product\Media');
				$media->productId = $this->getRequest()->getGet('productId');
				$media->image = $randomName;	
				$media->save();
			}

			$id =$this->getRequest()->getGet('productId');
			if ($id) {
				$product = $product->load($id);
				if (!$product) {
					throw new \Exception("No records Found");
				}
			}
			$edit = \Mage::getBlock('Block\Admin\Product\Edit')->setTableRow($product)->toHtml();

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
			$path = $_SERVER['DOCUMENT_ROOT'].'/cybercom/Images/Product/';
			$mediaModel = \Mage::getModel('Model\Product\Media');
			foreach ($mediaId as $id =>$value) {
				$mediaModel->load($id);
				unlink($path.$mediaModel->image);
				$mediaModel->delete();	
			}
			$product = \Mage::getModel('Model\Product');
			$id =$this->getRequest()->getGet('productId');
			if ($id) {
				$product = $product->load($id);
				if (!$product) {
					throw new \Exception("No records Found");
				}
			}
			$edit = \Mage::getBlock('Block\Admin\Product\Edit')->setTableRow($product)->toHtml();

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
			
			$label = $this->getRequest()->getPost('label');
			$small = $this->getRequest()->getPost('small');
			$base = $this->getRequest()->getPost('base');
			$thumb = $this->getRequest()->getPost('thumb');
			$galleryData = $this->getRequest()->getPost('gallery');
			
			$mediaModel = \Mage::getModel('Model\Product\Media');
			foreach ($label as $id => $value) {
				$mediaModel->load($id);
				$mediaModel->label = $value;

				if($small == $id){
					$mediaModel->small = 1;
				} else {
					$mediaModel->small = 0;
				}

				if($base == $id){
					$mediaModel->base = 1;
				} else {
					$mediaModel->base = 0;
				}

				if($thumb == $id){
					$mediaModel->thumb = 1;
				} else {
					$mediaModel->thumb = 0;
				}

				if(array_key_exists($id, $galleryData)){
					$mediaModel->gallery = 1;	
				} else {
					$mediaModel->gallery = 0;
				}

				$mediaModel->save();
			}

			$product = \Mage::getModel('Model\Product');
			$id =$this->getRequest()->getGet('productId');
			if ($id) {
				$product = $product->load($id);
				if (!$product) {
					throw new \Exception("No records Found");
				}
			}
			$edit = \Mage::getBlock('Block\Admin\Product\Edit')->setTableRow($product)->toHtml();

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
?>