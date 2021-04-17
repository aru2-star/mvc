<?php
$admin = $this->getAdmin();
$option = $admin->getStatusOption();
?>

<div align="center" class="container">
    <h2 align="center" class="display-4">Add/Update Admin</h2>

        <form method="post" action="<?php echo $this->getUrl('save') ?>">
  
        <div class="row">
            <div class="col-md-6">

                <label for="name" class="form-label">Name</label><br>
                <input type="text" class="form-control"  name="admin[name]" value="<?php echo $admin->name; ?>">


                <label for="password" class="form-label">Password</label><br>
                <input type="password" class="form-control"  name="admin[password]" value="<?php echo $admin->password;  ?>">
    
            </div>

            <div class="col-md-6">

                <label for="status" class="form-label">Status</label><br>
                <select name="admin[status]">
                <?php foreach($option as $key=>$value){ ?>
                    <option value="<?php echo $key; ?>" <?php if($admin->status == $key){echo "selected";} ?> ><?php echo $value; ?></option>
                <?php } ?>
                </select><br><br>
                <button type="submit" class="btn btn-success" value="submit">Submit</button>


            </div>
        </div>

        </form>
</div>