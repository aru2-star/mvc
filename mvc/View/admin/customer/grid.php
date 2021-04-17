<?php
$customers = $this->getCustomers();
?>

<div style="margin-left: 1px;" class="container">
   <div id="main-content">
       <h2 align="center" class="display-5">Customer List</h2>
       
       <a href="<?php echo $this->getUrl('customerUpdate'); ?>" class="btn btn-primary" role="button">Add Customer</a><br><br>
       <div class="table_data">
           <table cellpadding="10px" align="center" width="50%" class="table table-striped table-hover">
               <thead align="center">
                    <th>Id</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Group Id</th>
                    <th>Password</th>
                    <th>Status</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zipcode</th>
                    <th>Country</th>
                    <th>Address Type</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th colspan="2">Action</th>
                </thead>
                <tbody align="center">

                    <?php
                            $row = $this->getCustomers();
                            foreach ($row as $value) {
                    ?>

                   <tr>

                        <td><?php echo $value->customerId; ?></td>
                        <td><?php echo $value->firstname; ?></td>
                        <td><?php echo $value->lastname; ?></td>
                        <td><?php echo $value->email; ?></td>
                        <td><?php echo $value->groupId; ?></td>
                        <td><?php echo $value->password; ?></td>
                        <td><?php echo $value->status; ?></td>
                        <td><?php echo $value->address; ?></td>
                        <td><?php echo $value->city; ?></td>
                        <td><?php echo $value->state; ?></td>
                        <td><?php echo $value->zipCode; ?></td>
                        <td><?php echo $value->country; ?></td>
                        <td><?php echo $value->addressType; ?></td>
                        <td><?php echo $value->createdDate; ?></td>
                        <td><?php echo $value->updatedDate; ?></td>
                       <td><a href='<?php echo $this->getUrl('customerUpdate', null, ['id' => $value->customerId]) ?>' class="btn btn-success">Update</a></td>       
                        <td><a href='<?php echo $this->getUrl('customerDelete', null, ['id' => $value->customerId]) ?>' class="btn btn-danger">Delete</a></td>
                   </tr>
               <?php } ?>
               </tbody>
           </table>
       </div>

   </div>
</div>