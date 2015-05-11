<style>
.button-section{
	margin: 10px;
	
}
</style>
<h1>Thank you and enjoy your visit.</h1>
<p>This page will automatically close in 5 seconds.</p>
<?//debug($this->webroot)?>
<br />
<?=$this->Html->link('No problem','/'.$this->request->params['terminal'],array('class'=>'btn btn-lg btn-primary btn-block','role'=>'button'))?>



