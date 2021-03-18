<?php
$customer = $this->getCustomer();
?>

<form class="row g-3" action="<?php echo $this->getUrl()->getUrl('customer', 'add'); ?>" method="POST">


    <h1 class="display-6"> Update/Add Customer </h1>


    <div class="col-md-6">
        <label for="name" class="form-label">First Name</label>
        <input type="text" name="customer[firstName]" value="<?= $customer->firstName  ?>" class="form-control">
    </div>
    <div class="col-md-6">
        <label for="price" class="form-label">Last Name</label>
        <input type="text" name="customer[lastName]" value="<?= $customer->lastName  ?>" class="form-control">
    </div>
    <div class="col-12">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="customer[email]" value="<?= $customer->email   ?>" class="form-control" id="discount">
    </div>
    <div class="col-12">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" name="customer[phone]" value="<?= $customer->phone  ?>" class="form-control" id="quantity">
    </div>
    <div class="col-md-6">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="customer[password]" value="<?= $customer->password  ?>" class="form-control" id="description">
    </div>
    <div class="col-md-4">
        <label for="status" class="form-label">Status</label>
        <select id="status" name="customer[status]" class="form-select">
            <?php foreach ($customer->getStatusOptions() as $key => $value) : ?>
                <option value="<?= $key ?>" <?php if ($customer->status == $key) : ?> selected <?php endif ?>> <?= $value ?> </option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">Add</button>
    </div>
</form>
</form>

<?php
?>
