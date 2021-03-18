<!-- <h1 class="display-6">This is Media</h1> -->
<!DOCTYPE html>
<html>
<head>
	<title>Product Media</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<div class="float-right mb-2 mr-2">
	<a class="btn btn-success"> href="<?php echo $this->getUrl()->getUrl('ProductMedia', 'save'); ?>"></a>
	<a class="btn btn-success"> href="<?php echo $this->getUrl()->getUrl('product', 'delete'); ?>"></a>
</div><br>
<div class="h2 text-center mb-2">
	<p>Media Details</p>
</div>
<?php $image = $this->getImage();
	if(!empty($image)): ?>
<table class="tabel table-hover">
	<thead>
		<tr class="text-center">
			<th scope="row" style="white-space: nowrap;">Image</th>
			<th>Label</th>
			<th>Small</th>
			<th>Thumb</th>
			<th>Base</th>
			<th>Gallery</th>
			<th>Remove</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($image->data as $key => $value): ?>
		<tr>
			<th scope="row" style="white-space: nowrap;"><img src="Images\Product\<?php echo $value->image; ?>"></th>
			<th><input type="text" name="img[<?php echo $value->imageId; ?>][label]" value="<?php echo $value->label ?>"></th>
			<th><input type="radio" name="img[small]" value="<?php echo $value->imageId ?>"></th>
			<th><input type="radio" name="img[thumb]" value="<?php echo $value->imageId ?>"></th>
			<th><input type="radio" name="img[base]" value="<?php echo $value->imageId ?>"></th>
			<th><input type="checkbox" name="img[<?php echo $value->imageId; ?>][gallery]" value="<?php echo $value->imageId ?>"></th>
			<th><input type="checkbox" name="img[<?php echo $value->imageId; ?>][remove]" value="<?php echo $value->imageId ?>"></th>
		</tr>
	<?php endforeach; ?>
	<?php else: ?>
		<?php echo '<p><strong>No Image Found</strong><p>'; ?>;
	<?php endif; ?>
	</tbody>
</table>
<div>
	<form action="<?php echo $this->getUrl()->getUrl('ProductMedia', 'save'); ?>">
		<div>
			<input type="file" name="image">
			<div>
				<button type="submit" name="upload">Upload</button>
			</div>
		</div>
	</form>
</div>