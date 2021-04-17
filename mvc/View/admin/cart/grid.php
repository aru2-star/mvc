<?php $cartItems = $this->getCart()->getItems();
$customers = $this->getCustomers();
$cart = $this->getCart();
$cartBillingAddress = $this->getCustomerBillingAddress();
$cartShippingAddress = $this->getCustomerShippingAddress();
$payment = $this->getPayment();
$shipping = $this->getShipping();
?>

<div class="container">
    <div id="main-content">
    <h2 align="center" class="display-5">Cart</h2>
       
<div class="table_data">
<form method="POST" action="<?php echo $this-> getUrl('update') ?>" id="cartForm">
    
    <a href="<?php echo $this-> getUrl('grid','Admin\product') ?>" class="btn btn-info" role="button">Go Bavk</a>
    <input type = "submit" value="Update Cart" class="btn btn-info"><br><br>

    <select name="customer" class="form-control">
        <option>Select Customer</option>
        <?php foreach ($customers->getData() as $key => $customer): ?>
            <option value = "<?php echo $customer->customerId; ?>" <?php if($customer->customerId == $cart->customerId){echo "Selected" ;}?>><?php echo $customer->firstname; ?></option>
        <?php endforeach; ?>
    </select><br>
    <button type="button" class="btn btn-info" onclick="selectCustomer();">Proceed</button><br><br>

    <table cellpadding="10px" align="center" width="70%" class="table table-striped table-hover">
        <thead align="center">
            <th>Cart Item Id</th>
            <th>Product Id</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
            <th>Discount</th>
            <th>Final Total</th>
            <th>Action</th>
        </thead>
        
        <tbody align="center">
        <?php if(!$cartItems): ?>
            <tr>
                <td colspan="8">No Data Found!!!</td>
            </tr>
        <?php else : ?> 
        <?php
            foreach ($cartItems->getData() as $key => $item) {
        ?>
            <tr>

                <td><?php echo $item->cartItemId; ?></td>
                <td><?php echo $item->productId; ?></td>
                <td><input type = "number" name="quantity[<?php echo $item->cartItemId ?>]" value = <?php echo $item->quantity ?> ></td>
                <td><?php echo $item->price; ?></td>
                <td><?php echo $item->price * $item->quantity; ?></td>
                <td><?php echo $item->discount * $item->quantity; ?></td>
                <td><?php echo ($item->quantity * $item->price - $item->discount * $item->quantity); ?></td>
                <td><a href='<?php echo $this->getUrl('delete', 'admin\cart', ['id' => $item->cartItemId]) ?>' class="btn btn-Danger" role="button">Delete</a></td>       
            </tr>
        <?php } endif;?>
        </tbody>
    </table>

    <div class="row">
    <div class="col-lg-6">
    <table class="table table-striped table-hover" id="billing">
        <thead>
            <tr>
                <th colspan="2">Billing Address</th>
            <tr>
        <thead>
        <tbody>
            <tr>
                <td>Address</td>
                <td><input type="text" name="billing[address]" value="<?php echo $cartBillingAddress->address; ?>" ></td>
            <tr>
            <tr>
                <td>City</td>
                <td><input type="text" name="billing[city]" value="<?php echo $cartBillingAddress->city; ?>" ></td>
            <tr>
            <tr>
                <td>State</td>
                <td><input type="text" name="billing[state]" value="<?php echo $cartBillingAddress->state; ?>"></td>
            <tr>
            <tr>
                <td>Zipcode</td>
                <td><input type="text" name="billing[zipcode]" value="<?php echo $cartBillingAddress->zipcode ;?>" ></td>
            <tr>
            <tr>
                <td>Country</td>
                <td><input type="text" name="billing[country]" value="<?php echo  $cartBillingAddress->country; ?>"></td>
            <tr>
            <tr>
                <td><input type="submit" value="Save" class="btn btn-primary" onclick="billingSave();"></td>
                <td><input class="ml-auto" name="bookAddressBilling" value="1" type="checkbox">
                    <label for="save">save to address book</label>
                </td>
            <tr>
        </tbody>
    </table>
    </div>

    <div class="col-lg-6">
    <table class="table table-striped table-hover">
        <thead>   
            <tr>
                <th colspan="2">Shipping Address</th>
            <tr>
        <thead>
        <tbody>
            <tr>
                <td>Address</td>
                <td><input type="text" name="shipping[address]" value="<?php echo $cartShippingAddress->address; ?>" ></td>
            <tr>
            <tr>
                <td>City</td>
                <td><input type="text" name="shipping[city]" value="<?php echo $cartShippingAddress->city; ?>"></td>
            <tr>
            <tr>
                <td>State</td>
                <td><input type="text" name="shipping[state]" value="<?php echo $cartShippingAddress->state; ?>"></td>
            <tr>
            <tr>
                <td>Zipcode</td>
                <td><input type="text" name="shipping[zipcode]" value="<?php echo $cartShippingAddress->zipcode; ?>" ></td>
            <tr>
            <tr>
                <td>Country</td>
                <td><input type="text" name="shipping[country]" value="<?php echo $cartShippingAddress->country; ?>"></td>
            <tr>
            <tr>
                <td><input type="submit" value="Save" class="btn btn-primary" onclick="shippingSave();"></td>
                <td>
                    <input class="ml-auto" name="bookAddressShipping" value="1" type="checkbox">
                    <label for="save">Save to address book?</label>
                </td>
            <tr>
            <tr>
                <td>Same as Billing Address?</td>
                <td><input value="1" name="sameAsBilling" type="checkbox"></td>
            </tr>
        </tbody>
    </table>
    </div>
    </div>

    <div class="row">
    <div class="col-lg-6">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Payment Method</th>
            <tr>
        <thead>
        <tbody>
            <tr>
                <td><?php foreach ($payment->getData() as $key => $value) { ?>
                    <?php echo $value->name;?><input name= "paymentId" type="radio" value="<?php echo $value->paymentId; ?>" <?php if($value->paymentId == $cart->paymentId){echo "Checked" ;}?>><br>
                    <?php }?>
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="Save" onclick="savePayment();" class="btn btn-primary font-weight-bold"></td>
            </tr>
        </tbody>
    </table>
    </div>
    <div class="col-lg-6">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Shipping Method</th>
            <tr>
        <thead>
        <tbody>
            <tr>
                <td><?php foreach ($shipping->getData() as $key => $value) { ?>
                    <?php echo $value->name;?><input name= "shippingId" type="radio" value="<?php echo $value->shippingId; ?>" <?php if($value->shippingId == $cart->shippingId){echo "Checked" ;}?>><br>
                    <?php }?>
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="Save" onclick="saveShipping();" class="btn btn-primary font-weight-bold"></td>
            </tr>
        </tbody>
    </table>
    </div>
        <table class="table table-striped table-hover">
                <tr align="center">
                    <td>Total : <?php echo $this->getBaseTotal(); ?><br>
                        Shipping Charges : <?php echo $cart->shippingAmount; ?><br> 
                    </td>
                </tr>
                <tr align="center">
                    <td class="font-weight-bold">TOTAL AMOUNT : <?php echo ($this->getBaseTotal()+$cart->shippingAmount); ?></td>
                </tr>
        </table>   
</form>
</div>
</div>

<script type="text/javascript">
    function selectCustomer(){
        var form = document.getElementById('cartForm');
        form.setAttribute('Action','<?php echo $this->getUrl('selectCustomer') ?>');
        form.submit();
    }

    function billingSave(){
        var form = document.getElementById('cartForm');
        form.setAttribute('Action', '<?php echo $this->getUrl('billingSave')?>');
        form.submit();
    }

    function shippingSave(){
        var form = document.getElementById('cartForm');
        form.setAttribute('Action', '<?php echo $this->getUrl('shippingSave')?>');
        form.submit();
    }

    function savePayment(){
        var form = document.getElementById('cartForm');
        form.setAttribute('Action', '<?php echo $this->getUrl('savePayment'); ?>');
        form.submit();   
    }

    function saveShipping(){
        var form = document.getElementById('cartForm');
        form.setAttribute('Action', '<?php echo $this->getUrl('saveShipping'); ?>');
        form.submit();   
    }
</script>