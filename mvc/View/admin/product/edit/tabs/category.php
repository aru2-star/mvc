<?php 
$categories = $this->getCategories();
?>
<?php 
$productCategories = $this->getSelectedCategories();
?>

<div class="container">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Category Name</th>
			</tr>
		</thead>
		<tbody>
			<?php if(!$categories):?>
				<tr>
					<td>No Category Available</td>
				</tr>
			<?php else: ?>
				<tr>
					<td>
				<select name="productCategory[]" multiple>
			<?php foreach ($categories as $id => $category) : ?>	
				
					<option value="<?php echo $id;?>"><?php echo $category; ?></option>
				
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