<?php 
namespace Block\Admin\PlaceOrder;

class Grid extends \Block\Core\Grid
{
    protected $order = null;
    protected $pages = null;
    protected $filter = null;

    public function prepareCollection()
    {
        $orderModel = \Mage::getModel('Model\PlaceOrder');
        $offset = ($this->getPages()->getCurrentPage() - 1) * $this->getPages()->getRecordsPerPage();
        $query = "SELECT o.*,c.* FROM `{$orderModel->getTableName()}`as o INNER JOIN `customer_details` as c ON o.customerId = c.customerId LIMIT {$offset},{$this->getPages()->getRecordsPerPage()}";
        $orderModel = $orderModel->fetchAll($query);
        $this->setCollection($orderModel);
        return $this;   
    }

    public function prepareColumns()
    {
        $this->addColumn('orderId',[
            'label' => 'OrderId',
            'field' => 'orderId',
            'type' => 'number',
            'controller' => 'placeOrder'
        ]);
        $this->addColumn('fname',[
            'label' => 'Customer FirstName',
            'field' => 'fname',
            'type' => 'text',
            'controller' => 'placeOrder'
        ]);

        $this->addColumn('lname',[
            'label' => 'Customer LastName',
            'field' => 'lname',
            'type' => 'text',
            'controller' => 'placeOrder'
        ]);

        $this->addColumn('mobile',[
            'label' => 'Customer MobileNo',
            'field' => 'mobile',
            'type' => 'number',
            'controller' => 'placeOrder'
        ]);

        $this->addColumn('email',[
            'label' => 'Customer Email',
            'field' => 'email',
            'type' => 'text',
            'controller' => 'placeOrder'
        ]);

        $this->addColumn('createdAt',[
            'label' => 'Created At',
            'field' => 'createdAt',
            'type' => 'datetime',
            'controller' => 'placeOrder'
        ]);

        $this->addColumn('total',[
            'label' => 'Total Amount(in Rs.)',
            'field' => 'total',
            'type' => 'datetime',
            'controller' => 'placeOrder'
        ]);

        return $this;
    }
    public function prepareButtons()
    {
        $this->addButton('add',[
            'label' => 'Add New',
            'method' => 'getAddNewUrl',
            'ajax' => true
        ]);

        return $this;   
    }

    public function prepareActions()
    {
        $this->addActions('view',[
            'label' => 'View',
            'method' => 'getViewUrl',
            'ajax' => true
        ]);

        return $this;
    }

    public function getTitle()
    {
        return '<h3 align="center">Order List</h3>';
    }

    public function getViewUrl($row)
    {
        $url = $this->getUrl()->getUrl('view','admin_placeOrder',['orderId' => $row->orderId]);
        return "object.setUrl('{$url}').resetParam().load()";   
    }

    public function getAddNewUrl()
    {
        $url = $this->getUrl()->getUrl('index','admin_cart',null,true);
        return "object.setUrl('{$url}').resetParam().load()";       
    }

    public function setPages(){

        $this->pages = \Mage::getController('Controller\Core\Pager');
        $orderModel = \Mage::getModel('Model\PlaceOrder');

        $query = "SELECT * FROM `{$orderModel->getTableName()}`";   
        $orderCount = $orderModel->getAdapter()->fetchOne($query);
        $this->pages->setTotalRecords($orderCount);
        $this->pages->setRecordsPerPage(10);
        if(isset($_GET['page'])) {
            $this->pages->setCurrentPage($_GET['page']);    
        } else {
            $this->pages->setCurrentPage(1);    
        }
        
        $this->pages->calculate();


    }

    public function getPages()
    {
        if(!$this->pages){
            $this->setPages();
        }
        return $this->pages;
    }

    public function getFilter()
    {
        if(!$this->filter){
            $this->filter = \Mage::getModel('Model\Admin\Filter');
        }
        return $this->filter;
    }

}
// namespace Block\Admin\PlaceOrder;
// \Mage::loadFileByClassName('Block\Core\Grid');

// class Grid extends \Block\Core\Grid{

// 	public function __construct(){
// 		parent::__construct();
// 		$this->setTemplate('./View/admin/placeOrder/grid.php');
// 	}
       
//     public function getPlaceOrder()
//     {
//         $order=\Mage::getModel('Model\placeOrder');
//         $query="SELECT p.orderId,p.total,p.shippingAmount,p.total,c.customerId,c.firstName,c.lastName,c.email,c.contactNo,pay.paymentName,s.shippingName ,pa.address,pa.zipcode,pa.state,pa.country 
//         FROM `placeorder` As p, 
//         `customer` As c, 
//         `payment_method` As pay, 
//         `shipping_method` As s, 
//         `placeorder_address` As pa 
//         WHERE p.customerId = c.customerId 
//             AND p.paymentId = pay.paymentId 
//             AND p.shippingId = s.shippingId 
//             AND p.orderId = pa.orderId";
//         $orders=$order->fetchAll($query);            
        
//         return $orders;
//     }




// }


?>