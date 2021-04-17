<?php
$address = $this->getAddress();
$billing = [];
$shipping = [];
if($address){
    foreach($address as $key=>$value){
        if($value['addressType'] == 'Billing'){
            $billing = $value;
        }else if($value['addressType'] == 'Shipping'){
            $shipping = $value;
        }
    }
}
?>

<h2 align="center" class="display-4">Customer Address</h2><br><br>
<form action="<?php echo $this->getUrl('addressSave',NULL,['id'=>$this->getRequest()->getGet('id')],true); ?>" method="POST">

<div  style="width: 800px" class="row">
<div align="center" class="col-md-6">
    <h4>Billing Address</h4><br>
    <label for="address" class="form-label">Address</label><br>
    <input type="text" name="address" class="form-control" value="<?php 
            if(array_key_exists('address',$billing)){
                echo $billing['address'];
            };
        ?>"><br><br>

    <label for="city" class="form-label">City</label><br>
    <input type="text" name="city" class="form-control" value="<?php 
            if(array_key_exists('city',$billing)){
                echo $billing['city'];
            };
        ?>"><br><br>

    <label for="state" class="form-label">State</label><br>
    <input type="text" name="state" class="form-control" value="<?php 
            if(array_key_exists('state',$billing)){
                echo $billing['state'];
            };
        ?>"><br><br>

    <label for="zipcode" class="form-label">Zipcode</label><br>
    <input type="text" name="zipcode" class="form-control" value="<?php 
            if(array_key_exists('zipcode',$billing)){
                echo $billing['zipcode'];
            };
        ?>"><br><br>
        
    <label for="country" class="form-label">Country</label><br>
    <input type="text" name="country" class="form-control" value="<?php 
            if(array_key_exists('country',$billing)){
                echo $billing['country'];
            };
        ?>"><br><br>
</div>   

<div align="center" class="col-md-6">
    <h4>Shipping Address</h4><br>
    <label for="address" class="form-label">Address</label><br>
    <input type="text" name="shippingaddress" class="form-control" value="<?php 
            if(array_key_exists('address',$shipping)){
                echo $shipping['address'];
            };
        ?>"><br><br>

    <label for="city" class="form-label">City</label><br>
    <input type="text" name="shippingcity" class="form-control" value="<?php 
            if(array_key_exists('city',$shipping)){
                echo $shipping['city'];
            };
        ?>"><br><br>

    <label for="state" class="form-label">State</label><br>
    <input type="text" name="shippingstate" class="form-control" value="<?php 
            if(array_key_exists('state',$shipping)){
                echo $shipping['state'];
            };
        ?>"><br><br>

    <label for="zipcode" class="form-label">Zipcode</label><br>
    <input type="text" name="shippingzipcode" class="form-control" value="<?php 
            if(array_key_exists('zipcode',$shipping)){
                echo $shipping['zipcode'];
            };
        ?>"><br><br>

    <label for="country" class="form-label">Country</label><br>
    <input type="text" name="shippingcountry" class="form-control" value="<?php 
            if(array_key_exists('country',$shipping)){
                echo $shipping['country'];
            };
        ?>"><br><br>    
    <div align="left">
        <input type="submit" value="Save" class="btn btn-primary">
        <input type="reset" value="Reset" class="btn btn-primary">
    </div>
</div>
</div>
</form>
