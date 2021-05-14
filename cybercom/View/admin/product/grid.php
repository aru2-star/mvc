<?php
$products= $this->getProducts();
?>
<div class="container mx-auto m-5">
		<section>
			   <div class="container">
         			<h4 class="text-muted text-weight-bold">Products</h4>
					<hr><a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_product',null,true) ?>').resetParam().load()" class="btn btn-success">Add Products</a>
				<br>	
				<table class="table">
					<thead align="center">
						<tr>
						<th>Id</th>
						<th>Name</th>
						<th>Sku</th>
						<th>Price(in Rs.)</th>
						<th>Discount</th>
						<th>Quantity</th>
						<th>Status</th>
						<th>Description</th>
						<th>Created At</th>
						<th>Updated At</th>
						<th>Action</th>
						</tr>
					</thead>
					<tbody>
                            <?php if (!$products): ?>
                               <tr>
                                   <td>No records Found</td>
                               </tr> 
                            <?php else: ?>
							<?php foreach ($products->getData() as $key => $value): ?>
							
						<tr>
						 	<td><?php echo $value->productId; ?></td>
						 	<td><?php echo $value->name; ?></td>
						 	<td><?php echo $value->sku; ?></td>
						 	<td><?php echo $value->price; ?></td>
						 	<td><?php echo $value->discount; ?></td>
						 	<td><?php echo $value->quantity; ?></td>
						 	<td><?php echo $this->getStatusName($value)?></td>
						 	<td><?php echo $value->description; ?></td>
						 	<td><?php echo $value->createdAt; ?></td>
						 	<td><?php echo $value->updatedAt; ?></td>
						 	<td>
						 		<button class='btn btn-primary'onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_product',['productId'=>$value->productId]); ?>').resetParam().load()"></button>&nbsp;&nbsp;&nbsp;&nbsp;
						 		<button class='btn btn-success'onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_cart',['cartId'=>$value->cartId]); ?>').resetParam().load()"></button>&nbsp;&nbsp;
						 		 <button class='btn-danger' onclick="object.setUrl('<?php  echo $this->getUrl()->getUrl('delete','admin_product',['productId'=>$value->productId]); ?>').resetParam().load()"><i class='fas fa-trash-alt'></i></button>

						 	</td>
						 </tr>
						 <?php endforeach; ?>
						<?php endif;?>
				</tbody>
			</table>
		</div>
	</section>
</div>
