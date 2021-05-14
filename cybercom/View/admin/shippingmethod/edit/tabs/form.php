<?php

$shippingMethods = $this->getTableRow();
$id = $this->getRequest()->getGet('shippingMethodId');
?>
<div class="container">
<div class="form-group">
    <label for="name">Name:</label>
    <input type="text" class="form-control" name="shippingmethod[name]" id="method_name" value="<?php echo $shippingMethods->name; ?>" placeholder="Enter Shipping Method Name" required="">
</div>
<div class="form-group">
    <label for="code">Code:</label>
    <input type="text" class="form-control" name="shippingmethod[code]" id="method_code" value="<?php echo $shippingMethods->code; ?>" placeholder="Enter Shipping Method Code" required="">
</div>
<div class="form-group">
    <label for="discount">Amount(in Rs.):</label>
    <input type="number" class="form-control" name="shippingmethod[amount]" id="method_amount" value="<?php echo $shippingMethods->amount; ?>" placeholder="Enter Shipping Method Amount" required="">
</div>
<div class="form-group">
    <label for="description">Description:</label>
    <input type="text" class="form-control" name="shippingmethod[description]" id="method_desc" value="<?php echo $shippingMethods->description; ?>" placeholder="Enter Shipping Method Description" required="">
</div>
<div class="form-group">
    <label for="status">Status:</label>
    <select name="shippingmethod[status]" id="method_status" class="form-control">
    <?php foreach($shippingMethods->getStatusOptions() as $key => $value):?>
        <option value="<?php echo $key;?>" <?php if ($shippingMethods->status == $key) : ?> 
        selected <?php endif;?>><?php echo $value; ?></option>
        <?php endforeach;?>    
    </select>
</div>
<div class="form-group">
    <?php if ($id): ?>
        <button type="button" class="btn btn-success" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save','admin_shippingmethod',['shippingMethodId' => $id],true); ?>').resetParam().setParams($('#editForm').serializeArray()).setMethod('POST').load();" name="save">Save</button>
    <?php else: ?>
        <button type="button" class="btn btn-success" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save','admin_shippingmethod',null,true); ?>').resetParam().setParams($('#editForm').serializeArray()).setMethod('POST').load();" name="save">Save</button>
    <?php endif; ?>
</div>
</div>        