<form class="row g-3" action="<?php echo $this->getUrl()->getUrl('customer', 'add'); ?>" method="POST">
    <?php print_r($this->getTabContents()); ?>
</form>