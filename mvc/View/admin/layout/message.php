<div>
    <div>
        <?php if ($success = $this->getMessage()->getSuccess()) : $this->getMessage()->clearSuccess(); ?>
            <div class="alert alert-success" role="alert"> <?php echo $success; ?></div>
        <?php endif ?>
        <?php if ($failure = $this->getMessage()->getFailure()) : $this->getMessage()->clearFailure(); ?>
            <div class="alert alert-danger" role="alert"> <?php echo $failure; ?></div>
        <?php endif ?>
    </div>
</div>