<?php $options = $this->getTableRow()->getOptions(); ?>

<form action="" method="post">
<table class="table" id="existingTable">
	<thead>
		<th>Option Name</th>
		<th>Sort Order</th>
		<th>Action</th>
	</thead>
	<tbody>
		<?php if(!$options): ?>
		<tr><td></td></tr>	
		<?php else: ?>	
		<?php foreach($options->getData() as $key => $option): ?>
		<tr>
			<td><input type="text" name="exist[<?php echo $option->optionId ?>][name]" value="<?php echo $option->name;?>" class="form-control"></td>
			<td><input type="text" name="exist[<?php echo $option->optionId ?>][sortOrder]" value="<?php echo $option->sortOrder;?>" class="form-control"></td>
			<td><button type="button" name="removeOption" class="btn btn-danger"  onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete','admin_attribute_option',['optionId'=>$option->optionId]);?>').resetParam().setParams($('#editForm').serializeArray()).load();">Remove</button></td>
		</tr>
		<?php endforeach;?>
	<?php endif; ?>
	</tbody>
	<tfoot>
		<td><button type="button" class="btn btn-success" id="addNewRow" onclick="//addRow();">Add</button>
			&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-success" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('save','admin_attribute_option');?>').resetParam().setParams($('#editForm').serializeArray()).load();">Update</button></td>
		<td></td><td></td>
	</tfoot>
</table>
<!-- <div style="display: none;">
<table id="newTable">
	<tbody>
		<tr> <td>
			<input type="text" name="new[name][]" class="form-control"></td> 
			<td><input type="text" name="new[sortOrder][]" class="form-control"></td> <td><input type="button" name="removeOption" value="Remove" class="btn btn-danger" onclick="removeRow(this)"></td>
		</tr>
	</tbody>
</table>
</div> -->
</form>

<script type="text/javascript">
	function removeRow(button) {
		 $(button).closest('tr').remove();
		 
	}

	/*function addRow() {
		var newTable = document.getElementById('newTable');
		var existingTable = document.getElementById('existingTable').children[0];
		existingTable.append(newTable.children[0].children[0].cloneNode(true));
	}*/

	$('#addNewRow').click(function () {
			$('#existingTable').append('<tr> <td><input type="text" name="new[name][]" class="form-control"></td> <td><input type="text" name="new[sortOrder][]" class="form-control"></td> <td><input type="button" name="removeOption" value="Remove" class="btn btn-danger" onclick="removeRow(this)"></td></tr>');
	});



</script>