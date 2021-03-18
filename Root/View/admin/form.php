<?php
$admin = $this->getAdmin();
?>

<form class="row g-3" action="<?php echo $this->getUrl()->getUrl('admin', 'add'); ?>" method="POST">

    <h1 class="display-6"> Create/Update Admin </h1>

    <div class="col-md-6">
        <label for="username" class="form-label">Name</label>
        <input type="text" name="admin[username]" value="<?= $admin->username ?>" class="form-control">
    </div>
    <div class="col-md-6">
        <label for="description" class="form-label">Password</label>
        <input type="text" name="admin[password]" value="<?= $admin->password ?>" class="form-control" id="description">
    </div>
    <div class="col-md-4">
        <label for="status" class="form-label">Status</label>
        <select id="status" name="admin[status]" class="form-select">
            <?php foreach ($admin->getStatusOptions() as $key => $value) : ?>
                <option value="<?= $key ?>" <?php if ($admin->status == $key) : ?> selected <?php endif ?>> <?= $value ?> </option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">Create</button>
    </div>
</form>