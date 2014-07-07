<?php
App::uses('AppController', 'Controller');
/**
 * AutomatedMessages Controller
 *
 * @property AutomatedMessage $AutomatedMessage
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AutomatedMessagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->AutomatedMessage->recursive = 0;
		$this->set('automatedMessages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AutomatedMessage->exists($id)) {
			throw new NotFoundException(__('Invalid automated message'));
		}
		$options = array('conditions' => array('AutomatedMessage.' . $this->AutomatedMessage->primaryKey => $id));
		$this->set('automatedMessage', $this->AutomatedMessage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AutomatedMessage->create();
			if ($this->AutomatedMessage->save($this->request->data)) {
				$this->Session->setFlash(__('The automated message has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The automated message could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$applications = $this->AutomatedMessage->Application->find('list');
		$this->set(compact('applications'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->AutomatedMessage->exists($id)) {
			throw new NotFoundException(__('Invalid automated message'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AutomatedMessage->save($this->request->data)) {
				$this->Session->setFlash(__('The automated message has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The automated message could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('AutomatedMessage.' . $this->AutomatedMessage->primaryKey => $id));
			$this->request->data = $this->AutomatedMessage->find('first', $options);
		}
		$applications = $this->AutomatedMessage->Application->find('list');
		$this->set(compact('applications'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->AutomatedMessage->id = $id;
		if (!$this->AutomatedMessage->exists()) {
			throw new NotFoundException(__('Invalid automated message'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AutomatedMessage->delete()) {
			$this->Session->setFlash(__('The automated message has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The automated message could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->AutomatedMessage->recursive = 0;
		$this->set('automatedMessages', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->AutomatedMessage->exists($id)) {
			throw new NotFoundException(__('Invalid automated message'));
		}
		$options = array('conditions' => array('AutomatedMessage.' . $this->AutomatedMessage->primaryKey => $id));
		$this->set('automatedMessage', $this->AutomatedMessage->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->AutomatedMessage->create();
			if ($this->AutomatedMessage->save($this->request->data)) {
				$this->Session->setFlash(__('The automated message has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The automated message could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$applications = $this->AutomatedMessage->Application->find('list');
		$this->set(compact('applications'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->AutomatedMessage->exists($id)) {
			throw new NotFoundException(__('Invalid automated message'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AutomatedMessage->save($this->request->data)) {
				$this->Session->setFlash(__('The automated message has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The automated message could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('AutomatedMessage.' . $this->AutomatedMessage->primaryKey => $id));
			$this->request->data = $this->AutomatedMessage->find('first', $options);
		}
		$applications = $this->AutomatedMessage->Application->find('list');
		$this->set(compact('applications'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->AutomatedMessage->id = $id;
		if (!$this->AutomatedMessage->exists()) {
			throw new NotFoundException(__('Invalid automated message'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AutomatedMessage->delete()) {
			$this->Session->setFlash(__('The automated message has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The automated message could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
