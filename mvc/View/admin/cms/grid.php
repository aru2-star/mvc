<?php

$pages = $this->getPages(); 

?>
<div class="container mx-auto m-5">
	<section>
		  <div class="container">
     			<h4 class="text-muted text-weight-bold">Cms</h4>
				<hr><a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_cms',null,true);?>').resetParam().load();" class="btn btn-success">Add Cms</a>
		<br>
		<table class="table hover">
			<thead>
					<tr>
					<th>Id</th>
					<th>Title</th>
					<th>Identifier</th>
					<th>Content</th>
					<th>Status</th>
					<th>CreatedAt</th>
					<th>Action</th>
					</tr>
			</thead>
			<tbody>
					<?php
					if (!$pages):  ?>
					<tr>
					<td>No records Found</td>
					</tr>
					<?php else: ?>	
					<?php foreach ($pages->getData() as $page) :?>
					 <tr>
					 	<td><?php echo $page->pageId; ?></td>
					 	<td><?php echo $page->title;?></td>
					 	<td><?php echo $page->identifier;?></td>
					 	<td><?php echo $page->content;?></td>
					 	<td><?php echo $this->getStatusName($page)?> </td>
						<td><?php echo $page->createdAt; ?></td>
					 	<td><a onclick ="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_cms',['pageId'=>$page->pageId],true);?>').resetParam().load();" ><button class='btn-warning'><i class='far fa-edit'></i></button></a>&nbsp;&nbsp;
					 		
					 		<button class='btn-danger' onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete','admin_cms',['pageId'=>$page->pageId]); ?>').resetParam().load()"><i class='fas fa-trash-alt'></i></button></a>
				 		</td>
				 	</tr>
					<?php endforeach; ?>
					<?php endif;?>
			</tbody>
		</table>
	</div>
</section>
</div>
