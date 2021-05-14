<?php $question = $this->getTableRow();?>

<div class="container">
<div class="form-group">
	<label>Enter Question</label>
	<input type="text" name="question[question]" class="form-control" value="<?php echo $question->question; ?>">
</div>
<div class="form-group">
	<button type="button" name="save" class="btn btn-success" onclick="object.setUrl('<?php echo 
	$this->getUrl()->getUrl('save','admin_question');?>').resetParam().setParams($('#editForm').
	serializeArray()).load();">Save</button>
</div>
</div>