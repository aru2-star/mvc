<?php $order = $this->getOrder();?>
<?php if($order):?>
<?php $customer = $order->getCustomer();?>
<h4>Order Id: <?php  echo $order->orderId; ?></h4>
<h4>Customer Name: <?php echo $customer->fname; ?>&nbsp;<?= $customer->lname;?></h4>
<?php endif;?>

<?php $products = $this->getProducts();?>
<h4>Product Details: </h4>
<table class="table">
	<thead align="center">
		<th>Name</th>
		<th>Quantity</th>
		<th>Price</th>
	</thead>
	<tbody align="center">
		<?php if($products):?>
			<?php foreach($products->getData() as $key => $product):?>
				<tr>
					<td><?= $product->getProduct()->name; ?></td>
					<td><?= $product->quantity; ?></td>
					<td><?= $product->price; ?></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</tbody>	
</table>		

<?php $shippingAddress = $this->getOrderShippingAddress(); ?>
<?php $billingAddress = $this->getOrderBillingAddress(); ?>

<div class="row">
	<div class="col p-4 border">
		<h4>Billing Address</h4>
		<div>
			<?= $billingAddress->address; ?>,
			<br><?= $billingAddress->city ?>, 
			<?= $billingAddress->state?> 
			-<?= $billingAddress->zipcode?>
		</div>
	</div>
	<div class="col ml-4 p-4 border">
		<h4>Shipping Address</h4>
		<div>
			<?= $shippingAddress->address; ?>,
			<br><?= $shippingAddress->city ?>, 
			<?= $shippingAddress->state?> 
			-<?= $shippingAddress->zipcode?>
		</div>
	</div>
</div>

<?php $orderDetails = $this->getOrder(); ?>

<table class="table mt-4 text-left">
<tr>
	<td>
		Total :
	</td>
	<td>
		<?php if ($orderDetails): ?>
			Rs.<?= $orderDetails->total ?>
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
			<?php if ($orderDetails): ?>
				Rs.
				<?= $orderDetails->shippingAmount ?>
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
			<?php if ($orderDetails): ?>
				Rs.<?= $orderDetails->total + $orderDetails->shippingAmount ?>
			<?php else: ?>
				Rs.0.00
			<?php endif ?>
		</td>
	</tr>
</table>