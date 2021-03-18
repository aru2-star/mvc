<form class="row g-3" action="<?php echo $this->getUrl()->getUrl('product', 'add'); ?>" method="POST">
    <?php print_r($this->getTabContents()); ?>
</form>