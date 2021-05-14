<?php $configurationGroup = $this->getTableRow();?>

<div class="container">
<div class="form-group">
	<label>Name</label>
	<input type="text" name="configurationGroups[name]" class="form-control" value="<?php echo $configurationGroup->name; ?>">
</div>
<div class="form-group">
	<button type="button" name="save" class="btn btn-success" onclick="object.setUrl('<?php echo 
	$this->getUrl()->getUrl('save','admin_configurationGroup');?>').resetParam().setParams($('#editForm').
	serializeArray()).load();">Save</button>
</div>
</div>