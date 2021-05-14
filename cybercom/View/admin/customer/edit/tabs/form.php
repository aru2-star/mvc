<?php
$customers = $this->getTableRow();
$group = $this->getCustomerGroup();

$id = $this->getRequest()->getGet('customerId');
?>
<div class="container">
    <div class="form-group">
        <label>Group </label>
        <select name="customer[groupId]" id="upd_customer_group" class="form-control">
            <?php if($group):?>
            <?php foreach($group as $groupId => $name):?>
            <option value="<?php echo $groupId;?>" <?php if($groupId == $customers->groupId):?>selected <?php endif;?>><?php echo $name; ?></option> 
        <?php endforeach;?>
    <?php endif;?>
        </select>
    </div>
                    
    <div class="form-group">
        <label>First Name</label>
        <input type="text" name="customer[fname]" id="customer_fname" class="form-control" placeholder="Enter Your Firstname" value="<?php echo $customers->fname;?>">
    </div>
    
    <div class="form-group">
        <label>Last Name</label>
        <input type="text" name="customer[lname]" id="customer_lname" class="form-control" placeholder="Enter Your Lastname" value="<?php echo $customers->lname;?>">
    </div>
    
    <div class="form-group">
        <label>Email</label>
        <input type="text" name="customer[email]" id="customer_email" class="form-control" placeholder="Enter Your Email" value="<?php echo $customers->email;?>">   
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" name="customer[passwordhash]" id="customer_password" class="form-control" placeholder="Enter Your Password">
    </div>
    
    <div class="form-group">
        <label>Status</label>
        <select name="customer[status]" id="upd_cstatus" class="form-control">
            <?php foreach($customers->getStatusOptions() as $key => $value):?>
                <option value="<?php echo $key;?>" <?php if ($customers->status == $key) : ?> 
                    selected <?php endif;?>><?php echo $value; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Mobile </label>
        <input type="text" name="customer[mobile]" id="cust_mobile" class="form-control" placeholder="Enter Your Mobile Number" value="<?php echo $customers->mobile;?>">
    </div>
    
    <div class="form-group">
        <?php if($id):?>
    <button type="button" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save','admin_customer',['customerId'=> $id],true);?>').resetParam().setParams($('#editForm').serializeArray()).setMethod('POST').load();" class="btn btn-success" name="save">Save</button>
    <?php else: ?>
        <button type="button" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save','admin_customer',null,true);?>').resetParam().setParams($('#editForm').serializeArray()).setMethod('POST').load();" class="btn btn-success" name="save">Save</button>
        
    <?php endif; ?>
</div>
</div>
