<?php
Mage::loadFileByClassName('Controller_Core_Admin');


class Controller_Category extends Controller_Core_Admin
{

    public function gridAction()
    {
        $grid = Mage::getBlock('block_category_grid');

        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $content->addChild($grid);

        $this->renderLayout();
    }

    public function formAction()
    {
        try {
            $edit = Mage::getBlock('block_category_edit');

            $layout = $this->getLayout();
            $layout->setTemplate('View/core/layout/threeColumn.php');

            $content = $layout->getChild('content');
            $content->addChild($edit);

            $this->renderLayout();
        } catch (Exception $e) {
            echo 'Message:-' . $e->getMessage();
        }
    }

    public function addAction()
    {
        date_default_timezone_set('Asia/Kolkata');
        try {
            if ($this->getRequest()->isPost()) {

                $category = Mage::getModel('model_category');
                $id = (int)$this->getRequest()->getGet('id');

                if ($id) {
                    $result = $category->load($id);
                    if (!$result) {
                        throw new Exception('record not found');
                    }
                }
                $category->setData($this->getRequest()->getPost('category'));

                if (!$category->save()) {
                    $this->getMessage()->setFailure('Unable to insert');
                } else {
                    $this->getMessage()->setSuccess('Inserted Successfully');
                }

                $this->redirect('category', 'grid', null, true);
                die;
            }
            throw new Exception("Invalid Request");
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect('category', 'grid', null, true);
        }
    }

    public function deleteAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {

                $categoryId = (int) $this->getRequest()->getGet('id');
                $category = Mage::getModel('model_category');

                if ($categoryId) {
                    $result = $category->load($categoryId);
                }

                if (!$result) {
                    throw new Exception("record Not found");
                }


                if ($category->delete()) {
                    $this->getMessage()->setSuccess('Deleted Successfully');
                }

                $this->redirect('category', 'grid', null, true);
            } else {
                throw new Exception('Invalid Request');
            }
        } catch (Exception $e) {

            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect('category', 'grid', null, true);
        }
    }
}
