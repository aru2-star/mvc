<div class="col 12">
	<?php if($success = $this->getAdminMessage()->getSuccess()){ $this->getAdminMessage()->clearSuccess(); ?>
	<div class="alert alert-success"><?php echo $success; }?></div>
	<?php if($failure = $this->getAdminMessage()->getFailure()){ $this->getAdminMessage()->clearFailure(); ?>
	<div class="alert alert-danger"><?php echo $failure; }?></div>	
</div>