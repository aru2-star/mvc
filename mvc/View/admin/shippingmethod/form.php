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
            <h4 class="text-muted text-weight-bold">Add Shipping Methods</h4>           
            <form method='POST' action="<?php echo $this->getUrl('save')?>">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="shippingmethod[name]" placeholder="Enter Shipping Method name" required="">
                </div>
                <div class="form-group">
                    <label for="code">Code:</label>
                    <input type="text" class="form-control" name="shippingmethod[code]" placeholder="Enter Shipping Method Code" required="">
                </div>
                <div class="form-group">
                    <label for="amount">Amount:</label>
                    <input type="number" class="form-control" name="shippingmethod[amount]" placeholder="Enter Shipping Method Amount" required="">
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" class="form-control" name="shippingmethod[description]" placeholder="Enter Shipping Method description" required="">
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                      <select name="shippingmethod[status]" id="status" class="form-control">
                        <option value="enable">Enable</option>
                     <option value="disable">Disable</option>
                 </select>
                </div>
                 <div class="form-group">
                    <input type="submit" class="btn btn-success" name="save"  id="save" value="Save"> 
                    <button type="button" class="btn btn-danger" >Close</button>
                 </div>
            </form>
        </section>
        </div>
    </body>
</html>