<?php
$payments = $this->getPayments();
?>
<div class="d-flex justify-content-between align-items-center">
    <h3 class="display-5">Payment List</h3>
    <a class="btn btn-success" href="<?php echo $this->getUrl()->getUrl('payment', 'form') ?>">Create Payment</a>
</div>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Code</th>
            <th scope="col">Description</th>
            <th scope="col">Status</th>
            <th scope="col">Created Date</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($payments) : ?>
            <?php foreach ($payments as $payment) : ?>
                <tr>
                    <th scope="row"><?= $payment->methodId ?></th>
                    <td><?= $payment->name ?></td>
                    <td><?= $payment->code ?></td>
                    <td><?= $payment->description ?></td>
                    <td><?= $payment->status ?></td>
                    <td><?= $payment->createdDate ?></td>
                    <td>
                        <a class="btn btn-primary" href="<?php echo $this->getUrl()->getUrl(null, 'form', ['id' => $payment->methodId]); ?>">Update</a>
                        <a type="button" class="btn btn-danger that" href="<?php echo $this->getUrl()->getUrl(null, 'delete', ['id' => $payment->methodId]); ?>">Delete</a>
                    </td>
                </tr>

            <?php endforeach ?>
        <?php endif ?>

    </tbody>

</table>
