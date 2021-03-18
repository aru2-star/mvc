<?php
$message = null;
if ($success = $this->getMessage()->getSuccess()) {
    $tag = 'success';
    $message = $success ?? '';
    unset($this->getMessage()->success);
}

if ($failure = $this->getMessage()->getFailure()) {
    $tag = 'danger';
    $message = $failure ?? '';
    unset($this->getMessage()->failure);
}
?>

<div>
    <?php if ($message) : ?>
        <div class="alert alert-<?= $tag  ?>" role="alert">
            <?= $message ?? '' ?>
        </div>
    <?php endif ?>
</div>