<?php
include 'mainHeader.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <div class="container m-5">
        <section>
            <div class="container">
            <h4 class="text-muted text-weight-bold">Add Customer</h4>
            <form action="<?php echo $this->getUrl('save')?>" method="post">
                                <div class="form-group">
                                    <label>ID</label>
                                    <input type="text" name="cust_id" id="cust_id" class="form-control" placeholder="auto" disabled>
                                </div>
                    
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="customer[fname]" id="cust_fname" class="form-control" placeholder="Enter Your Firstname">
                                </div>

                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="customer[lname]" id="cust_lname" class="form-control" placeholder="Enter Your Lastname">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="customer[email]" id="cust_email" class="form-control" placeholder="Enter Your Email">   
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="customer[password]" id="cust_password" class="form-control" placeholder="Enter Your Password">   
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="cust_cpassword" id="cust_cpassword" class="form-control" placeholder="Re-enter Password">   
                                </div>
                                
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="customer[status]" id="cstatus" class="form-control">
                                        <option value="enable">Enable</option>
                                        <option value="disable">Disable</option> 
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Mobile </label>
                                    <input type="text" name="customer[mobile]" id="cust_mobile" class="form-control" placeholder="Enter Your Mobile Number">
                                </div>
                                
                                <div class="form-group">
                            <input type="submit" class="btn btn-success" name="save"  id="save" value="Save">
                        </div>
                        </div>
                </form>
            </div>
        </section>
    </div>
</body>
</html>