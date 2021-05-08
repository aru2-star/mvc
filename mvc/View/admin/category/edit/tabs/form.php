<?php
$id = $this->getRequest()->getGet('categoryId');
$categories = $this->getTableRow();
$subCategory = $this->getParentOptions();

?>

<div class="container">
<div class="form-group">
    <label>Parent Category</label>
    <select name="category[parentId]" id="upd_catparentId" class="form-control">
        <?php if($subCategory): ?>
       <?php foreach($subCategory as $categoryId => $name):?>
        <option value="<?php echo $categoryId; ?>" <?php if($categoryId == $categories->parentId):?>selected <?php endif; ?>><?php echo $name; ?></option>
  
       <?php endforeach; ?>
   <?php endif; ?>
  
    </select>
</div>

<div class="form-group mt-4">
    <label>Name</label>
    <input type="text" name="category[name]" id="upd_catname" class="form-control" placeholder="Enter Category Name" value="<?php echo $categories->name;?>">
</div>

<div class="form-group">
    <label>Featured</label>
    <select name="category[featured]" id="upd_catfeatured" class="form-control">
        <?php foreach($categories->getFeatureOptions() as $key => $value):?>
        <option value="<?php echo $key;?>" <?php if ($categories->featured == $key) : ?> 
        selected <?php endif;?>><?php echo $value; ?></option>
        <?php endforeach;?>
    </select>  
</div>

<div class="form-group">
    <label>Status</label>
    <select name="category[status]" id="upd_catstatus" class="form-control">
        <?php foreach($categories->getStatusOptions() as $key => $value){?>
        <option value="<?php echo $key;?>" <?php if ($categories->status == $key) { ?> 
        selected <?php }?>><?php echo $value; ?></option>
        <?php }?>
    </select>
</div>

<div class="form-group">
        <button type="button" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save');?>').resetParam().setParams($('#editForm').serializeArray()).setMethod('POST').load();" class="btn btn-success" name="save">Save</button>
    <button type="button" class="btn btn-danger" >Close</button>
</div>
</div>