<?php $pages = $this->getTableRow();?>

<div class="container">
<div class="form-group">
	<label>Title</label>
	<input type="text" name="page[title]" class="form-control" value="<?php echo $pages->title?>">
</div>

<div class="form-group">
	<label>Identifier</label>
	<input type="text" name="page[identifier]" class="form-control" value="<?php echo $pages->identifier?>">
</div>

<div class="form-group">
	<label>Content</label>
	<textarea name="page[content]" id="content" class="form-control" onfocus="$('#content').summernote();" ><?php echo $pages->content ?></textarea>
</div>

<div class="form-group">
	<label>Status</label>
	<select name="page[status]" class="form-control" >
		<?php foreach($pages->getStatusOptions() as $key => $value):?>
			<option value="<?= $key; ?>" <?php if($pages->status == $key):?> selected <?php endif; ?>><?php echo $value; ?></option>
		<?php endforeach; ?>
	</select>
</div>

<div class="form-group">
	<button type="button" class="btn btn-success" onclick="object.setUrl('<?= $this->getUrl()->getUrl('save','admin_cms')?>').resetParam().setParams($('#editForm').serializeArray()).load()">Save</button>
</div>
</div>