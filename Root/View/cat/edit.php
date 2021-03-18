<?php //$categories = $this->getCategory(); ?>
<!-- <?php //$category = $this->getCategory()->getData(); ?> -->
<h1>Add Category</h1>
<div>
	<form method="POST" action="<?php echo $this->getUrl()->getUrl('cat','form'); ?>">
		<table class="table table-striped table-hover">
			<tr>
				<td>Parent Id:</td>
				<td>
					<select name="category[parentId]">
						<?php foreach ($categories->getData() as $category):?>
							<option value="0"></option>
							<?php if($categories): ?>
							<option value="<?php echo $category->categoryId; ?>"><?php echo $category->name; ?></option>
						<?php endif; ?>
						<?php endforeach; ?>	
					</select>
				</td>
			</tr>
			<tr>
				<td>Name:</td>
				<td><input type="text" name="category[name]"></td>
			</tr>
			<tr>
				<td>Parent Id:</td>
				<td><input type="submit" name="submit"></td>
			</tr>
		</table>
		
	</form>
</div>
