<?php

	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));

	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	
	//Router::connect('/admin/*', array('controller' => 'pages', 'action' => 'display'));
	
	//sj -added the terminal here, makes admin routing not work so well..
	Router::connect('/:terminal/:controller/:action/*',array(),array());
	
	Router::connect('/{$prefix}/:controller/:action/*',array('admin'=>true),array());
	
	//example of defining our terminals, the key is the terminal name and the value is the ID of the default question (for rapid deployment of alternate questions and terminals)
	$response_terminals=array(
		'base2'=>1,
		'base3'=>1,
		'pod1'=>1,
		'pod6'=>2
	);
	
	foreach ($response_terminals as $terminal=>$question){
		//using 302 here so they don't get cached and assuming they might need to change from time to time
		Router::redirect('/'.$terminal, array('terminal'=>$terminal,'controller' => 'answers', 'action' => 'add', $question),array('status'=>'302'));
	}


	CakePlugin::routes();
	require CAKE . 'Config' . DS . 'routes.php';
