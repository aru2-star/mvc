<?php
$product = $this->getTableRow();
$customerGroups = $this->getCustomerGroup();
?>

<h3 align="center" class="display-5">Group Price</h3><br>
<form method="POST" action="<?php echo $this->getUrl("save","Product_GroupPrice") ?>">
<button type="submit" class="btn btn-primary" style="margin-left:100px">Update</button><br><br>
    <table class="table table-bordered table-striped table-hover" style="width:100%;margin-left:100px;">
            <tr align="center">
                <th>Group Id</th>
                <th>Group Name</th>
                <th>Price</th>
                <th>Group Price</th>
            </tr>
        <?php
            foreach ($customerGroups as $key => $value ) 
        { ?>
            <?php $rowStatus = ($value->entityId) ? 'exist' : 'new'; ?>
                <tr>   
                    <td><?php echo $value->groupId; ?></td>
                    <td><?php echo $value->name; ?></td>
                    <td><?php echo $value->price; ?></td>
                    <td><input type="text" name="groupPrice[<?php echo $rowStatus; ?>][<?php echo $value->groupId;?>]" value="<?php echo $value->groupPrice ;?>"></td>
                    
                </tr>
                <?php } ?>
    </table>    
</form>