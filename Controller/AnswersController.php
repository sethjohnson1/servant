<?php
App::uses('AppController', 'Controller');

class AnswersController extends AppController {

	public $components = array('Paginator');


/* I could probably just move this all to one controller for such a simple app 
$question_id = int (obvious?)
$terminal_id = POD / location of the survey device
*/
	public function add($question_id,$terminal_id=null) {
		if ($this->request->is('post')) {
		//get position of answer and fix up request->data for easy save
		$ans=explode(',',$this->request->data['Answer']['response']);
		$this->request->data['Answer']['response']=$ans[1];
		$this->request->data['Answer']['position']=$ans[0];
		$this->request->data['Answer']['ip']=$_SERVER['REMOTE_ADDR'];
	//	debug($this->request->data);
		//debug($_SERVER['REMOTE_ADDR']);
			$this->Answer->create();
			if ($this->Answer->save($this->request->data)) {
				$this->Session->setFlash(__('The answer has been saved.'));
				//for testing just go back, eventually need thank you page
				//return $this->redirect(array('admin'=>true,'controller'=>'questions','action' => 'index'));
			} else {
				$this->Session->setFlash(__('The answer could not be saved. Please, try again.'));
			}
			
			
		}
		$question = $this->Answer->Question->find('first',array('conditions'=>array('Question.id'=>$question_id),'recursive'=>-1));
		$responses=explode(',',$question['Question']['answers']);
		//shuffle answers to ensure not skewed by position
		shuffle($responses);
		$terminals = $this->Answer->Terminal->find('list');
		$this->set(compact('responses','question','terminals','question_id','terminal_id'));
		$this->render('add','bootstrap3');
	}

}
