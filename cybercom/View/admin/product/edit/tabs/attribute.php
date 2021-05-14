<?php $attributes = $this->getProductAttribute()->getData();?>
<?php $options = $this->getAttributeOptions(); ?>
<?php $id = $this->getRequest()->getGet('productId'); ?>
<?php $product = $this->getTableRow();?>

<div class="container">
<h4 class="text-muted text-weight-bold">Product Attribute:</h4>

<?php foreach ($attributes as $attribute): ?>
<div class="form-group">
		<label><?php echo $attribute->name;?></label>
		<?php if ($attribute->inputType == "select"): ?>
			<select name="product[<?= $attribute->code; ?>]" class="form-control">
				<?php foreach ($options->getData() as $option): ?>
					<?php if($option->attributeId == $attribute->attributeId):?>
					<option value="<?= $option->optionId; ?>" <?php $code = $attribute->code; if($option->optionId == $product->$code): ?> selected <?php endif; ?>><?= $option->name; ?></option>
					
					<?php endif; ?>
				<?php endforeach; ?>
			</select>
	</div>
	<div>
	<?php elseif($attribute->inputType == "radio"): ?>
		<?php foreach ($options->getData() as $option): ?>
				<?php if($option->attributeId == $attribute->attributeId):?>
					<input type="radio" class="form-control" id="<?= $attribute->code ?>" name="product[<?= $attribute->code ?>]" value="<?php $code = $attribute->code; echo $product->$code; ?>">
				<?php endif; ?>
		<?php endforeach; ?>
	</div>
	<div>
	<?php elseif ($attribute->inputType == "checkbox") :?>
		<?php foreach ($options->getData() as $option): ?>
				<?php if($option->attributeId == $attribute->attributeId):?>
					<td><input type="checkbox" class="form-control" id="<?= $attribute->code ?>" name="product[<?= $attribute->code ?>]" value="<?php $code = $attribute->code; echo $product->$code; ?>"></td>
				<?php endif; ?>
		<?php endforeach; ?>
	</div>
	<div>
	<?php elseif ($attribute->inputType == "text") :?>
		<?php foreach ($options->getData() as $option): ?>
				<?php if($option->attributeId == $attribute->attributeId):?>
					<td><input type="text" class="form-control" id="<?= $attribute->code ?>" name="product[<?= $attribute->code ?>]" value="<?php $code = $attribute->code; echo $product->$code; ?>"></td>
				<?php endif; ?>
		<?php endforeach; ?>
	</div>
	<div>
		<?php elseif ($attribute->inputType == "textarea") :?>
		<?php foreach ($options->getData() as $option): ?>
				<?php if($option->attributeId == $attribute->attributeId):?>
					<td><textarea class="form-control" id="<?= $attribute->code ?>" name="product[<?= $attribute->code ?>]"><?php $code = $attribute->code; echo $product->$code; ?></textarea></td>
				<?php endif; ?>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
<?php endforeach ?>

<div class="form-group">
<button type="button" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save','admin_product',['productId'=>$id]); ?>').resetParam().setParams($('#editForm').serializeArray()).setMethod('POST').load();" name="save" class="btn btn-success">Save</button>
</div>
</div>