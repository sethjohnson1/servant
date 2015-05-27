<div class="answers index">
	<h2><?php echo __('Answers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('question_id'); ?></th>
			<th><?php echo $this->Paginator->sort('response'); ?></th>
			<th><?php echo $this->Paginator->sort('terminal_name'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($answers as $answer): ?>
	<tr>
		<td><?php echo h($answer['Answer']['created']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($answer['Question']['name'], array('controller' => 'questions', 'action' => 'view', $answer['Question']['id'])); ?>
		</td>
		<td><?php echo h($answer['Answer']['response']); ?>&nbsp;</td>
		<td><?php echo h($answer['Answer']['terminal_name']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php // echo $this->Html->link(__('New Answer'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
	</ul>
</div>
