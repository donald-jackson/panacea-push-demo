<?php
App::uses('AppController', 'Controller');
/**
 * Devices Controller
 *
 * @property Device $Device
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class DevicesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'RequestHandler');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Device->recursive = 0;
		$this->Device->unbindModel(array('belongsTo' => 'Application'));
		$devices = $this->Device->find('all');
		$this->set(array(
            'devices' => $devices,
            '_serialize' => array('devices')
        ));
	}
	
	private function get_search_conditions() {
        

        $search = $this->Session->read('search_data');

        $conditions = array();
        if (!empty($search)) {
            $conditions = array(
                'OR' => array(
                    'Device.device_name LIKE ' => $search . '%',
                    'Device.device_id LIKE ' => $search . '%'
                )
            );
        }
    

        return $conditions;
    }

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		if ($this->request->is('post')) {
            $this->Session->write('search_data', $this->request->data['Device']['search']);
            $this->redirect(array('index'));
        }
        
        $conditions = $this->get_search_conditions();
		$this->Device->recursive = 0;
		$this->set('devices', $this->Paginator->paginate($conditions));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Device->exists($id)) {
			throw new NotFoundException(__('Invalid device'));
		}
		$this->Device->recursive = 0;		
		$options = array('conditions' => array('Device.' . $this->Device->primaryKey => $id));
		$this->set('device', $device = $this->Device->find('first', $options));

		if($this->request->is('post')) {
			/* User sent a message */
			$this->Device->Application->recursive = 0;
			$app = $this->Device->Application->find('first', array(
				'conditions' => array(
					'Application.id' => $device['Device']['application_id']
				)
			));
			
			$message = $this->request->data;

			
   		    if ($app['Application']['type'] == APP_TYPE_PRIVATE) {
                $answer = AppController::doApiCall("push_outbound_message_send", array(
                    "username" => $app['Account']['username'],
                    "password" => Security::decrypt($app['Account']['password'], Configure::read('Labs.EncryptionKey')),
                    "application_key" => $app['Application']['application_key'],
                    "subject" => $message['Message']['subject'],
                    "message" => $message['Message']['message'],
                    "device_id" => $device['Device']['device_id'],
                    "thread_id" => $message['Message']['thread']
                        ), Configure::read('Labs.CoreApiUrl')
                );
            } else {
                $answer = AppController::doApiCall("push_public_outbound_message_send", array(
                        "api_key" => $app['Application']['api_key'],
                        "message" => $message['Message']['message'],
                        'device_id' => $device['Device']['device_id'],
	                "thread_id" => $message['Message']['thread']
                    ), Configure::read('Labs.CoreApiUrl')
                );
            }
            
            if($answer >= 0) {
            	$this->Session->setFlash(__('Message Sent!'), 'default', array('class' => 'alert alert-success'));
            } else {
            	$this->Session->setFlash(sprintf(__('Message could not be sent %s'), $this->getError($answer)), 'default', array('class' => 'alert alert-danger'));            
            }
              
		}
		

	}


/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Device->id = $id;
		if (!$this->Device->exists()) {
			throw new NotFoundException(__('Invalid device'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Device->delete()) {
			$this->Session->setFlash(__('The device has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The device could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
