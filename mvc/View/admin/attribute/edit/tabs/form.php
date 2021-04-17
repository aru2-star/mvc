<?php 
$attribute = $this->getTableRow(); 
?>

<h2 align="center" class="display-4">Add/Update Attribute</h2>
<form action="<?php echo $this->getUrl('save', NULL, ['id' => $attribute->attributeId], true); ?>" method="POST">
    <table>
        <tr>
            <td>Entity Type Id:</td>
            <td><select name="attribute[entityTypeId]">
                    <?php foreach ($attribute->getEntityTypeOptions() as $key => $value) : ?>
                        <option value="<?php echo $key ?>"><?php echo $value ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Name:</td>
            <td><input type="text" name="attribute[name]" value="<?php echo $attribute->name; ?>"></td>
        </tr>
        <tr>
            <td>Code:</td>
            <td><input type="text" name="attribute[code]" value="<?php echo $attribute->code; ?>"></td>
        </tr>
        <tr>
            <td>Back End Type:</td>
            <td><select name="attribute[backEndType]">
                    <?php foreach ($attribute->getBackendTypeOption() as $key => $value) : ?>
                        <option value="<?php echo $key ?>"><?php echo $value ?></option>
                    <?php endforeach; ?>
                </select></td>
        </tr>
        <tr>
            <td>Input Type:</td>
            <td><select name="attribute[inputType]">
                    <?php foreach ($attribute->getInputTypeOption() as $key => $value) : ?>
                        <option value="<?php echo $key ?>"><?php echo $value ?></option>
                    <?php endforeach; ?>
                </select></td>
        </tr>
        <tr>
            <td>Sort Order:</td>
            <td><input type="text" name="attribute[sortOrder]" value="<?php echo $attribute->sortOrder; ?>"></td>
        </tr>
        <tr>
            <td>Back End Model:</td>
            <td><input type="text" name="attribute[backendModel]" value="<?php echo $attribute->backendModel; ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td><input class="btn btn-success" type="submit" value="Save"></td>
        </tr>
    </table>
</form>