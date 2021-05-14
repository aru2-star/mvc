<?php
$attributeData = $this->getAttribute();
?>
<div class="container mx-auto m-5">
		
		<section>
			   <div class="container">
         			<h4 class="text-muted text-weight-bold">Attribute</h4>
					<hr><a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_attribute',null,true);?>').resetParam().load();" class="btn btn-success" >Add Attribute</a>
				
				<br>
				<table class="table">
					<thead>
						<tr>
						<th>Attrbiute Id</th>
						<th>EntityType Id</th>
						<th>Name</th>
						<th>Code</th>
						<th>Input Type</th>
						<th>Backend Type</th>
						<th>Sort Order</th>
						<th>Backend Model</th>
						<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (!$attributeData) :?>
						<tr>
						 	<td>No records found</td>
						 </tr>
						<?php else :?>	
						<?php foreach ($attributeData->getData() as $key => $attribute) :?>
						 <tr>
						 	<td><?php echo $attribute->attributeId; ?></td>
						 	<td><?php echo $attribute->entityTypeId; ?></td>
						 	<td><?php echo $attribute->name; ?></td>
						 	<td><?php echo $attribute->code; ?></td>
						 	<td><?php echo $attribute->inputType; ?></td>
						 	<td><?php echo $attribute->backendType; ?></td>
						 	<td><?php echo $attribute->sortOrder; ?></td>
						 	<td><?php echo $attribute->backendModel; ?></td>
						 	
						 	<td><button type="button" class='btn-warning' onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_attribute',['attributeId'=>$attribute->attributeId],true);?>').resetParam().load();"><i class='far fa-edit'></i></button>&nbsp;&nbsp;<button type="button" class='btn-danger' onclick ="object.setUrl('<?php echo $this->getUrl()->getUrl('delete','admin_attribute',['attributeId'=>$attribute->attributeId],true); ?>').resetParam().load();"><i class='fas fa-trash-alt'></i></button>
						 	</td>
						 </tr>
						<?php endforeach; ?>
					<?php endif; ?>
			</tbody>
			</table>
		</div>
	</section>
</div>