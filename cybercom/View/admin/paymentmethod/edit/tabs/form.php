<?php

$paymentMethod = $this->getTableRow();
$id = $this->getRequest()->getGet('paymentMethodId');
?>
<div class="container">
<div class="form-group">
    <label for="name">Name:</label>
    <input type="text" class="form-control" name="paymentmethod[name]" id="method_name" value="<?php echo $paymentMethod->name; ?>"  placeholder= "Enter Payment Method Name"required>
</div>
<div class="form-group">
    <label for="code">Code:</label>
    <input type="text" class="form-control" name="paymentmethod[code]" id="method_code" value="<?php echo $paymentMethod->code; ?>"  placeholder= "Enter Payment Method Code" required>
</div>
<div class="form-group">
    <label for="description">Description:</label>
    <input type="text" class="form-control" name="paymentmethod[description]" id="method_desc" value="<?php echo $paymentMethod->description; ?>"  placeholder= "Enter Payment Method Description" required>
</div>
<div class="form-group">
    <label for="status">Status:</label>
   <select name="paymentmethod[status]" id="method_status" class="form-control">
        <?php foreach($paymentMethod->getStatusOptions() as $key => $value):?>
        <option value="<?php echo $key;?>" <?php if ($paymentMethod->status == $key) : ?> 
        selected <?php endif;?>><?php echo $value; ?></option>
        <?php endforeach;?>
    </select>
</div>
<div class="form-group">
    <?php if($id):?>
        <button type="button" class="btn btn-success" name="save" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save','admin_paymentmethod',['paymentMethodId'=>$id],true);?>').resetParam().setParams($('#editForm').serializeArray()).load();">Save</button> 
    <?php else: ?>
        <button type="button" class="btn btn-success" name="save" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save','admin_paymentmethod',null,true);?>').resetParam().setParams($('#editForm').serializeArray()).load();">Save</button> 
    <?php endif;?>
</div>
</div>
       