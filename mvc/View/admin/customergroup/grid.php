<?php
 $row = $this->getCustomerGroups();
 ?>
 
<div class="container">
   <div id="main-content">
       <h2 align="center" class="display-5">Customer Group List</h2>

       <a href="<?php echo $this-> getUrl('customerGroupUpdate') ?>" class="btn btn-info" role="button">Add Group</a><br><br>
       <div class="table_data">
           <table class="table table-striped table-hover" cellpadding="10px" align="center" width="70%">
               <thead align="center">
                    <th>Group_Id</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>CreatedDate</th>
                    <th colspan="2">Action</th>
               </thead>
               <tbody id="data-table" align="center">
                <?php if(!$row): ?>
                    <tr>
                        <td colspan="5">Data not Found!!!</td>
                    </tr>
                <?php else : ?> 
                <?php foreach ($row->getData() as $key => $value) { ?>

                   <tr>
                        <td><?php echo $value->groupId; ?></td>
                        <td><?php echo $value->name; ?></td>
                        <td><?php echo $value->status; ?></td>
                        <td><?php echo $value->createdDate; ?></td>

                       <td><a href='<?php echo $this->getUrl('customerGroupUpdate', null, ['id' => $value->groupId]) ?>' class="btn btn-success">Update</a></td>      
                        <td><a href='<?php echo $this->getUrl('customerGroupDelete', null, ['id' => $value->groupId]) ?>' class="btn btn-danger">Delete</a></td>
                   </tr>
               <?php } endif; ?>
               </tbody>
           </table>
       </div>       
   </div>        
</div>