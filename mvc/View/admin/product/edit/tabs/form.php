<?php
$product = $this->getTableRow();
$option = $product->getStatusOption();
?>

<h2 align="right" class="display-4">Add/Update Product</h2>
<form method="post" action="<?php echo $this->getUrl('save'); ?>">
<div style="margin-left: 100px;" align="center" class="row">
    <div class="col-md-6">
            
            <label for="sku" class="form-label">SKU</label><br>
            <input type="text" class="form-control"  name="product[sku]" value="<?php echo $product->sku; ?>">

            <label for="name" class="form-label">Name</label><br>
            <input type="text" class="form-control"  name="product[name]" value="<?php echo $product->name; ?>">

            <label for="price" class="form-label">Price</label><br>
            <input type="text" class="form-control"  name="product[price]" value="<?php echo $product->price ; ?>">

            <label for="description" class="form-label">Description</label><br> 
            <textarea class="form-control" id="description" name="product[description]" rows="3"
                value="<?php echo $product->description; ?>"><?php echo $product->description; ?></textarea>
        </div>

        <div class="col-md-6">
            <label for="discount" class="form-label">Discount</label><br>
            <input type="text" class="form-control"  name="product[discount]"
                value="<?php echo $product->discount; ?>">

            <label for="Quantity" class="form-label">Quantity</label> <br>
            <input type="text" class="form-control" name="product[quantity]"
                value="<?php echo $product->quantity ; ?>">

                <label for="status" class="form-label">Status</label><br>
                <select name="product[status]">
                <?php foreach($option as $key=>$value){ ?>
                    <option value="<?php echo $key; ?>" <?php if($product->status == $key){echo "selected";} ?> ><?php echo $value; ?></option>
                <?php } ?>
                </select><br><br><br><br>
            <button type="submit" class="btn btn-success" value="submit">Submit</button>


        </div>
    </div>
</form>
