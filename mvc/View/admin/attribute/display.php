<?php 
    $attribute = $this->getAttribute();
    $product = $this->getProduct(); 
    $options = $this->getOptions();
?>

<?php  if (!$options && $attribute->inputType != 'text'): ?>
    <label for="<?php echo $attribute->name; ?>"> <?php echo $attribute->name; ?>: </label>
    No Options Found!
<?php else: ?>
    <?php switch ($attribute->inputType): 
        case 'select': ?>
            <div class="row form-group">
                <div class="col-md-6">
                    <label for="<?php echo $attribute->name; ?>"> <?php echo $attribute->name; $attriName = $attribute->code;?>: </label>
                    <select name="product[<?php echo $attribute->name; ?>]" class="form-control">
                    
                    <?php foreach ($options->getData() as $option): ?>
                        <option value="<?php echo $option->optionId; ?>" <?php  if($option->optionId == $product->$attriName){ echo "selected"; } ?> ><?php echo $option->name; ?></option>  
                    <?php endforeach; ?>

                    </select>
                </div>
            </div>
            <?php break; ?>

        <?php case 'checkbox': ?>
            <div class="row form-group">
                <div class="col-md-6">
                    <label for="<?php echo $attribute->name; ?>"> <?php echo $attribute->name; $attriName = $attribute->code;?>: </label><br>
                    
                    <?php foreach ($options->getData() as $option): ?>
                        <?php $value = explode(',', $product->$attriName); ?>
                        <?php echo $option->name; ?>&nbsp;<input type="checkbox" name="product[<?php echo $attribute->name; ?>][]" value="<?php echo $option->optionId; ?>" class="form-check-control" <?php if(in_array($option->optionId, $value)){ echo "checked"; } ?>>&nbsp;&nbsp;
                    <?php endforeach; ?>

                    </select>
                </div>
            </div>
            <?php break; ?>

        <?php case 'radio': ?>
            <div class="row form-group">
                <div class="col-md-6">
                    <label for="<?php echo $attribute->name; ?>"> <?php echo $attribute->name; $attriName = $attribute->code;?>: </label><hr>
                    
                    <?php foreach ($options->getData() as $option): ?>
                        <?php echo $option->name; ?><input type="radio" name="product[<?php echo $attribute->name; ?>]" value="<?php echo $attribute->name; ?>" class="form-check-control" <?php if($option->optionId == $product->$attriName){ echo "checked"; } ?>>
                    <?php endforeach; ?>

                    </select>
                </div>
            </div>
            <?php break; ?>

        <?php case 'text': ?>
            <div class="row form-group">
                <div class="col-md-6">
                    <label for="<?php echo $attribute->name; ?>"> <?php echo $attribute->name; $attriName = $attribute->code;?>: </label>
                    <input type="text" name="product[<?php echo $attribute->name; ?>]" class="form-control" id="<?php echo $attribute->name; ?>" value="<?php echo $product->$attriName; ?>">
                </div>
            </div>
            <?php break; ?>

        <?php case 'textarea': ?>
            <div class="row form-group">
                <div class="col-md-6">
                    <label for="<?php echo $attribute->name; ?>"> <?php echo $attribute->name; ?>: </label>
                    <textarea name="product[<?php echo $attribute->name; ?>]" rows="4" class="form-control" id="<?php echo $attribute->name; ?>"></textarea>
                </div>
            </div>
            <?php break; ?>
        
        <?php default: ?>
            Try Again!!.
            <?php break; ?>
    <?php endswitch; ?>
<?php endif;?>

