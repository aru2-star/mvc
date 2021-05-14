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
            <h4 class="text-muted text-weight-bold">Add Product</h4>
            <form action="<?php echo $this->getUrl('save'); ?>" method="post">
                    <div class="form-group">
                                    <label>ID</label>
                                    <input type="text" name="pid" id="pid" class="form-control" placeholder="auto" disabled>
                                </div>
                    
                    <div class="form-group">
                                    <label>sku</label>
                                    <input type="text" name="product[sku]" id="psku" class="form-control" placeholder="Product sku">
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="product[name]" id="pname" class="form-control" placeholder="Enter Product Name">
                                    
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" name="product[price]" id="pprice" class="form-control" placeholder="Enter Product Price">
                                    
                                </div>
                                <div class="form-group">
                                    <label>Discount</label>
                                    <input type="text" name="product[discount]" id="pdiscount" class="form-control" placeholder="Enter prdocut discount">
                                   
                                </div>
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="text" name="product[quantity]" id="pquantity" class="form-control" placeholder="Enter product qunatity">
                                    
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" name="product[description]" id="pdesc" class="form-control" placeholder="Enter product Description">
                                </div>
                                <div class="form-group">
                                    <select name="product[status]" id="pstatus" class="form-control">
                                        <option value="enable">Enable</option>
                                        <option value="disable">Disbale</option> 
                                    </select>  
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