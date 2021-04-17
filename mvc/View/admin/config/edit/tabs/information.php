<?php
$config_group = $this->getTableRow();
?>

<h2 align="center" class="display-4">Add/Update Config</h2><br><br>
<form method="post" action="<?php echo $this->getUrl('save'); ?>">
    <div class="row">
                <div class="col-md-6">

                    <label for="name" class="font-control">Name</label><br>
                    <input type="text" class="form-control"  name="config_group[name]" value="<?php echo $config_group->name;  ?>"><br><br>
                    <button type="submit" class="btn btn-success" value="submit">Submit</button>
                </div>
    </div>
</form>