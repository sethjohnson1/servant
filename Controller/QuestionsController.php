<?php
App::uses('AppController', 'Controller');

class QuestionsController extends AppController {

	public $components = array('Paginator');

	public function beforeFilter() {
		parent::beforeFilter();
	}

	public function admin_index() {
		$this->Question->recursive = 0;
		$this->set('questions', $this->Paginator->paginate());
	}



	public function admin_view($id = null) {
		if (!$this->Question->exists($id)) {
			throw new NotFoundException(__('Invalid question'));
		}
		$options = array('conditions' => array('Question.' . $this->Question->primaryKey => $id));
		//$options['contain']=array('Answer'=>array('order'=>array('Answer.response')));
		//$options['order']=array('Answer.created');
		$options['recursive']=1;
		$question=$this->Question->find('first', $options);
		
		//use tally as one big array
		$tally=array();
		//count responses
		$responses=explode(',',$question['Question']['answers']);
		//flaws counting here, don't explode or we cannot know parent
		foreach ($responses as $r){
			//$r=explode('_',$r);
			$r=trim($r);
			$tally['responses'][$r]=$this->Question->Answer->find('count',array('conditions'=>array('Answer.response'=>$r,'Question.' . $this->Question->primaryKey => $id)));
		}
		//count colors
		$colors=Configure::read('colors');
		foreach ($colors as $c){
			$tally['colors'][$c['name']]=$this->Question->Answer->find('count',array('conditions'=>array('Answer.button_color'=>$c['name'],'Question.' . $this->Question->primaryKey => $id)));
		}
		//count colors
		$terminals=Configure::read('response_terminals');
		foreach ($terminals as $t=>$v){
			$tally['terminals'][$t]=$this->Question->Answer->find('count',array('conditions'=>array('Answer.terminal_name'=>$t,'Question.' . $this->Question->primaryKey => $id)));
		}
		//count positions
		$positions=count($responses);
		for ($i=0; $i<$positions; $i++){
			$tally['positions'][$i]=$this->Question->Answer->find('count',array('conditions'=>array('Answer.position'=>$i,'Question.' . $this->Question->primaryKey => $id)));
		}

		//grand total responses
		$tally['total']=count($question['Answer']);
		
		//find length between first and last answer for "days running" - ok this is interesting but not bothering for now
		$now = new DateTime("2010-07-28 01:11:50");
		$ref = new DateTime("2010-07-30 05:56:40");
		$diff = $now->diff($ref);
		$this->set(compact('question','tally'));
	}
	
	public function admin_export($questionid) {
 		$data = $this->Question->Answer->find('all',array('conditions'=>array('Answer.question_id'=>$questionid),'fields'=>array('Answer.created','Answer.response','Answer.terminal_name','Question.name')));
		//debug($data);
		$this->response->download($data[0]['Question']['name'].'-'.date('Y-m-d').".csv");
		$this->set(compact('data'));
 		$this->layout = 'ajax';
 		return;
 	}


	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Question->create();
			if ($this->Question->save($this->request->data)) {
				$this->Session->setFlash(__('The question has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The question could not be saved. Please, try again.'));
			}
		}
	
		$this->render('admin_edit');
	}


	public function admin_edit($id = null) {
		if (!$this->Question->exists($id)) {
			throw new NotFoundException(__('Invalid question'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Question->save($this->request->data)) {
				$this->Session->setFlash(__('The question has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The question could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Question.' . $this->Question->primaryKey => $id));
			$this->request->data = $this->Question->find('first', $options);
		}
		$edit=1;
		$this->set(compact('edit'));
	}


	public function admin_delete($id = null) {
		$this->Question->id = $id;
		if (!$this->Question->exists()) {
			throw new NotFoundException(__('Invalid question'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Question->delete()) {
			$this->Session->setFlash(__('The question has been deleted.'));
		} else {
			$this->Session->setFlash(__('The question could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
