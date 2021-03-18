<!-- <?php
//Mage::loadFileByClassName('Block_Category_Grid');
?> -->
<?php $categories = $this->getCategory();  ?>
<pre><?php //print_r($categories); ?></pre>

<a class="btn-btn-success"> href="<?php echo $this->getUrl('form') ?>"></a>

<table border="1" width="100%">
	<thead>
		<tr>
			<td>Id</td>
			<td>Name</td>
			<td>Parent Id</td>
			<td>Path Id</td>
		</tr>
	</thead>
	<tbody>
		<?php if (!$categories->count()): ?>
		<tr>
			<td colspan="4">No records found</td>
		</tr>
		<?php else: ?>
			<?php foreach($categories->getData as $category): ?>
				<tr>
					<td><?php echo $category->categoryId; ?></td>
					<td><?php echo $this->getName($category); ?></td>
					<td><?php echo $category->parentId; ?></td>
					<td><?php echo $category->pathId; ?></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>
