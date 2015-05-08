<?php

App::uses('Controller', 'Controller');


class AppController extends Controller {

	public $components = array('Session','DebugKit.Toolbar','Auth');
 
 	public function beforeFilter() {
		parent::beforeFilter();
		
			//set colors then shuffle, the first value is the lighter and the second the darker for the gradient
		$colors=array(
				0=>array('name'=>'brown','values'=>array('a14a25','6e3219')),
				1=>array('name'=>'blue','values'=>array('006c82','004250')),
				2=>array('name'=>'green','values'=>array('048a6b','035642')),
				3=>array('name'=>'red','values'=>array('cc2944','981e32')),
				4=>array('name'=>'orange','values'=>array('f0651f','bd4f19')),
				5=>array('name'=>'purple','values'=>array('7f4794','532e60'))
		);
		shuffle($colors);
		Configure::write('colors',$colors);
		
		if (Configure::read('enableAdminFunctions')==1) $this->Auth->allow();
	}
 
}
