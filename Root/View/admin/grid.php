<?php
$admins = $this->getAdmins();
?>

<div class="d-flex justify-content-between align-items-center">
    <h3 class="display-5">Admin Details</h3>
    <a class="btn btn-success" href="<?php echo $this->getUrl()->getUrl(null, 'form') ?>">Create Admin</a>
</div>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Password</th>
            <th scope="col">Status</th>
            <th scope="col">Created Date</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($admins) : ?>
            <?php foreach ($admins as $admin) : ?>
                <tr>
                    <th scope="row"><?= $admin->adminId ?></th>
                    <td><?= $admin->username ?></td>
                    <td><?= $admin->password ?></td>
                    <td><?= $admin->status ?></td>
                    <td><?= $admin->createdDate ?></td>
                    <td>
                        <a class="btn btn-primary" href="<?php echo $this->getUrl()->getUrl(null, 'form', ['id' => $admin->adminId], false)  ?>">Update</a>
                        <a type="button" class="btn btn-danger that" href="<?php echo $this->getUrl()->getUrl(null, 'delete', ['id' => $admin->adminId], false) ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>

    </tbody>

</table>