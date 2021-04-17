<?php
$customer = $this->getTableRow();
$group = $this->getGroup();
$option = $customer->getStatusOption();
?>
<h2 align="center" class="display-4">Add/Update Customer</h2>
<form method="post" action="<?php echo $this->getUrl('save'); ?>">
<div class="row">
            <div class="col-md-6">

                <label for="firstname" class="form-label">Firstname</label><br>
                <input type="text" name="customer[firstname]" class="form-control" value="<?php echo $customer->firstname; ?>"><br>

                <label for="lastname" class="form-label">Lastname</label><br>
                <input type="text" name="customer[lastname]" class="form-control" value="<?php echo $customer->lastname; ?>"><br>
    
                <label for="email" class="form-label">Email</label><br>
                <input type="email" name="customer[email]" class="form-control" value="<?php echo $customer->email; ?>"><br>
            </div>

            <div class="col-md-6">
                <label for="groupId" class="form-label">GroupId</label><br>
                <select name="customer[groupId]">
                    <?php foreach($group as $key=>$value){?>
                    <option value="<?php echo $value['groupId'] ?>"><?php echo $value['name']; ?></option>
                    <?php } ?>
                </select><br><br>


                <label for="password" class="form-label">Password</label><br>
                <input type="password"  name="customer[password]" class="form-control"
                value="<?php echo $customer->password; ?>"><br>
    
                <label for="status" class="form-label">Status</label><br>
                <select name="customer[status]">
                <?php foreach($option as $key=>$value){ ?>
                    <option value="<?php echo $key; ?>" <?php if($customer->status == $key){echo "selected";} ?> ><?php echo $value; ?></option>
                <?php } ?>
                </select><br><br>

                <button type="submit" class="btn btn-success" value="submit">Submit</button>
        </div>
</form>