<?php

$tabs = $this->getTabs();

foreach ($tabs as $key => $tab) {?>

<a class="btn btn-primary" href = '<?php echo $this->getUrl(null,null,['tab' => $key]);?>'><?php echo $tab['label']; ?></a>

<?php } ?>