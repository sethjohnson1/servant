<?php

App::uses('Controller', 'Controller');


class AppController extends Controller {

	public $components = array('Session','DebugKit.Toolbar');
 
 	public function beforeFilter() {
		parent::beforeFilter();
	}
 
}
