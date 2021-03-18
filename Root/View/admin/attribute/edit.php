<?php
$attribute = $this->getAttribute();
//echo "<pre>";
//print_r($attribute->getInputTypeOption());
?>

<h1>Attribute Update</h1>
<form action="<?php echo $this->getUrl()->getUrl('attribute','add') ?>" method="POST">
	Entity Type Id:  <select name="attribute[entityTypeId]">
		<?php foreach ($attribute->getEntityTypeOption() as $key => $value): ?>
			<option value="<?php echo $key ?>"><?php echo $value ?></option>
		<?php endforeach; ?>
	</select><br><br>
	Name:  <input type="text" name="attribute[name]" value="<?php echo $attribute->name; ?>"><br><br>
	Code:  <input type="text" name="attribute[code]" value="<?php echo $attribute->code; ?>"><br><br>
	Back End Type:  <select name="attribute[inputType]">
		<?php foreach ($attribute->getBackendTypeOption() as $key => $value): ?>
			<option value="<?php echo $key ?>"><?php echo $value ?></option>
		<?php endforeach; ?>
	</select><br><br>
	Input Type:  <select name="attribute[backendType]">
		<?php foreach ($attribute->getInputTypeOption() as $key => $value): ?>
			<option value="<?php echo $key ?>"><?php echo $value ?></option>
		<?php endforeach; ?>
	</select><br><br>
	Sort Order:  <input type="text" name="attribute[sortOrder]"><br><br>
	Back End Model:  <input type="text" name="attribute[backendModel]"><br><br>

	<input type="submit" value="Save"><br><br>
</form>
