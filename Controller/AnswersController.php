<?php
App::uses('AppController', 'Controller');

class AnswersController extends AppController {

	public $components = array('Paginator');


/* I could probably just move this all to one controller for such a simple app 
$question_id = int (obvious?)
$terminal_id = POD / location of the survey device
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
		
		//debug($this->request->data);
		//debug($_SERVER['REMOTE_ADDR']);
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
		//set colors and then randomly pick one, the first value is the lighter and the second the darker for the gradient
		$colors=array(
			5=>array('name'=>'brown','values'=>array('a14a25','6e3219')),
			0=>array('name'=>'blue','values'=>array('006c82','004250')),
			1=>array('name'=>'green','values'=>array('048a6b','035642')),
			2=>array('name'=>'red','values'=>array('cc2944','981e32')),
			3=>array('name'=>'orange','values'=>array('f0651f','bd4f19')),
			4=>array('name'=>'purple','values'=>array('7f4794','532e60'))
		);
		shuffle($colors);
		$color=$colors[0];
		$this->set(compact('responses','color','question','question_id'));
		$this->render('add','bootstrap3');
	}
	
	public function thanks(){
		$this->render('thanks','bootstrap3');
	}

}
