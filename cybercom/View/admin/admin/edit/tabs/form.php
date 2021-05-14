<?php
$admin = $this->getTableRow();
$id = $this->getRequest()->getGet('adminId');
?>
<div class="container">
<div class="form-group">
    <label>Name</label>
    <input type="text" name="admin[username]" id="admin_name" class="form-control" placeholder="Enter Your Name" value="<?php echo $admin->username;?>">
</div>
<div class="form-group">
    <label>Password</label>
    <input type="password" name="admin[password]" id="admin_password" class="form-control" placeholder="Enter Your Password">
</div>
<div class="form-group">
     <label>Status</label>
    <select name="admin[status]" id="admin_status" class="form-control">
    <?php foreach($admin->getStatusOptions() as $key => $value):?>
        <option value="<?php echo $key;?>" <?php if ($admin->status == $key) : ?> 
        selected <?php endif;?>><?php echo $value; ?></option>
        <?php endforeach;?>
    </select> 
</div>
<div class="form-group">
   <button type="button" class="btn btn-success" name="save" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save');?>').resetParam().setParams($('#editForm').serializeArray()).setMethod('POST').load();">Save</button>
</div>
</div>