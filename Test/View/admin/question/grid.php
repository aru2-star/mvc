<?php
$questionData = $this->getQuestion();
?>

<div class="container mx-auto m-5">
	<section>
		<div class="container">
    		<h4 class="text-muted text-weight-bold">Questions</h4>
			<hr><a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_question',null,true);?>').resetParam().load();" class="btn btn-success" >Add Question</a>
			<br>

			<table class="table table-hover">
				<thead>
					<tr>
						<th>Question</th>
						<th>Option 1</th>
						<th>Option 2</th>
						<th>Option 3</th>
						<th>Option 4</th>
						<th>Status</th>
						<th>Correct Answer</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if (!$questionData) :?>
						<tr>
						 	<td>No records found</td>
						</tr>
						<?php else :?>	
						<?php foreach ($questionData->getData() as $key => $value) :?>
							<tr>
								<td><?php echo $value->questionId; ?></td>
								<td><?php echo $this->getQuestionChoices($value); ?></td>
								<td><?php echo $this->getQuestionChoices($value); ?></td>
								<td><?php echo $this->getQuestionChoices($value); ?></td>
								<td><?php echo $this->getQuestionChoices($value); ?></td>
								<td><?php echo $this->getStatusName($value); ?></td>
								<td><?php echo $this->getQuestionChoices($value); ?></td>
								<td><button type="button" class='btn-primary' onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('edit','admin_question',['questionId'=>$question->questionId],true);?>').resetParam().load();"><i class='far fa-edit'></i></button>&nbsp;&nbsp;<button type="button" class='btn-danger' onclick ="object.setUrl('<?php echo $this->getUrl()->getUrl('delete','admin_question',['questionId'=>$question->questionId],true); ?>').resetParam().load();"><i class='fas fa-trash-alt'></i></button>
						 	</td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>
	</section>
</div>