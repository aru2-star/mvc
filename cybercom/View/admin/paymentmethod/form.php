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
        <h4 class="text-muted text-weight-bold">Add Payment Method</h4>
             <form method='POST' action="<?php echo $this->getUrl('save')?>">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="paymentmethod[name]" placeholder="Enter Payment Method name" required="">
                </div>
                <div class="form-group">
                    <label for="code">Code:</label>
                    <input type="text" class="form-control" name="paymentmethod[code]" placeholder="Enter Payment Method Code" required="">
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" class="form-control" name="paymentmethod[description]" placeholder="Enter Payment Method description" required="">
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select name="paymentmethod[status]" id="status" class="form-control">
                          <option value="enable">Enable</option>
                          <option value="disable">Disable</option> 
                     </select>
                </div>
                
                <div class="form-group">
                            <input type="submit" class="btn btn-success" name="save"  id="save" value="Save">
                 </div>
            </form>
        </section>
        </div>
    </body>
</html>