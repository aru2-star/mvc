<?php $attributes = $this->getAttributes(); ?>
<?php  //echo "<pre>";
//print_r($attributes);
?>

<h1>Attribute Table</h1><br>
<a class="btn btn-success" href="<?php echo $this->getUrl()->getUrl(null,'form'); ?>">Add Record</a><br><br>
<table class="table table-striped table-hover">
	<thead>
		<th>Attribute Id</th>
		<th>Entity Type Id</th>
		<th>Name</th>
		<th>Code</th>
		<th>Input Type</th>
		<th>Back End Type</th>
		<th>Sort Order</th>
		<th>Back End Model</th>
		<th align="center" colspan="3">Actions</th>
	</thead>
		<?php foreach ($attributes as $key => $attribute):?>
			<tr>
				<td scope="row"><?= $attribute->attributeId ?></td>
				<td><?= $attribute->entityTypeId ?></td>
				<td><?= $attribute->name ?></td>
				<td><?= $attribute->code ?></td>
				<td><?= $attribute->inputType ?></td>
				<td><?= $attribute->backendType ?></td>
				<td><?= $attribute->sortOrder ?></td>
				<td><?= $attribute->backendModel ?></td>
				<td><a href="<?php echo $this->getUrl()->getUrl(null, 'form',['id' => $attribute->attributeId]); ?>" class="btn btn-success">Update</td>
				<td><a href="<?php echo $this->getUrl()->getUrl(null, 'delete',['id' => $attribute->attributeId]); ?>" class="btn btn-success">Delete</td>
				<td><a href="<?php echo $this->getUrl()->getUrl(null, 'options',['id' => $attribute->attributeId]); ?>" class="btn btn-success">Options</td>
			</tr>
		<?php endforeach; ?>
</table>
