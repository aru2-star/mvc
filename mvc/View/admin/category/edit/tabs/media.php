<?php $media = $this->getMedia();?>
<div class="container">
	<button type="button" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('update','admin_category_media');?>').resetParam().setParams($('#editForm').serializeArray()).setMethod('POST').load();;" class="btn btn-success" >Update</button>
	<button type="button" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete','admin_category_media');?>').resetParam().setParams($('#editForm').serializeArray()).setMethod('POST').load();" class="btn btn-success">Remove</button>
	<div>
		<br>
	<table class="table">
		<thead>
				<tr>
				<th>Image</th>
				<th>Icon</th>
				<th>Base</th>
				<th>Banner</th>
				<th>Active</th>
				<th>Remove</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!$media): ?>
					<tr>
						<td>No Media Found</td>
					</tr>
				<?php else: ?>	
					
						<?php foreach ($media->getData() as $key => $value): ?>
						<tr>	
							<td><img src="<?php echo './images/category/'.$value->image;?>" height="100" width="100"></td>
							<td><input type="radio" name="icon" value="<?= $value->mediaId ?>" <?php if($value->icon== 1):?>
							<?php echo 'checked';?> <?php endif;?> ></td>
							<td><input type="radio" name="base" value="<?= $value->mediaId ?>" <?php if($value->base== 1):?>
							<?php echo 'checked';?><?php endif; ?>></td>
							<td><input type="checkbox" name="banner[<?= $value->mediaId; ?>]" <?php if($value->banner== 1):?>
							<?php echo 'checked';?>
							<?php endif;?>></td>
							<td><select name="media[active][<?= $value->mediaId; ?>]" id="admin_status" class="form-control">
    								<?php foreach($statusOption as $key => $status):?>
        								<option value="<?php echo $key;?>" <?php if ($value->active == $key) : ?> 
        								selected <?php endif;?>><?php echo $status; ?></option>
        							<?php endforeach;?>
    							</select></td>
							<td><input type="checkbox" name="remove[<?= $value->mediaId; ?>]"></td>
						</tr>
						<?php endforeach ?>
					
				<?php endif; ?>	
			</tbody>	
	</table>

	<form>
		<input type="file" name="file" id="mediaFile">
		<button type="button" class="btn btn-success" name="file" id="uploadImage" onclick="
			var form = new FormData();
			var file = $('#mediaFile')[0].files;
			form.append('file',file[0]);
			object.setUrl('<?= $this->getUrl()->getUrl('upload','admin_category_media')?>').resetParam().setParams(form).setMethod('POST').upload();
		">Upload</button>
	</form>
</div>
</div>
