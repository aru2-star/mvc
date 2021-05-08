<?php
$customerGroup = $this->getTableRow();
$id = $this->getRequest()->getGet('groupId');
?>

<div class="container">
<div class="form-group">
    <label>Group Name</label>
    <input type="text" name="customerGroup[name]" id="group_name" class="form-control" placeholder="Enter GroupName" value="<?php echo $customerGroup->name;?>">
</div>
<div class="form-group">
    <label>Default Type</label>
    <input type="text" name="customerGroup[default_type]" id="group__default_type" class="form-control" placeholder="Enter Your Firstname" value="<?php echo $customerGroup->default_type;?>">
</div>

 <div class="form-group">
        <?php if($id):?>
    <button type="button" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save','admin_customer_customerGroup',['groupId'=> $id],true);?>').resetParam().setParams($('#editForm').serializeArray()).setMethod('POST').load();" class="btn btn-success" name="save">Save</button>
    <?php else: ?>
        <button type="button" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save','admin_customer_customerGroup',null,true);?>').resetParam().setParams($('#editForm').serializeArray()).setMethod('POST').load();" class="btn btn-success" name="save">Save</button>
        
    <?php endif; ?>

    <button type="button" class="btn btn-danger" >Close</button>
</div>
</div>
