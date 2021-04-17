<?php 
$row = $this->getConfigGroups();
?>

<div class="container">
   <div id="main-content">
       <h2 align="center" class="display-4">Config List</h2>
       <a href="<?php echo $this-> getUrl('config_groupUpdate') ?>" class="btn btn-info" role="button">Add Config</a><br><br>

       <div class="table_data">
           <table cellpadding="10px" align="center" width="70%" class="table table-striped table-hover">
               <thead align="center">
                   <th>Group Id</th>
                   <th>Name</th>
                   <th>CreatedDate</th>
                   <th colspan="2">Action</th>
               </thead>
               
               <tbody id="data-table" align="center">
               <?php if(!$row): ?>
                    <tr>
                        <td colspan="4">No Data Found.</td>
                    </tr>
                <?php else : ?> 
                <?php
                    foreach ($row->getData() as $value) {
                ?>
                   <tr>

                       <td><?php echo $value->groupId; ?></td>
                       <td><?php echo $value->name; ?></td>
                       <td><?php echo $value->createdDate; ?></td>
                       <td><a href='<?php echo $this->getUrl('config_groupUpdate', null, ['id' => $value->groupId]) ?>' class="btn btn-success" role="button">Update</a></td>       
                        <td><a href='<?php echo $this->getUrl('config_groupDelete', null, ['id' => $value->groupId]) ?>' class="btn btn-danger" role="button">Delete</a></td>
                   </tr>
               <?php } endif;?>
               </tbody>
           </table>

       </div>
   </div>
</div>
