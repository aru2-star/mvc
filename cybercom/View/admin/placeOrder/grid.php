<div class="container">
	<div class="row mt-4">
		<div class="col-md-10 offset-md-1">
			<?php echo $this->getBlock('Block\Admin\PlaceOrder\View')->toHtml() ?>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col" style="overflow-y: scroll; height: 200px" id="orderProductContent">
			<?php echo $this->getBlock('Block\Admin\PlaceOrder\View')->toHtml() ?>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col col-md-10 offset-md-1" id="productAddressContent">
			<?php echo $this->getBlock('Block\Admin\PlaceOrder\View')->toHtml() ?>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col col-md-5 border offset-md-1" id="productOrderDetails">
			<?php echo $this->getBlock('Block\Admin\PlaceOrder\View')->toHtml() ?>
		</div>
	</div>

</div>