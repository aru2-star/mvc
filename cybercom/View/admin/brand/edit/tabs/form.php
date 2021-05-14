<?php
$brand = $this->getTableRow();
$id = $this->getRequest()->getGet('brandId');
?>
<div class="container">
<div class="form-group">
    <label>Name</label>
    <input type="text" name="brand[name]" id="brand_name" class="form-control" placeholder="Enter Brand Name" value="<?php echo $brand->name;?>">
</div>
<div class="form-group">
    <label>Sort Order</label>
    <input type="text" name="brand[sortOrder]" id="brand_sortOder" class="form-control" placeholder="Enter Sort Order" value="<?php echo $brand->sortOrder;?>">
</div>
<div class="form-group">
    <input type="file" name="file" id="file" value="<?php echo $brand->image;?>"> 
</div>
<div class="form-group">
     <label>Status</label>
    <select name="brand[status]" id="brand_status" class="form-control">
    <?php foreach($brand->getStatusOptions() as $key => $value):?>
        <option value="<?php echo $key;?>" <?php if ($brand->status == $key) : ?> 
        selected <?php endif;?>><?php echo $value; ?></option>
        <?php endforeach;?>
    </select> 
</div>
<div class="form-group">
   <button type="button" class="btn btn-success" name="save" onclick="
            var form = new FormData();
            var file = $('#file')[0].files;
            var name = $('#brand_name').val();
            var sortOrder = $('#brand_sortOder').val();
            var status = $('#brand_status').val();
            form.append('file',file[0]);
            form.append('name',name);
            form.append('sortOrder',sortOrder);
            form.append('status',status);
            object.setUrl('<?= $this->getUrl()->getUrl('save','admin_brand')?>').resetParam().setParams(form).setMethod('POST').upload();
            ">Save</button>

</div>
</div>