<?php $cart = $this->getCart();?>
<?php $cartItems = $cart->getItems(); ?>
<?php $customers = $this->getCustomers(); ?>
<?php $customer = $cart->getCustomer(); ?>
<?php $billingAddress = $this->getBillingAddress(); ?>
<?php $shippingAddress = $this->getShippingAddress(); ?>
<?php $paymentDetails = $this->getPaymentDetails()->getData(); ?>
<?php $shippingDetails = $this->getShippingDetails()->getData(); ?>
<form action="" id="cartForm">
<div class="container mx-auto m-5">
	<section>
		  <div class="container">
     			<div>
					<select name="customer" class="form-control" id="customer">
						<option value="">Select</option>
						<?php foreach ($customers as $key => $value) :?>
							<option value="<?= $value->customerId?>"<?php if($customer):?><?php if($value->customerId == $customer->customerId):?>selected <?php endif;?><?php endif;?>><?= $value->fname;?></option>
						<?php endforeach; ?>
					</select>
					<br>
					<button type="button" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('selectCustomer','admin_cart');?>').resetParam().setParams($('#cartForm').serializeArray()).setMethod('POST').load()" class="btn btn-success">Go</button>
				
				</div>
			</div><br><br>

			<div class="container">
			<h4 class="text-muted text-weight-bold">Cart</h4>	
		<br>
		<table class="table">
			<thead>
					<tr>
						<th>Cart Id</th>
						<th>Product Name</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Row Total</th>
						<th>Discount</th>
						<th>Grand Total</th>
						<th>Action</th>
					</tr>
			</thead>
			<tbody>
				<?php if($cartItems):?>
				<?php foreach ($cartItems->getData() as $key => $item) :?>
				 <tr>
				 	<td><?php echo $item->cartItemId; ?></td>
				 	<td><?php echo $item->getProduct()->name;?></td>
				 	<td><input type="number" name="quantity[<?php echo $item->cartItemId; ?>]" class="form-control" value="<?php echo $item->quantity;?>"></td>
				 	<td><input type="number" name="price[<?php echo $item->cartItemId; ?>]" class="form-control" value="<?php echo $item->price;?>"></td>
				 	<td><?php echo $item->quantity * $item->price; ?></td>
				 	<td><?php echo $item->discount* $item->quantity; ?></td>
				 	<td><?php echo ($item->quantity * $item->price)- $item->discount;?></td>
				 	<td><button type="button" class='btn-danger' onclick ="object.setUrl('<?php echo $this->getUrl()->getUrl('delete','admin_cart',['itemId'=>$item->cartItemId]); ?>').resetParam().load();"><i class='fas fa-trash-alt'></i></button>
			 		</td>
			 	</tr>
				<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
		</div>
			
			<div class="container mt-5">
				<div class="form-row">
				<div class="col">
					<h4 class="text-muted text-weight-bold">Billing Form</h4>
					<?php if($billingAddress):?>
					<div class="form-group">
						<input type="text" name="billing[address]" class="form-control" placeholder="Address" value="<?= $billingAddress->address;?>">
					</div>
					<div class="form-group">
						<input type="text" name="billing[country]" class="form-control" placeholder="Country" value="<?= $billingAddress->country;?>">
					</div>
					<div class="form-group">
						<input type="text" name="billing[state]" class="form-control" placeholder="State" value="<?= $billingAddress->state;?>">
					</div>
					<div class="form-group">
						<input type="text" name="billing[city]" class="form-control" placeholder="City" value="<?= $billingAddress->city;?>">
					</div>
					<div class="form-group">
						<input type="text" name="billing[zipcode]" class="form-control" placeholder="Zipcode" value="<?= $billingAddress->zipcode;?>">
					</div>
					<div>
						<input type="checkbox" id="billingAddressBook" name="billingAddressBook"> Save In AddressBook
					</div>
					<div class="form-group">
						<button type="button" class="btn btn-success" onclick="object.setUrl('<?= $this->getUrl()->getUrl('updateAddress','admin_cart',['type' => 'billing']) ?>').resetParam().setParams($('#cartForm').serializeArray()).setMethod('POST').load();">Save</button>
					</div>
				<?php endif; ?>
				</div>		
				<div class="col">
					<h4 class="text-muted text-weight-bold">Shipping Form</h4>
					<?php if($shippingAddress):?>
					<div class="form-group">
						<input type="text" name="shipping[address]" class="form-control" placeholder="Address" value="<?= $shippingAddress->address; ?>">
					</div>
					<div class="form-group">
						<input type="text" name="shipping[country]" class="form-control" placeholder="Country" value="<?= $shippingAddress->country; ?>">
					</div>
					<div class="form-group">
						<input type="text" name="shipping[state]" class="form-control" placeholder="State" value="<?= $shippingAddress->state; ?>">
					</div>
					<div class="form-group">
						<input type="text" name="shipping[city]" class="form-control" placeholder="City" value="<?= $shippingAddress->city; ?>">
					</div>
					<div class="form-group">
						<input type="text" name="shipping[zipcode]" class="form-control" placeholder="Zipcode" value="<?= $shippingAddress->zipcode; ?>">
					</div>
					<div>
						<input type="checkbox" id="sameAsBilling" name="sameAsBilling"> Same as Billing 
						<br>
						<input type="checkbox" id="shippingAddressBook" name="shippingAddressBook"> Save In AddressBook
					</div>
					<div class="form-group">
						<button type="button" class="btn btn-success" onclick="object.setUrl('<?= $this->getUrl()->getUrl('updateAddress','admin_cart',['type' => 'shipping']) ?>').resetParam().setParams($('#cartForm').serializeArray()).setMethod('POST').load();">Save</button>
					</div>
				<?php endif; ?>
				</div>
			</div> 
		</div>
		<div class="container mt-5">
				<div class="form-row">
				<div class="col">
					<h4 class="mt-2 text-center">Payment Methods</h4>
					<?php if ($cart): ?>
						<?php foreach ($paymentDetails as $paymentDetail): ?>
							<input type="radio" name="paymentMethod" <?php if ($cart->paymentMethodId == $paymentDetail->paymentMethodId): ?>
								checked
							<?php endif ?> value="<?= $paymentDetail->paymentMethodId ?>"> <?= $paymentDetail->name ?> <br>
						<?php endforeach ?>
						<div class="form-group mt-3">
							<button class="btn btn-success" type="button" onclick="object.setUrl('<?= $this->getUrl()->getUrl('updatePayment') ?>').resetParam().setParams($('#cartForm').serializeArray()).setMethod('POST').load();">Update</button>
						</div>
					<?php endif; ?>
				</div>	
				<div class="col">	
					<h4 class="mt-2 text-center">Shipping Methods</h4>
					<?php if ($cart): ?>
						<?php foreach ($shippingDetails as $shippingDetail): ?>
							<input type="radio" name="shippingMethod" <?php if ($cart->shippingMethodId == $shippingDetail->shippingMethodId): ?>
								checked
							<?php endif ?> value="<?= $shippingDetail->shippingMethodId ?>"> <?= $shippingDetail->name ?> (<?= $shippingDetail->description ?> - Rs.<?= $shippingDetail->amount ?>) <br>
						<?php endforeach ?>
						<div class="form-group mt-3">
							<button class="btn btn-success" type="button" onclick="object.setUrl('<?= $this->getUrl()->getUrl('updateShipping') ?>').resetParam().setParams($('#cartForm').serializeArray()).setMethod('POST').load();">Update</button>
						</div>
					<?php endif ?>
				</div>
			</div>
		</div>
		

		<table class="table mt-4 text-left">
			<tr>
				<td>
					Total :
				</td>
				<td>
					<?php if ($cart): ?>
						Rs.<?= $cart->total ?>
					<?php else: ?>
						Rs.0.00
					<?php endif ?>
				</td>
			</tr>
			<tr>
				<td>
					Shipping Charges :
				</td>
				<td>
					<?php if ($cart): ?>
						Rs.<?= $cart->shippingAmount ?>
					<?php else: ?>
						Rs.0.00
					<?php endif ?>
				</td>
			</tr>
			<tr>
				<td>
					Grand Total :
				</td>
				<td>
					<?php if ($cart): ?>
						Rs.<?= $cart->total + $cart->shippingAmount ?>
					<?php else: ?>
						Rs.0.00
					<?php endif ?>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<button type="button" class="btn btn-success" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('placeOrder','admin_cart');?>').resetParam().load();">Place Order</button>
				</td>
			</tr>
		</table>
	</section>
</div>
</form>