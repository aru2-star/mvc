<?php 
$attributes = $this->getAttributes();
$product = $this->getTableRow();
$attributes = $this->getAttributes(); 
?>
<div id="title">
    <h2 align="center" class="display-5">Product Attribute</h2>
</div>
<form method="POST" action="<?php echo "{$this->geturl('save', 'Admin\product\attribute')}"; ?>">
    <?php if ($attributes): ?>
        <?php foreach($attributes->getData() as $attribute): ?>
        <?php
            $displayBlock = \Mage::getBlock('Block\Admin\Attribute\Display');
            $displayBlock = $displayBlock->setAttribute($attribute)->setProduct($product);
            $displayBlock->toHtml();
        ?>
        <?php endforeach; ?>
    <?php else: ?>
    <div  class="ml-5">
        Sorry, No Attributes are Avaiable for this Product.
    </div>
    <?php endif; ?>
    <div class="row form-group">
        <div class="col-4">
            <input type="submit"  name="submit" class="btn btn-success" id="submit" value="save">
        </div>
    </div>
</form>