<?php $columns = $this->getColumns(); ?>
<?php $collection = $this->getCollection();?>
<?php $actions = $this->getActions();?>
<?php $buttons = $this->getButton();?>
<?php $pages = $this->getPages();?>

<form action="" id="gridForm">
	<div class="container mx-auto m-5">
			<section>
				   <div class="container">
	         			<h4 class="text-muted text-weight-bold"><?= $this->getTitle();?></h4>
	         			<hr>
	         			<?php if($buttons):?>
	         				<?php foreach ($buttons as $key => $button) :?>
								<a onclick="<?= $this->getButtonUrl($button['method']);?>" class="btn btn-success" ><?= $button['label']?></a>
							<?php endforeach;?>
						<?php endif;?>
						<div></div>
					<table class="table">
						
						<thead align="center">
							<tr>
							<?php if($columns):?>
							<?php foreach ($columns as $key => $column) :?>
								<th><?= $column['label'];?></th>
								
							<?php endforeach; ?>
						<?php endif;?>
								<th>Action</th>
							</tr>
						</thead>
						<tbody align="center">
							<tr>
							<?php if($columns):?>
							<?php foreach ($columns as $key => $column) :?>
								<td><input type="text" name="filter[<?= $column['controller']; ?>][<?= $column['type'];?>][<?= $column['field']; ?>]" class="form-control" value="<?php echo $this->getFilter()->getFilterValue($column['controller'],$column['type'],$column['field']);?>"></td>
							<?php endforeach; ?>
						<?php endif;?>
							</tr>
							<?php if($collection):?>	
								<?php foreach ($collection->getData() as $row) :?>
							 	<tr>
							 		<?php if($columns):?>
							 			<?php foreach ($columns as $key => $column): ?>
							 				<td><?= $this->getFieldValue($row,$column['field']);?></td>
							 			<?php endforeach;?>
							 	 	<?php endif;?>
							 	 	<?php if($actions):?>
							 	 		<td>
							 				<?php foreach ($actions as $key => $action): ?>
							 					<?php if($action['ajax']):?>
							 						<?php if($action['label'] == 'Edit'):?>
							 							<button type="button" class="btn btn-primary" onclick="<?= $this->getMethodUrl($row,$action['method']);?>"><?= $action['label']; ?></button>&nbsp;
							 						<?php elseif($action['label'] == 'Add To Cart'):?>
							 							<button type="button" class="btn btn-primary" onclick="<?= $this->getMethodUrl($row,$action['method']);?>"><?= $action['label']; ?></button>&nbsp;
							 						<?php else: ?>
							 							<button type="button" class="btn btn-danger" onclick="<?= $this->getMethodUrl($row,$action['method']);?>"><?= $action['label']; ?></button>&nbsp;
							 						<?php endif;?>
							 					<?php else: ?>
							 						<a href="<?= $this->getMethodUrl($row,$action['method']);?>"><?= $action['label']; ?></a>
							 					<?php endif;?>
							 				<?php endforeach;?>		
							 			</td>
							 		<?php endif;?>	
							 	</tr>	
							 	<?php endforeach; ?>
							 <?php else: ?>
								<tr>
									<td>No Data Found</td>
								</tr>
							 <?php endif;?>	

						</tbody>
				</table>
			</div>


			<ul class="pagination justify-content-center">
				<?php for($i = 1; $i <= $pages->getNoOfPages(); $i++) :?>
			   		 <li class="page-item <?php echo ($pages->getCurrentPage() == $i) ? 'active' : ' ';?>">
			   		 	<a class="page-link" href="javascript:void(0);" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid',null,['page'=>$i],true);?>').resetParam().load();"><?= $i;?> </a>
			   		 </li>
				<?php endfor; ?>

  			</ul>
		</section>
	</div>
</form>