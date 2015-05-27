<div class="questions view">
<h2><?php echo __($question['Question']['name']); ?></h2>

<table>
<thead>
<tr>
<th>Response</th>
<th>Count</th>
</tr>
</thead>
<tbody>

<?foreach ($tally['responses'] as $k=>$v):?>
<tr><td><?=$k?></td><td><?=$v?></td></tr>
<?endforeach?>
<tr><td><b>Total</b></td><td><b><?=$tally['total']?></b></td></tr>
</tbody>
</table>

<table>
<thead>
<tr>
<th>Color</th>
<th>Count</th>
</tr>
</thead>
<tbody>

<?foreach ($tally['colors'] as $k=>$v):?>
<tr><td><?=$k?></td><td><?=$v?></td></tr>
<?endforeach?>
</tbody>
</table>

<table>
<thead>
<tr>
<th>Position</th>
<th>Count</th>
</tr>
</thead>
<tbody>

<?foreach ($tally['positions'] as $k=>$v):?>
<tr><td><?=$k?></td><td><?=$v?></td></tr>
<?endforeach?>
</tbody>
</table>
</div>
<?//debug($tally)?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php // echo $this->Html->link(__('Edit Question'), array('action' => 'edit', $question['Question']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Question'), array('action' => 'delete', $question['Question']['id']), array(), __('Are you sure you want to delete # %s?', $question['Question']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Answers'), array('controller' => 'answers', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Answer'), array('controller' => 'answers', 'action' => 'add')); ?> </li>
	</ul>
</div>

