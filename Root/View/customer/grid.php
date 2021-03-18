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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this particular contact?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id=deleteBtn data-bs-dismiss="modal" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>