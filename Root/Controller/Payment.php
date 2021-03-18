<?php
Mage::loadFileByClassName('controller_core_admin');


class Controller_Payment extends Controller_Core_Admin
{

    public function gridAction()
    {
        $grid = Mage::getBlock('block_payment_grid');

        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $content->addChild($grid);

        $this->renderLayout();
    }

    public function formAction()
    {
        try {
            $edit = Mage::getBlock('block_payment_edit');

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

                $payment = Mage::getModel('model_payment');
                $id = (int)$this->getRequest()->getGet('id');

                if ($id) {
                    $result = $payment->load($id);
                    if (!$result) {
                        throw new Exception('record not found');
                    }
                } else {
                    $payment->createdDate = date('Y-m-d H:i:s');
                }
                $payment->setData($this->getRequest()->getPost('payment'));

                if (!$payment->save()) {
                    $this->getMessage()->setFailure('Unable to insert');
                } else {
                    $this->getMessage()->setSuccess('Inserted Successfully');
                }

                $this->redirect('payment', 'grid', null, true);
                die;
            }
            throw new Exception("Invalid Request");
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect('payment', 'grid', null, true);
        }
    }

    public function deleteAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {

                $paymentId = (int) $this->getRequest()->getGet('id');
                $payment = Mage::getModel('model_payment');

                if ($paymentId) {
                    $result = $payment->load($paymentId);
                }

                if (!$result) {
                    throw new Exception("record Not found");
                }

                if ($payment->delete()) {
                    $this->getMessage()->setSuccess('Deleted Successfully');
                }

                $this->redirect('payment', 'grid', null, true);
            } else {
                throw new Exception('Invalid Request');
            }
        } catch (Exception $e) {

            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect('payment', 'grid', null, true);
        }
    }
}
