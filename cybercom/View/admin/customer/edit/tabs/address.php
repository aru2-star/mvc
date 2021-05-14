<?php

$baddress = $this->getBillingAddress();
$saddress = $this->getShippingAddress();
$id = $this->getRequest()->getGet('addressId');
?>
<h5>Billing Address</h5>
<div>
<div class="form-group">
    <label>Address</label>
    <input type="text" name="billing_address[address]" id="address" class="form-control" placeholder="Enter Your Address" value="<?php echo $baddress->address; ?>">
</div>
<div class="form-group">
    <label>City</label>
    <input type="text" name="billing_address[city]" id="city" class="form-control" placeholder="Enter Your City" value="<?php echo $baddress->city;?>">
</div>
<div class="form-group">
    <label>Zipcode</label>
    <input type="text" name="billing_address[zipcode]" id="zipcode" class="form-control" placeholder="Enter Your Zipcode" value="<?php echo $baddress->zipcode; ?>">   
</div>
<div class="form-group">
    <label>State</label>
    <input type="text" name="billing_address[state]" id="state" class="form-control" placeholder="Enter Your State" value="<?php echo $baddress->state; ?>">   
</div>
<div class="form-group">
    <label>Country</label>
    <input type="text" name="billing_address[country]" id="country" class="form-control" placeholder="Enter Your Country" value="<?php echo $baddress->country; ?>">
</div>
</div>
<br>
<h5>Shipping Address</h5>
<div>
<div class="form-group">
    <label>Address</label>
    <input type="text" name="shipping_address[address]" id="address" class="form-control" placeholder="Enter Your Address" value="<?php echo $saddress->address; ?>">
</div>
<div class="form-group">
    <label>City</label>
    <input type="text" name="shipping_address[city]" id="city" class="form-control" placeholder="Enter Your City" value="<?php echo $saddress->city;?>">
</div>
<div class="form-group">
    <label>Zipcode</label>
    <input type="text" name="shipping_address[zipcode]" id="zipcode" class="form-control" placeholder="Enter Your Zipcode" value="<?php echo $saddress->zipcode; ?>">   
</div>
<div class="form-group">
    <label>State</label>
    <input type="text" name="shipping_address[state]" id="state" class="form-control" placeholder="Enter Your State" value="<?php echo $saddress->state; ?>">   
</div>
<div class="form-group">
    <label>Country</label>
    <input type="text" name="shipping_address[country]" id="country" class="form-control" placeholder="Enter Your Country" value="<?php echo $saddress->country; ?>">
</div>
</div>
<div class="form-group">
    <?php if($id):?>
    <button type="button" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save','admin_customer',['addressId'=> $id]);?>').resetParam().setParams($('#editForm').serializeArray()).setMethod('POST').load();" class="btn btn-success" name="save">Save</button>
    <?php else: ?>
        <button type="button" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save','admin_customer',null);?>').resetParam().setParams($('#editForm').serializeArray()).setMethod('POST').load();" class="btn btn-success" name="save">Save</button>
    <?php endif; ?>
    <button type="button" class="btn btn-danger" >Close</button>
</div>

