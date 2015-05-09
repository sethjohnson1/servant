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
<?php 
if (isset($this->request->params['terminal'])) $term=$this->request->params['terminal'];
else $term=$terminal;
echo $this->Form->create('Answer',array('id'=>'form'.$question_id)); 
//echo $this->Form->create('Answer'); 

?>
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
		//if (isset($this->request->params['terminal']))
		echo $this->Form->input('terminal_name',array('type'=>'hidden','value'=>$term));
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
		
		    <script>
  function play(){
       var audio = document.getElementById("sound1");
       audio.play();
   };
   $(document).ready(function() {
      timer= window.setTimeout(function(){window.location.href = "<?=$this->webroot.$term?>"},5000);
     $('.btn').click(function(evt) {

		$.blockUI({message:'<?=$this->Html->image('ajax-loader.gif')?>'}); 
        //$.blockUI({message:'<h1>Thank you</h1>'}); 	
		//setTimeout($.unblockUI, 2000); 	
		
		var button = $(evt.target);
		var button_value=encodeURI(button.attr('value'));
		$.ajax({
		async:true,
		data:$("#form<?=$question_id?>").serialize(),
		dataType:"html",
		success:function (data, textStatus) {
		if (data=='done'){
			$('#answers').replaceWith('<h1>Thank you and enjoy your visit.</h1>');
			window.clearTimeout(timer);
			timer= window.setTimeout(function(){window.location.href = "<?=$this->webroot.$term?>"},1000);
		}
		else{
			$ ("#form<?=$question_id?>").remove();
			window.clearTimeout(timer);
			timer= window.setTimeout(function(){window.location.href = "<?=$this->webroot.$term?>"},5000);
			$(data).appendTo('#answers');
		}
			//console.log(data);
			$.unblockUI();
		},
		type:"POST",
		url:"<? echo Configure::read('globalSiteURL'); ?>/answers/save/"+button_value+"/<?=$term?>"});
		return false;
    }); 
	

	});
	
   </script>