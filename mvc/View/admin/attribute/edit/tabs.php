<?php
$tabs = $this->getTabs();

foreach ($tabs as $key => $tab) : ?>

    <a class="btn btn-primary" href="<?php echo $this->getUrl(null, null, ['tabs' => $key]); ?>"><?= $tab['label'] ?></a><br><br>

<?php endforeach;?>