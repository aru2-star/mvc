<?php
$payment = $this->getPayment();
?>
<form class="row g-3" action="<?php echo $this->getUrl()->getUrl('payment', 'add'); ?>" method="POST">

    <div class="col-md-6">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="payment[name]" value="<?= $payment->name  ?>" class="form-control">
    </div>
    <div class="col-md-6">
        <label for="code" class="form-label">Code</label>
        <input type="text" name="payment[code]" value="<?= $payment->code  ?>" class="form-control">
    </div>
    <div class="col-md-6">
        <label for="description" class="form-label">Description</label>
        <input type="text" name="payment[description]" value="<?= $payment->description   ?>" class="form-control" id="description">
    </div>
    <div class="col-md-4">
        <label for="status" class="form-label">Status</label>
        <select id="status" name="payment[status]" class="form-select">
            <?php foreach ($payment->getStatusOptions() as $key => $value) : ?>
                <option value="<?= $key ?>" <?php if ($payment->status == $key) : ?> selected <?php endif ?>> <?= $value ?> </option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">Add</button>
    </div>
</form>
<?php
?>
