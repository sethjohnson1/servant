<?php
App::uses('AppModel', 'Model');

class Terminal extends AppModel {


	public $hasMany = array(
		'Answer' => array(
			'className' => 'Answer',
			'foreignKey' => 'terminal_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
