<?php 
$attributes = $this->getAttribute(); 
?>
<div class="container">
    <h2 align="center" class="display-5">Attributes List</h2>
    <a class="btn btn-primary" href="<?php echo $this->getUrl('attributeUpdate') ?>">Add Attribute</a><br><br>
    <table cellpadding="10px" align="center" width="70%" class="table table-striped table-hover">
        <tr align="center">
            <th>Attribute Id</th>
            <th>Entity Type Id</th>
            <th>Name</th>
            <th>Code</th>
            <th>Back End Type</th>
            <th>Input Type</th>
            <th>Sort Order</th>
            <th>Back End Model</th>
            <th colspan='2'>Action</th>
        </tr>
        <tr>
        <?php if($this->columns): ?>
            <?php foreach($columns as $key => $column): ?>
                <td>
                    <input type="text" name="filter[<?php echo $column['type'];?>][<?php echo $column['field'];?>]">
                </td>
            <?php endforeach; ?>
        <?php endif; ?>
        </tr>
        <?php if (!$attributes) : ?>
            <tr>
                <td colspan="9">No Record Found</td>
            </tr>
        <?php else : ?>
        <?php foreach ($attributes->getData() as $attribute) : ?>
                <tr>
                    <td><?php echo $attribute->attributeId; ?></td>
                    <td><?php echo $attribute->entityTypeId; ?></td>
                    <td><?php echo $attribute->name; ?></td>
                    <td><?php echo $attribute->code; ?></td>
                    <td><?php echo $attribute->backendType; ?></td>
                    <td><?php echo $attribute->inputType; ?></td>
                    <td><?php echo $attribute->sortOrder; ?></td>
                    <td><?php echo $attribute->backendModel; ?></td>
                    <td><a href="<?php echo $this->getUrl('attributeUpdate', NULL, ['id' => $attribute->attributeId]); ?>" class="btn btn-success" style="margin: 7px">Update</a></td>
                    <td><a href="<?php echo $this->getUrl('attributeDelete', NULL, ['id' => $attribute->attributeId]); ?>" class="btn btn-danger" style="margin: 7px">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>
</body>