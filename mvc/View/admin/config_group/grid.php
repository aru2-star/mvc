<?php $configGroup = $this->getConfigGroup();?>
<div>
	<table class="table">
		<thead>
			<th>Name</th>
			<th>Created</th>
		</thead>
		<tbody>
			<?php if($configGroup):?>
				<?php foreach($configGroup->getData() as $key => $group):?>
					<tr>
						<td><?=$group->name;?></td>
						<td><?=$group->createdAt;?></td>
						<td><button onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_configGroup',['groupId'=>$group->groupId])?>').resetParam().load()">Edit</button></td>
					</tr>
				<?php endforeach;?>
			<?php else:?>
			<tr><td>No records Found</td></tr>	
		<?php endif; ?>
		</tbody>
	</table>
</div>

