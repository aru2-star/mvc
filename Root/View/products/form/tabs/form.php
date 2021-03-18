<?php
$product = $this->getProduct();
?>

<h1 class="display-6"> Create/Update Product </h1>


<div class="col-md-6">
    <label for="name" class="form-label">Name</label>
    <input type="text" name="product[name]" value="<?= $product->name  ?>" class="form-control">
</div>
<div class="col-md-6">
    <label for="price" class="form-label">Price</label>
    <input type="number" name="product[price]" value="<?= $product->price ?>" class="form-control">
</div>
<div class="col-12">
    <label for="discount" class="form-label">Discount</label>
    <input type="number" name="product[discount]" value="<?= $product->discount  ?>" class="form-control" id="discount">
</div>
<div class="col-12">
    <label for="quantity" class="form-label">Quantity</label>
    <input type="number" name="product[quantity]" value="<?= $product->quantity ?>" class="form-control" id="quantity">
</div>
<div class="col-md-6">
    <label for="description" class="form-label">Description</label>
    <input type="text" name="product[description]" value="<?= $product->description ?>" class="form-control" id="description">
</div>
<div class="col-md-4">
    <label for="status" class="form-label">Status</label>
    <select id="status" name="product[status]" class="form-select">
        <?php foreach ($product->getStatusOptions() as $key => $value) : ?>
            <option value="<?= $key ?>" <?php if ($product->status == $key) : ?> selected <?php endif ?>> <?= $value ?> </option>
        <?php endforeach ?>
    </select>
</div>

<div class="col-12">
    <button type="submit" class="btn btn-primary">
        Add
    </button>
</div>