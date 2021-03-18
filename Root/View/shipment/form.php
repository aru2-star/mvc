<?php
$shipment = $this->getShipment();
//echo"<pre>";
?>

<form class="row g-3" action="<?php echo $this->getUrl()->getUrl('shipment', 'add'); ?>" method="POST">

    <h1 class="display-6"> Create/Update Product </h1>

    <div class="col-md-6">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="shipment[name]" value="<?= $shipment->name ?>" class="form-control">
    </div>
    <div class="col-md-6">
        <label for="code" class="form-label">Code</label>
        <input type="text" name="shipment[code]" value="<?= $shipment->code  ?>" class="form-control">
    </div>
    <div class="col-md-6">
        <label for="amount" class="form-label">Amount</label>
        <input type="text" name="shipment[amount]" value="<?= $shipment->amount  ?>" class="form-control">
    </div>
    <div class="col-md-6">
        <label for="description" class="form-label">Description</label>
        <input type="text" name="shipment[description]" value="<?= $shipment->description  ?>" class="form-control" id="description">
    </div>
  
  
    <div class="col-md-4">
        <label for="status" class="form-label">Status</label>
        <select id="status" name="shipment[status]" class="form-select">
            <?php foreach ($shipment->getStatusOptions() as $key => $value) : ?>
                <option value="<?= $key ?>" <?php if ($shipment->status == $key) : ?> selected <?php endif ?>> <?= $value ?> </option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">Add</button>
    </div>
</form>
<?php
?>
