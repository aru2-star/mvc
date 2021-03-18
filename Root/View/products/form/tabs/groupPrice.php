<?php

echo "<pre>";
$product = $this->getProduct();
$customerGroups = $this->getCustomerGroup();
print_r($customerGroups);
?>
<form method="POST" action="<?php $this->getUrl('save'); ?>">
	<button type="submit">UPDATE</button>
<table border="1px" width="100%">
	<tr>
		<td>Group Id</td>
		<td>Group Name</td>
		<td>Price</td>
		<td>Group Price</td>
	</tr>
	<tr>
		<?php foreach ($customerGroups->getData() as $key => $value):?>
			<?php $rowStatus = ($value->entityId)?'exist':'new'; ?>
			<td><?php echo $value->groupId ?></td>
			<td><?php echo $value->name ?></td>
			<td><?php echo $value->price ?></td>
			<td><?php //echo $value->createdDate ?><input type="text" name="groupPrice[<?php echo $rowStatus; ?>][<?php echo $value->groupId ?>]" value="<?php echo $value->groupPrice ?>"></td>
	</tr>
		<?php endforeach; ?>
</table>
</form>