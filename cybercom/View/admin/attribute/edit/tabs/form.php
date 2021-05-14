<?php $attribute = $this->getTableRow();?>

<div class="container">
<div class="form-group">
	<label>Entity Type</label>
	<select name="attribute[entityTypeId]" class="form-control">
		<?php foreach($attribute->getEntityType() as $key => $option):?>
		<option value="<?php echo $key?>" <?php if($attribute->entityTypeId == $key):
		?>selected <?php endif;?>><?php echo $option; ?></option>
	<?php endforeach;?>
	</select>
</div>

<div class="form-group">
	<label>Name</label>
	<input type="text" name="attribute[name]" class="form-control" value="<?php echo $attribute->name; ?>">
</div>
<div class="form-group">
	<label>Code</label>
	<input type="text" name="attribute[code]" class="form-control" value="<?php echo $attribute->name; ?>">
</div>
<div class="form-group">
	<label>Backend Type</label>
	<select name="attribute[backendType]" class="form-control">
		<?php foreach($attribute->getBackendTypeOptions() as $key => $option):?>
		<option value="<?php echo $key?>"<?php if ($attribute->backendType == $key) :
		?>selected <?php endif;?>><?php echo $option; ?></option>
	<?php endforeach;?>
	</select>
</div>
<div class="form-group">
	<label>Input Type</label>
	<select name="attribute[inputType]" class="form-control">
		<?php foreach($attribute->getInputTypeOptions() as $key => $option):?>
		<option value="<?php echo $key?>" <?php if ($attribute->inputType == $key) :
		?>selected <?php endif;?>><?php echo $option; ?></option>
	<?php endforeach;?>
	</select>
</div>
<div class="form-group">
	<label>Sort Order</label>
	<input type="text" name="attribute[sortOrder]" class="form-control" value="<?php echo $attribute->sortOrder; ?>">
</div>
<div class="form-group">
	<label>Backend Model</label>
	<input type="text" name="attribute[backendModel]" class="form-control" value="<?php echo $attribute->backendModel; ?>">
</div>
<div class="form-group">
	<button type="button" name="save" class="btn btn-success" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save','admin_attribute');?>').resetParam().setParams($('#editForm').serializeArray()).load();">Save</button>
</div>
</div>