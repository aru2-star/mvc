<?php

$categories = $this->getCategories();

?>
<div class="container mx-auto m-5">
	<section>
	   <div class="container">
 			<h4 class="text-muted text-weight-bold">Category</h4>
			<hr><a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_category',null,true);?>').resetParam().load();" class="btn btn-success">Add Category</a>
		<br>
		<table class="table hover">
			<thead>
				<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Status</th>
				<!--<th>Featured</th>
				<th>CreatedAt</th>-->
				<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if (!$categories):  ?>
				<tr>
				<td>No records Found</td>
				</tr>
				<?php else: ?>	
				<?php foreach ($categories->getData() as $category) :?>
				 <tr>
				 	<td><?php echo $category->categoryId; ?></td>
				 	<td> <?php echo $this->getName($category);?></td>
				 	<td><?php echo $this->getStatusName($category)?> </td>
					<?php /*<td><?php echo $this->getFeatureName($category)?></td>
				 	<td><?php echo $category->createdAt; ?></td>*/?>
				 	<td><a onclick ="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_category',['categoryId'=>$category->categoryId],true);?>').resetParam().load();" ><button class='btn-warning'><i class='far fa-edit'></i></button></a>&nbsp;&nbsp;
				 		
				 		<button class='btn-danger' onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete','admin_category',['categoryId'=>$category->categoryId]); ?>').resetParam().load()"><i class='fas fa-trash-alt'></i></button></a>
			 	</td>
			 	</tr>
				<?php endforeach; ?>
				<?php endif;?>
			</tbody>
		</table>
	</div>

</section>
</div>
