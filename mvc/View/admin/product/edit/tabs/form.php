<?php

$products = $this->getTableRow(); 
$statusOptions = [1=>'Enable',2=>'Disable'];
$id = $this->getRequest()->getGet('productId');

?>
<div class="container">
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="product[name]" id="pname" class="form-control" placeholder="Enter Product Name" value="<?php echo $products->name;?>">
                                            
    </div>
    <div class="form-group">
        <label>sku</label>
        <input type="text" name="product[sku]" id="psku" class="form-control" placeholder="Product sku" value="<?php echo $products->sku;?>">
    </div>
                            
    <div class="form-group">
        <label>Price(in Rs.)</label>
        <input type="text" name="product[price]" id="pprice" class="form-control" placeholder="Enter Product Price" value="<?php echo $products->price;?>">
                                            
    </div>
    <div class="form-group">
        <label>Discount(in Rs.)</label>
       <input type="text" name="product[discount]" id="pdiscount" class="form-control" placeholder="Enter product discount" value="<?php echo $products->discount;?>">
    </div>
    <div class="form-group">
        <label>Quantity</label>
        <input type="text" name="product[quantity]" id="pquantity" class="form-control" placeholder="Enter product qunatity" value="<?php echo $products->quantity;?>">           
    </div>
    <div class="form-group">
        <label>Description</label>
        <input type="text" name="product[description]" id="pdesc" class="form-control" placeholder="Enter product Description" value="<?php echo $products->description;?>">
    </div>
    <div class="form-group">
        <label>Status</label>
        <select name="product[status]" id="pstatus" class="form-control">
        <?php foreach($products->getStatusOptions() as $key => $value):?>
            <option value="<?php echo $key;?>" <?php if ($products->status == $key) : ?> 
            selected <?php endif;?>><?php echo $value; ?></option>
            <?php endforeach;?>
        </select> 
    </div>
    <div class="form-group">
        <?php if ($id): ?>
            <button type="button" class="btn btn-success" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save','admin_product',['productId' => $id],true); ?>').resetParam().setParams($('#editForm').serializeArray()).setMethod('POST').load();" name="save">Save</button>
        <?php else: ?>
            <button type="button" class="btn btn-success" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save','admin_product',null,true); ?>').resetParam().setParams($('#editForm').serializeArray()).setMethod('POST').load();" name="save">Save</button>
        <?php endif; ?>
         
        <button type="button" class="btn btn-danger" >Close</button>
    </div>

</div>