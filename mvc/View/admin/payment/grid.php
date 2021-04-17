<?php 
$row = $this->getPayments();
?>

<div class="container">
   <div id="main-content">
       <h2 align="center" class="display-5">Payment List</h2>
       <a href="<?php echo $this-> getUrl('paymentUpdate') ?>" class="btn btn-primary" role="button">Add Payment</a><br><br>

       <div class="table_data">
           <table cellpadding="10px" align="center" width="70%" class="table table-striped table-hover">
               <thead align="center">
                   <th>Id</th>
                   <th>Name</th>
                   <th>Code</th>
                   <th>Description</th>
                   <th>Status</th>
                   <th>CreatedDate</th>
                   <th>UpdatedDate</th>
                   <th colspan="2">Action</th>
               </thead>
               
               <tbody id="data-table" align="center">
               <?php if(!$row): ?>
                    <tr>
                        <td colspan="8">No Data Found!!!</td>
                    </tr>
                <?php else : ?> 
                <?php
                    foreach ($row->getData() as $value) {
                ?>
                   <tr>

                       <td><?php echo $value->paymentId; ?></td>
                       <td><?php echo $value->name; ?></td>
                       <td><?php echo $value->code; ?></td>
                       <td><?php echo $value->description; ?></td>
                       <td><?php echo $value->status; ?></td>
                       <td><?php echo $value->createdDate; ?></td>
                       <td><?php echo $value->updatedDate; ?></td>
                       <td><a href='<?php echo $this->getUrl('paymentUpdate', null, ['id' => $value->paymentId]) ?>' class="btn btn-success" role="button">Update</a></td>       
                        <td><a href='<?php echo $this->getUrl('paymentDelete', null, ['id' => $value->paymentId]) ?>' class="btn btn-danger" role="button">Delete</a></td>
                   </tr>
               <?php } endif;?>
               </tbody>
           </table>

       </div>
   </div>
</div>