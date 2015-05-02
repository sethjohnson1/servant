<?php
App::uses('AppController', 'Controller');

class AnswersController extends AppController {

	public $components = array('Paginator');
	
	public function beforeFilter() {
		parent::beforeFilter();
	}


/* 
$question_id = int
*/
	public function add($question_id) {
		if ($this->request->is('post')) {
		//get position of answer and fix up request->data for easy save
		//debug($this->request->data['Answer']['response']);
		$ans=explode(',',$this->request->data['Answer']['response']);
		//remove underscore, later down check and go to next question if needed
		$response=explode('_',$ans[1]);
		$this->request->data['Answer']['response']=$response[0];
		$this->request->data['Answer']['position']=$ans[0];
		$this->request->data['Answer']['ip']=$_SERVER['REMOTE_ADDR'];
		
			$this->Answer->create();
			if ($this->Answer->save($this->request->data)) {
				//$this->Session->setFlash(__('The answer has been saved.'));
				//for testing just go back, eventually need thank you page
				
				//check if there is another question
				if (isset($response[1])) return $this->redirect(array('terminal'=>$this->request->params['terminal'],'controller'=>'answers','action' => 'add',$response[1]));
				else return $this->redirect(array('terminal'=>$this->request->params['terminal'],'controller'=>'answers','action' => 'thanks'));
			} else {
				$this->Session->setFlash(__('The answer could not be saved. Please, try again.'));
			}
			
			
		}
		$question = $this->Answer->Question->find('first',array('conditions'=>array('Question.id'=>$question_id),'recursive'=>-1));
		$responses=explode(',',$question['Question']['answers']);
		//shuffle answers to ensure not skewed by position
		shuffle($responses);
		
		$colors=Configure::read('colors');
		$color=$colors[0];
		$this->set(compact('responses','color','question','question_id'));
		$this->render('add','bootstrap3');
	}
	
	public function admin_index() {
		$this->Answer->recursive = 0;
		$this->set('answers', $this->Paginator->paginate());
	}
	public function thanks(){
		$this->render('thanks','bootstrap3');
	}

}
