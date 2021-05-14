
<?php

$tabs = $this->getTabs();
foreach($tabs as $key => $tab) : ?>
<div class="container mt-5">

<button type="button" class="btn-success text-white" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl(null,null,['tab'=>$key],false);?>').resetParam().load();" href="javascript:void(0);"><?php echo $tab['label'];?></button>

</div>

<?php endforeach;?>

