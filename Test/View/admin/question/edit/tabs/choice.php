<?php $choices = $this->getTableRow()->getChoices(); ?>

<div class="container">
	<button type="button" class="btn btn-success" id="addNewRow">Add</button>
</div>

<script type="text/javascript">
	function removeRow(button) {
		 $(button).closest('tr').remove();
		 
	}
	
	$('#addNewRow').click(function () {
			$('#existingTable').append('<tr> <td><input type="text" name="new[name][]" class="form-control"></td> <td><input type="text" name="new[sortOrder][]" class="form-control"></td> <td><input type="button" name="removeOption" value="Remove" class="btn btn-danger" onclick="removeRow(this)"></td></tr>');
	});