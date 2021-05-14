<?php 

$product = $this->getTableRow();

$group = $this->getCustomerGroup();

?>

<button type="button" class="btn btn-success" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save','admin_product_groupPrice');?>').resetParam().setParams($('#editForm').serializeArray()).setMethod('POST').load();">Update</button>

<table class="table">
	<thead>
		<tr>
			<th>Group Id</th>
			<th>Group Name</th>
			<th>Price(in Rs.)</th>
			<th>Group Price(in Rs.)</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($group->getData() as $key => $group):?>
		<tr>
			<?php $rowStatus = ($group->entityId) ? "exist" : "new";?>
			<td><?php echo $group->groupId;?></td>
			<td><?php echo $group->name;?></td>
			<td><?php echo $group->price;?></td>
			<td><?php ?><input type="text" name="groupPrice[<?php echo $rowStatus; ?>][<?php echo $group->groupId; ?>]" value="<?php echo $group->groupPrice?>"></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
</form>