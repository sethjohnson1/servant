<style>
.button-section{
	margin: 10px;
	
}
</style>
<div class="answers form">
<?php echo $this->Form->create('Answer'); ?>
	<h1><?php
		//debug($responses);
		//this is the question text
		echo $question['Question']['name'];
		echo $this->Form->input('question_id',array('value'=>$question_id,'type'=>'hidden'));
		?>
		</h1>
		<?
		//eventually make this hidden and URL based as well, for testing it's easier to pick one
		echo $this->Form->input('terminal_id',array('readonly'=>'readonly','label'=>'Terminal. this is the second value in the URL and will be hidden soon'));
		foreach ($responses as $k=>$v):?>
		<div class="button-section">
		<?
		//echo $this->Form->input('position',array('value'=>$question_id,'type'=>'hidden'));
		echo $this->Form->button($v,array('value'=>$k.','.$v,'name'=>'data[Answer][response]','class'=>'btn btn-lg btn-primary btn-block'))
		
		?>
		</div>
		<?
		endforeach;
		echo $this->Form->end(); ?>
</div>
