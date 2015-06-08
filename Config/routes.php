<?php
	//Router::parseExtensions('json');
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	
	//Router::connect('/admin/*', array('controller' => 'pages', 'action' => 'display'));
	
	//sj - changed routes here, remember that order matters, so connect admin first
	Router::connect( '/admin/:controller/:action/*', array('prefix' => 'admin', 'admin' => true));
	
	//sj - also connect save for AJAX save here..
	Router::connect( '/answers/save/*', array('action'=>'save','admin'=>false,'controller'=>'answers'));
	
	Router::connect('/:terminal/:controller/:action/*',array(),array());
	
	$response_terminals=Configure::read('response_terminals');
	
	foreach ($response_terminals as $terminal=>$question){
		//using 302 here so they don't get cached and assuming they might need to change from time to time
		Router::redirect('/'.$terminal, array('terminal'=>$terminal,'controller' => 'answers', 'action' => 'add', $question),array('status'=>'302'));
		$defaultterm=$terminal;
	}
	
	Router::redirect('/', array('terminal'=>$defaultterm,'controller' => 'answers', 'action' => 'add', 1),array('status'=>'302'));
	
	


	CakePlugin::routes();
	require CAKE . 'Config' . DS . 'routes.php';
