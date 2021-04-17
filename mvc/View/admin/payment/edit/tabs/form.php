<?php
$payment = $this->getTableRow();
$option = $payment->getStatusOption();
?>

<h2 align="center" class="display-4">Add/Update Payment</h2>
<form method="post" action="<?php echo $this->getUrl('save'); ?>">
<div align="center" class="row">
            <div align="center" class="col-md-6">

                <label for="name" class="form-label">Name</label><br>
                <input type="text" class="form-control"  name="payment[name]" value="<?php echo $payment->name;  ?>">

                <label for="description" class="form-label">Description</label><br> 
                <textarea class="form-control" id="description" name="payment[description]" rows="3"
                value="<?php echo $payment->description; ?>"><?php echo $payment->description; ?></textarea>
    
            </div>

            <div class="col-md-6">

                <label for="code" class="form-label">Code</label><br>
                <input type="text" class="form-control"  name="payment[code]" value="<?php echo $payment->code;  ?>">
                
                <label for="status" class="form-label">Status</label><br>
                <select name="payment[status]">
                <?php foreach($option as $key=>$value){ ?>
                    <option value="<?php echo $key; ?>" <?php if($payment->status == $key){echo "selected";} ?> ><?php echo $value; ?></option>
                <?php } ?>
                </select><br><br>
                <button type="submit" class="btn btn-success" value="submit">Submit</button>
            </div>
        </div>
</form>