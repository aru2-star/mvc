
<?php

$tabs = $this->getTabs();
foreach($tabs as $key => $tab) : ?>

<a class="btn btn-success" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_category',['tab'=>$key],false);?>').resetParam().load();"><?php echo $tab['label'];?>
</a>

<?php endforeach;?>

