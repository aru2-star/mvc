<div class="container">
	<table width="100%" height="100%">
		<tbody>
			<tr>
				<td><?= $this->getTabHtml();?></td>
				&nbsp;
				<td>
					<form id="editForm" action="<?= $this->getUrl()->getUrl('save');?>">
					<?= $this->getTabContent();?>
					</form>
				</td>
			</tr>
		</tbody>
	</table>
</div>