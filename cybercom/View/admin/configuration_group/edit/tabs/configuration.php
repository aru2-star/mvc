<?php $configurations = $this->getTableRow()->getConfigurations(); ?>

<form action="" method="post">
<table class="table" id="existingTable">
	<thead>
		<th>Title</th>
		<th>Code</th>
		<th>Value</th>
		<th>Action</th>
	</thead>
	<tbody>
		<?php if(!$configurations): ?>
		<tr><td></td></tr>	
		<?php else: ?>	
		<?php foreach($configurations->getData() as $key => $configuration): ?>
		<tr>
			<td><input type="text" name="exist[<?php echo $configuration->configId ?>][title]" value="<?php echo $configuration->title;?>" class="form-control"></td>
			<td><input type="text" name="exist[<?php echo $configuration->configId ?>][code]" value="<?php echo $configuration->code;?>" class="form-control"></td>
			<td><input type="text" name="exist[<?php echo $configuration->configId ?>][value]" value="<?php echo $configuration->value;?>" class="form-control"></td>
			<td><button type="button" name="removeOption" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete','admin_configurationGroup_configuration',['configId'=>$configuration->configId]);?>').resetParam().setParams($('#editForm').serializeArray()).load();" value="Remove" class="btn btn-danger">Remove</button></td>
		</tr>
		<?php endforeach;?>
	<?php endif; ?>
	</tbody>
	<tfoot>
		<td><button type="button" class="btn btn-success" id="addNewRow" onclick="//addRow()">Add</button>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-success" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save','admin_configurationGroup_configuration');?>').resetParam().setParams($('#editForm').serializeArray()).load();">Update</button></td>
		<td></td><td></td>
	</tfoot>

</table>
</form>

<script type="text/javascript">
	function removeRow(button) {
		 $(button).closest('tr').remove();
		 
	}

	$('#addNewRow').click(function () {
			$('#existingTable').append('<tr> <td><input type="text" name="new[title][]" class="form-control"></td> <td><input type="text" name="new[code][]" class="form-control"></td> <td><input type="text" name="new[value][]" class="form-control"></td> <td><input type="button" name="removeOption" value="Remove" class="btn btn-danger" onclick="removeRow(this)"></td></tr>');
	});

</script>