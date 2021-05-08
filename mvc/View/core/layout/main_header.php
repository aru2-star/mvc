
<nav class="navbar navbar-expand-sm bg-secondary sticky-top">
  <a class="navbar-brand pl-5 text-white" href="#">Application</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link text-white" href="#">&nbsp;&nbsp;Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" onclick ="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin_product')?>').resetParam().load();" href="javascript:void(0);">&nbsp;&nbsp;Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" onclick ="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin_category')?>').resetParam().load();" href="javascript:void(0);">&nbsp;&nbsp;Categories</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" onclick ="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin_customer')?>').resetParam().load();" href="javascript:void(0);">&nbsp;&nbsp;Customers</a>
      </li>
      </li>
       <li class="nav-item">
        <a class="nav-link text-white" onclick ="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin_shippingmethod')?>').resetParam().load();" href="javascript:void(0);">&nbsp;&nbsp;Shipping</a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white" onclick ="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin_paymentmethod')?>').resetParam().load();" href="javascript:void(0);">&nbsp;&nbsp;Payment</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" onclick ="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin_admin');?>').resetParam().load();" href="javascript:void(0);">&nbsp;&nbsp;Admin</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" onclick ="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin_attribute');?>').resetParam().load();" href="javascript:void(0);">&nbsp;&nbsp;Attribute</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" onclick ="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin_cms');?>').resetParam().load();" href="javascript:void(0);">&nbsp;&nbsp;Cms</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" onclick ="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin_brand');?>').resetParam().load();" href="javascript:void(0);">&nbsp;&nbsp;Brand</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" onclick ="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin_order');?>').resetParam().load();" href="javascript:void(0);">&nbsp;&nbsp;Order</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" onclick ="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin_customer_customerGroup');?>').resetParam().load();" href="javascript:void(0);">&nbsp;&nbsp;Customer Group</a>
      </li>
       <li class="nav-item">
        <a class="nav-link text-white" onclick ="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin_configurationGroup');?>').resetParam().load();" href="javascript:void(0);">&nbsp;&nbsp;Configuration Group</a>
      </li>
     </ul>
  </div>
</nav>
