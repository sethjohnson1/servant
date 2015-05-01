<?
if (isset($edit)) $title='Edit';
else $title='Add';
?>
<div class="questions form">
<?php echo $this->Form->create('Terminal'); ?>
	<fieldset>
		<legend><?php echo __($title.' Terminal'); ?></legend>
	<?php
		if (isset($edit)){
			echo $this->Form->input('id');
		}
		echo $this->Form->input('name',array('label'=>'Descriptive name of location'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Terminal.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Terminal.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Terminals'), array('action' => 'index')); ?></li>
		<li><?php //echo $this->Html->link(__('List Answers'), array('controller' => 'answers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Answer'), array('admin'=>false,'controller' => 'answers', 'action' => 'add')); ?> </li>
	</ul>
</div>
