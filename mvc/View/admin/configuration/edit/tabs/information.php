<?php $config = $this->getTableRow(); ?>

<div class="container border mt-5" style="padding:10px 90px; width:60%">
<h3 class="text-center m-5 ">Add/Update Configuration Group Details</h3>
<form action="<?php echo $this->getUrl('save');?>" method="post">
<div class="form-group">
                <div class="row">

                    <div class="col-6">
                        <label class="control-label  ">Name</label>
                        <input class="form-control" type="text" name="config[name]" value="<?php echo $config->name; ?>">
                    </div>
                
                </div>
                <input class="btn btn-success mt-5 font-weight-bold" style="padding:5px 30px" type="submit" value="Save" >

            </div>
</form>
</div>