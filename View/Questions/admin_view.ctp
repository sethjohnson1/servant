<div class="questions view">
<h2><?php echo __($question['Question']['name']); ?></h2>
<p><?=$this->Html->link('export to CSV',array('action'=>'export',$question['Question']['id']))?></p>

<table>
<thead>
<tr>
<th>Response</th>
<th>Count</th>
<th>Percentage</th>
</tr>
</thead>
<tbody>

<?
$ptot=0;
foreach ($tally['responses'] as $k=>$v):
$k=explode('_',$k);
if (isset($k[1])) $text=$this->Html->link($k[0],array('action'=>'view',$k[1]));
else $text=$k[0];
?>
<tr><td><?=$text?></td><td><?=$v?></td><td>
<?
//find percent and total
$percent=round(($v/$tally['total'])*100,1);
echo $percent.'%';
$ptot=$percent+$ptot;

?></td></tr>
<?endforeach?>
<tr><td><b>Total</b></td><td><b><?=$tally['total']?></b></td><td><?=round($ptot)?>%</td></tr>
</tbody>
</table>

<table>
<thead>
<tr>
<th>Color</th>
<th>Count</th>
<th>Percentage</th>
</tr>
</thead>
<tbody>

<?
$ptot=0;
foreach ($tally['colors'] as $k=>$v):?>
<tr><td><?=$k?></td><td><?=$v?></td><td><?=round(($v/$tally['total'])*100,1)?>%</td>
</tr>
<?endforeach?>
</tbody>
</table>

<table>
<thead>
<tr>
<th>Position</th>
<th>Count</th>
<th>Percentage</th>
</tr>
</thead>
<tbody>

<?foreach ($tally['positions'] as $k=>$v):?>
<tr><td><?=$k?></td><td><?=$v?></td><td><?=round(($v/$tally['total'])*100,1)?>%</td></tr>
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

