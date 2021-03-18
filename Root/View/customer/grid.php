<?php
$customers = $this->getCustomers();
?>

<div class="d-flex justify-content-between align-items-center">
    <h3 class="display-5">Customer List</h3>
    <a class="btn btn-success" href="<?php echo $this->getUrl()->getUrl(null, 'form') ?>">Create Customer</a>
</div>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Password</th>
            <th scope="col">Status</th>
            <th scope="col">Created Date</th>
            <th scope="col">Updated Date</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($customers) : ?>
            <?php foreach ($customers as $customer) : ?>
                <tr>
                    <th scope="row"><?= $customer->customerId ?></th>
                    <td><?= $customer->firstName ?></td>
                    <td><?= $customer->lastName ?></td>
                    <td><?= $customer->email ?></td>
                    <td><?= $customer->phone ?></td>
                    <td><?= $customer->password ?></td>
                    <td><?= $customer->status ?></td>
                    <td><?= $customer->createdDate ?></td>
                    <td><?= $customer->updatedDate ?></td>
                    <td>
                        <a class="btn btn-primary" href="<?php echo $this->getUrl()->getUrl(null, 'form', ['id' => $customer->customerId]) ?>"><i class="bi bi-pencil"></i></a>
                        <a type="button" class="btn btn-danger that" href="<?php echo $this->getUrl()->getUrl(null, 'delete', ['id' => $customer->customerId]) ?>"><i class="bi bi-trash-fill"></i></a>
                    </td>
                </tr>

            <?php endforeach ?>
        <?php endif ?>

    </tbody>

</table>
