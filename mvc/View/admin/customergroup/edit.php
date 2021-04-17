<?php
$customerGroup = $this->getCustomerGroup();
$option = $customerGroup->getStatusOption();
?>

<div class="container">
    <h2 align="center" class="display-4">Add/Update Customer Group</h2>

        <form method="post" action="<?php echo $this->getUrl('save') ?>">

        <div class="row">
            <div class="col-md-6">

                <label for="name" class="form-control">Name</label><br>
                <input type="text" class="form-control"  name="customerGroup[name]" value="<?php echo $customerGroup->name;  ?>">
    
            </div>

            <div class="col-md-6">
                
            <label for="status" class="form-control">Status</label><br>
                <select name="customerGroup[status]">
                <?php foreach($option as $key=>$value){ ?>
                    <option value="<?php echo $key; ?>" <?php if($customerGroup->status == $key){echo "selected";} ?> ><?php echo $value; ?></option>
                <?php } ?>
                </select><br><br>
                <button type="submit" class="btn btn-success" value="submit">Submit</button>

            </div>
        </div>
    </form>
</div>