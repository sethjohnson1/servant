<style>
.button-section{
	margin: 10px;
}
.btn-primary{
  background-image: -webkit-linear-gradient(top,#<?=$color['values'][0]?> 0,#<?=$color['values'][1]?> 100%);
  background-image: -o-linear-gradient(top,#<?=$color['values'][0]?> 0,#<?=$color['values'][1]?> 100%);
  background-image: -webkit-gradient(linear,left top,left bottom,from(#<?=$color['values'][0]?>),to(#<?=$color['values'][1]?>));
  background-image: linear-gradient(to bottom,#<?=$color['values'][0]?> 0,#<?=$color['values'][1]?> 100%);
}
</style>
<div class="answers form">
<?php echo $this->Form->create('Answer'); ?>
	<h1>
	<?php
		//debug($this->request->params['terminal']);
		//this is the question text
		echo $question['Question']['name'];
		echo $this->Form->input('question_id',array('value'=>$question_id,'type'=>'hidden'));
		?>
		</h1>
		<br />
		<?
		//read terminal value from params set in router
		echo $this->Form->input('terminal_name',array('type'=>'hidden','value'=>$this->request->params['terminal']));
		echo $this->Form->input('button_color',array('type'=>'hidden','value'=>$color['name']));
		foreach ($responses as $k=>$v):?>
		<div class="button-section">
		<?
		//echo $this->Form->input('position',array('value'=>$question_id,'type'=>'hidden'));
		$text=explode('_',$v);
		echo $this->Form->button($text[0],array('value'=>$k.','.$v,'name'=>'data[Answer][response]','class'=>'btn btn-lg btn-primary btn-block','onclick'=>'play()'));
		
		?>
		</div>
		<?
		endforeach;
		echo $this->Form->end(); ?>
</div>
<audio id="sound1" src="<?=$this->webroot?>sounds/Blop-Mark_DiAngelo-79054334.mp3"></audio>

    <script>
  function play(){
	  console.log('hrey');
       var audio = document.getElementById("sound1");
       audio.play();
                 }
   </script>
