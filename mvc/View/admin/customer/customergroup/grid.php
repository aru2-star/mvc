<?php

$customerGroup = $this->getCustomerGroup();

?>
<div class="container mx-auto m-5">
	<section>
		  <div class="container">
        		<h4 class="text-muted text-weight-bold">Customer Groups</h4>
				<hr><a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_customer_customerGroup',null,true);?>').resetParam().load();"class="btn btn-success" >Add Customer Group</a>
		<br>
		<table class="table">
			<thead>
				<tr>
					<th>Group Id</th>
					<th>Group Name</th>
					<th>Default</th>
					<th>Created At</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
                    <?php if (!$customerGroup): ?>
                    <tr>
                        <td>No records Found</td>
                    </tr> 
                    <?php else: ?>
						<?php foreach ($customerGroup->getData() as $key => $value): ?>
						 <tr>
						 	<td><?php echo $value->groupId; ?></td>
						 	<td><?php echo $value->name; ?></td>
						 	<td><?php echo $this->geTDefaultType($value) ?></td>
						 	<td><?php echo $value->createdAt; ?></td>
						 	<td><button class='btn-warning'onclick ="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_customer_customerGroup',['groupId'=>$value->groupId],true);?>').resetParam().load();"><i class='far fa-edit'></i></button>
						 		&nbsp;&nbsp;
						 		 <button class='btn-danger'onclick ="object.setUrl('<?php echo $this->getUrl()->getUrl('delete','admin_customer_customerGroup',['groupId'=>$value->groupId],true);?>').resetParam().load();"><i class='fas fa-trash-alt'></i></button>
						 	</td>
						 </tr>
						<?php endforeach;?>
					<?php endif;?>
			</tbody>
		</table>
	</div>
	</section>
</div>