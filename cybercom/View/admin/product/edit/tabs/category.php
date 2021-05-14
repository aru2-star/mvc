<?php $categories = $this->getCategories();?>
<?php $productCategories = $this->getSelectedCategories();?>

<div class="container">
	<table class="table">
		<thead>
			<tr>
				<th>Category Name</th>
			</tr>
		</thead>
		<tbody>
			<?php if(!$categories):?>
				<tr>
					<td>No categories Available</td>
				</tr>
			<?php else: ?>
				<tr>
					<td>
				<select name="productCategory[]" multiple>
			<?php foreach ($categories as $id => $category) : ?>	
				
					<option value="<?php echo $id;?>"><?php echo $category; ?></option>
					<!-- <td><input type="checkbox" name="productCategory[]" value="<?php //echo $id;?>" class="form-control" ></td>
					<td><?php //echo $category; ?></td> -->
				
			<?php endforeach; ?>
			</td>
				</tr>
			</select>
			<?php endif; ?>	
		
			<tr>
				<td><button type="button" class="btn btn-success" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('productCategory','admin_product');?>').resetParam().setParams($('#editForm').serializeArray()).setMethod('POST').load();">Save</button></td>
			</tr>
		</tbody>
	</table>
</div>