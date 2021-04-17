<?php  $row = $this->getAdmins(); ?>

<div class="container">
   <div id="main-content">
       <h2 align="center" class="display-5">Admin List</h2>
       <a href="<?php echo $this-> getUrl('adminUpdate') ?>" class="btn btn-info" role="button">Add Admin</a>
       <a href="<?php echo $this-> getUrl('grid') ?>" class="btn btn-info" role="button">Apply Filter</a><br><br>

       <div class="table_data">
           <table cellpadding="10px" align="center" width="100%" class="table table-striped table-hover">
               <thead align="center">
                   <th>Id</th>
                   <th>Name</th>
                   <th>Password</th>
                   <th>Status</th>
                   <th>Created Date</th>
                   <th>Updated Date</th>
                   <th colspan="2">Action</th>
               </thead>
               
               <tbody align="center">
                    <tr>
                        <td><input type="text" name="filter[Id]" size="10"></td>
                        <td><input type="text" name="filter[Name]" size="10"></td>
                        <td><input type="text" name="filter[Password]" size="10"></td>
                        <td><input type="text" name="filter[Status]" size="10"></td>
                        <td><input type="text" name="filter[createdDate]" size="10"></td>
                        <td><input type="text" name="filter[updatedDate]" size="10"></td>
                        <td colspan="2"></td>
                    </tr>
               <?php if(!$row): ?>
                    <tr>
                        <td colspan="7">Data not Found!!!</td>
                    </tr>
                <?php else : ?> 
                <?php
                    foreach ($row->getData() as $value) {
                ?>
               
                   <tr>

                       <td><?php echo $value->adminId; ?></td>
                       <td><?php echo $value->name; ?></td>
                       <td><?php echo $value->password; ?></td>
                       <td><?php echo $value->status; ?></td>
                       <td><?php echo $value->createdDate; ?></td>
                       <td><?php echo $value->updatedDate; ?></td>
                       <td><a href='<?php echo $this->getUrl('adminUpdate', null, ['id' => $value->adminId]) ?>' class="btn btn-success" role="button">Update</a></td>      
                        <td><a href='<?php echo $this->getUrl('adminDelete', null, ['id' => $value->adminId]) ?>' class="btn btn-danger" role="button">Delete</a></td>
                   </tr>
               <?php } endif; ?>
               </tbody>
           </table>

       </div>
   </div>
</div>
