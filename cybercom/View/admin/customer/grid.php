<?php

$customers = $this->getCustomers();
?>
<div class="container mx-auto m-5">
		<section>
		   <div class="container">
        		<h4 class="text-muted text-weight-bold">Customers</h4>
				<hr><a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_customer',null,true);?>').resetParam().load();" class="btn btn-success" >Add Customer</a>
			<br>
			<table class="table">
				<thead>
					<tr>
						<th>Id</th>
						<th>Group</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Mobile</th>
						<th>Zipcode</th>
						<th>Status</th>
						<th>Created At</th>
						<th>Updated At</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                    <?php if (!$customers): ?>
                    <tr>
                        <td>No records Found</td>
                    </tr> 
                    <?php else: ?>
						<?php foreach ($customers->getData() as $key => $value): ?>
						 <tr>
						 	<td><?php echo $value->customerId; ?></td>
						 	<td><?php echo $this->getCustomerGroups($value); ?></td>
						 	<td><?php echo $value->fname; ?></td>
						 	<td><?php echo $value->lname; ?></td>
						 	<td><?php echo $value->email; ?></td>
						 	<td><?php echo $value->mobile; ?></td>
						 	<td><?php echo $this->getBillingAddress($value)?></td>
						 	<td><?php echo $this->getStatusName($value); ?></td>
						 	<td><?php echo $value->createdAt; ?></td>
						 	<td><?php echo $value->updatedAt; ?></td>
						 	<td><button class='btn-primary'onclick ="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_customer',['customerId'=>$value->customerId],true);?>').resetParam().load();"><i class='far fa-edit'></i></button>
						 		&nbsp;&nbsp;
						 		 <button class='btn-danger'onclick ="object.setUrl('<?php echo $this->getUrl()->getUrl('delete','admin_customer',['customerId'=>$value->customerId],true);?>').resetParam().load();"><i class='fas fa-trash-alt'></i></button>
						 	</td>
						 </tr>
						<?php endforeach;?>
					<?php endif;?>
				</tbody>
		</table>
	</div>
</section>
</div>