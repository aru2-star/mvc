
<?php

$tabs = $this->getTabs();
foreach($tabs as $key => $tab) : ?>

<a class="btn btn-success" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl(null,null,['tab'=>$key],false);?>').resetParam().load();" href="javascript:void(0);"><?php echo $tab['label'];?></a>
<br><br>
<?php endforeach;?>

