<nav class="navbar navbar-expand-sm bg-secondary sticky-top">
        <ul class="navbar-nav font-weight-bold" >
            <li class="nav-item" style="width: 5rem;" >
            <li><h3>Application<h3></li>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item ">
            <a class="nav-link text-white font-weight-bold" style="width: 6rem;" href="<?php echo $this->getUrl('grid','Admin\dashboard',null,true); ?>">Dashboard</a>
            </li>
            <li class="nav-item ">
            <a class="nav-link text-white font-weight-bold" style="width: 6rem;" href="<?php echo $this->getUrl('grid','Admin\product',null,true); ?>">Product</a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-white font-weight-bold" style="width: 6rem;"  href="<?php echo $this->getUrl('grid','Admin\category',null,true); ?>">Category</a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-white font-weight-bold" style="width: 6rem;"  href="<?php echo $this->getUrl('grid','Admin\customer',null,true); ?>">Customer</a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-white font-weight-bold" style="width: 6rem;"  href="<?php echo $this->getUrl('grid','Admin\customergroup',null,true); ?>">Customer Group</a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-white font-weight-bold" style="width: 6rem;"  href="<?php echo $this->getUrl('grid','Admin\config',null,true); ?>">Configuration Group</a>
            </li>
</ul>
<ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link text-white font-weight-bold" style="width: 6rem;"  href="<?php echo $this->getUrl('grid','Admin\shipping',null,true); ?>">Shipping Method</a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-white font-weight-bold" style="width: 6rem;" href="<?php echo $this->getUrl('grid','Admin\payment',null,true); ?>">Payment Method</a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-white font-weight-bold" style="width: 6rem;" href="<?php echo $this->getUrl('grid','Admin\attribute',null,true); ?>">Attribute</a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-white font-weight-bold" style="width: 6rem;" href="<?php echo $this->getUrl('grid','Admin\brand',null,true); ?>">Brand</a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-white font-weight-bold" style="width: 6rem;" href="<?php echo $this->getUrl('grid','Admin\cmspage',null,true); ?>">CMS</a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-white font-weight-bold" style="width: 6rem;" href="<?php echo $this->getUrl('grid','Admin\admin',null,true); ?>">Admin</a>
            </li>
        </ul>
    </nav>