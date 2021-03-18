<?php
$tabs = $this->getTabs();
?>

<?php foreach ($tabs as $key => $tab) : ?>
    <a class="btn btn-primary mb-3" href="<?php echo $this->getUrl()->getUrl(null, null, ['tabs' => $key]); ?>"><?= $tab['label'] ?></a><br>
<?php endforeach  ?>