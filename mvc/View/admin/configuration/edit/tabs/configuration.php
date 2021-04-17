<?php $config = $this->getTableRow(); ?>

<div class="container border mt-5" style="padding:10px 90px; width:60%">
<h3 class="text-center m-5 ">Add/Update Configuration Details</h3>
<form action="<?php echo $this->getUrl('save');?>" method="post">
<div class="form-group">
                <div class="row">

                    <div class="col-6">
                        <label class="control-label">Group Id</label>
                        <input class="form-control" type="text" name="config[groupId]" value="<?php echo $config->groupId; ?>"> 
                    </div>
                    <div class="col-6">
                        <label class="control-label  ">Title</label>
                        <input class="form-control" type="text" name="config[title]" value="<?php echo $config->title; ?>">
                    </div>
                    <div class="col-6">
                        <label class="control-label  ">Code</label>
                        <input class="form-control" type="text" name="config[code]" value="<?php echo $config->code; ?>">
                    </div>

                    <div class="col-6">
                        <label class="control-label  ">Value</label>
                        <input class="form-control" type="text" name="config[value]" value="<?php echo $config->value; ?>"> 
                    </div>
                
                </div>
                <input class="btn btn-success mt-5 font-weight-bold" style="padding:5px 30px" type="submit" value="Save" >

            </div>
</form>
</div>

<?php $data = $this->getConfigs(); ?>

<h3 class="text-center mt-5">Configuration</h3>
    <div class="container-fluid" style="margin-left:10% ;margin-bottom:20px"><a href="<?php echo $this->geturl('edit','admin\configuration\config'); ?>" class="btn btn-success font-weight-bold"><i class="fa fa-sm fa-plus"></i> Add </a></div>
    <div class="container-fluid text-center d-flex justify-content-center ">

    <table class="table table-bordered" style="width:80%">
        <tr class="bg-dark text-white">
                <th>Config_Id</th>
                <th>Group_Id</th>
                <th>Title</th>
                <th>Code</th>
                <th>Value</th>
                <th>Created Date</th>
                <th>Action</th>
        </tr>
  
    <?php if(!$data): ?>
        <tr>
            <td colspan="9" class="text-center font-weight-bold">Record Not Found!</td>
        </tr>
                
    <?php else :
        foreach ($data->getData() as $val) {?>
        <tr>  
            <td><?php echo $val->configId; ?></td>
            <td><?php echo $val->groupId; ?></td>
            <td><?php echo $val->title; ?></td>
            <td><?php echo $val->code; ?></td>
            <td><?php echo $val->value; ?></td>
            <td><?php echo $val->createdDate; ?></td>

            <td><a href='<?php echo $this->getUrl('edit', 'admin\configuration\config', ['id' => $val->configId]) ?>' class="btn btn-info btn-sm">Edit</a>
            <a href='<?php echo $this->getUrl('delete', 'admin\configuration\config', ['id' => $val->configId]) ?>' class="btn btn-danger btn-sm">Delete</a></td>
        </tr>
    
    <?php } endif; ?>
    </table>    
</div>
</div>