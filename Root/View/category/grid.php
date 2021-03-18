<?php
$categories = $this->getCategories();
?>

<div class="d-flex justify-content-between align-items-center">
    <h3 class="display-5">Category List</h3>
    <a class="btn btn-success" href="<?php echo $this->getUrl()->getUrl(null, 'form') ?>">Create Category</a>
</div>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Status</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($categories) : ?>
            <?php foreach ($categories as $category) : ?>
                <tr>
                    <th scope="row"><?= $category->categoryId ?></th>
                    <td><?= $category->name ?></td>
                    <td><?= $category->status ?></td>
                    <td><?= $category->description ?></td>
                    <td>
                        <a class="btn btn-primary" href="<?php echo $this->getUrl()->getUrl(null, 'form', ['id' => $category->categoryId], false)  ?>">Update</a>
                        <a type="button" class="btn btn-danger that" href="<?php echo $this->getUrl()->getUrl(null, 'delete', ['id' => $category->categoryId], false)  ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>

    </tbody>

</table>
