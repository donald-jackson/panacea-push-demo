<?php

App::uses('AppController', 'Controller');

/**
 * Applications Controller
 *
 * @property Application $Application
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ApplicationsController extends AppController {

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
        $this->Application->recursive = 0;
        $this->set('applications', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Application->exists($id)) {
            throw new NotFoundException(__('Invalid application'));
        }
        $options = array('conditions' => array('Application.' . $this->Application->primaryKey => $id));
        $this->set('application', $this->Application->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Application->create();
            if ($this->Application->save($this->request->data)) {
                $this->Session->setFlash(__('The application has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The application could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }
        $accounts = $this->Application->Account->find('list');
        $this->set(compact('accounts'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Application->exists($id)) {
            throw new NotFoundException(__('Invalid application'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Application->save($this->request->data)) {
                $this->Session->setFlash(__('The application has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The application could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Application.' . $this->Application->primaryKey => $id));
            $this->request->data = $this->Application->find('first', $options);
        }
        $accounts = $this->Application->Account->find('list');
        $this->set(compact('accounts'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Application->id = $id;
        if (!$this->Application->exists()) {
            throw new NotFoundException(__('Invalid application'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Application->delete()) {
            $this->Session->setFlash(__('The application has been deleted.'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('The application could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->Application->recursive = 0;
        $this->set('applications', $this->Paginator->paginate());
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        if (!$this->Application->exists($id)) {
            throw new NotFoundException(__('Invalid application'));
        }
        $options = array('conditions' => array('Application.' . $this->Application->primaryKey => $id));
        $this->set('application', $this->Application->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Application->create();
            if ($this->Application->save($this->request->data)) {
                $this->Session->setFlash(__('The application has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The application could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }
        $accounts = $this->Application->Account->find('list');
        $this->set(compact('accounts'));
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        if (!$this->Application->exists($id)) {
            throw new NotFoundException(__('Invalid application'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Application->save($this->request->data)) {
                $this->Session->setFlash(__('The application has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The application could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Application.' . $this->Application->primaryKey => $id));
            $this->request->data = $this->Application->find('first', $options);
        }
        $accounts = $this->Application->Account->find('list');
        $this->set(compact('accounts'));
    }

    /**
     * admin_delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        $this->Application->id = $id;
        if (!$this->Application->exists()) {
            throw new NotFoundException(__('Invalid application'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Application->delete()) {
            $this->Session->setFlash(__('The application has been deleted.'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('The application could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function process_notifications() {
        $delayed = ClassRegistry::init('DelayedMessage');
        if (isset($_REQUEST['push_application_key'])) {
            /* Private application */

            $app = $this->Application->find('first', array(
                'conditions' => array(
                    'Application.application_key' => $_REQUEST['push_application_key']
                )
                    ));
            if (!empty($app)) {
                $device = $this->Application->Device->find('first', array(
                    'conditions' => array(
                        'Device.device_id' => $_REQUEST['push_device_id']
                    )
                        ));

                switch ($_REQUEST['push_event']) {
		    		case EVENT_DEVICE_READY:
                    case EVENT_DEVICE_ADDED:
                        if (empty($device)) {
                            $this->Application->Device->create();
                            if (!$this->Application->Device->save(
                                            array('Device' => array(
                                                    'device_id' => $_REQUEST['push_device_id'],
                                                    'device_name' => isset($_REQUEST['push_device_name']) ? $_REQUEST['push_device_name'] : __('Unspecified'),
                                                    'application_id' => $app['Application']['id']
                                            ))
                            )) {
                                
                            }
                        }
                        break;                    
                }

                $device = $this->Application->Device->find('first', array(
                    'conditions' => array(
                        'Device.device_id' => $_REQUEST['push_device_id']
                    )
                ));


                $messages = $this->Application->AutomatedMessage->find('all', array(
                    'conditions' => array(
                        'AutomatedMessage.event_type' => $_REQUEST['push_event']
                    )
                        ));

                foreach ($messages as $message) {
                	if($message['AutomatedMessage']['event_type'] == EVENT_MESSAGE_RECEIVED) {
                		if(!empty($message['AutomatedMessage']['message_contains'])) {
                			$lower = strtolower($message['AutomatedMessage']['message_contains']);
                			$data = strtolower($_REQUEST['push_message']);
                			
                			if(strstr($data, $lower) === FALSE) {
                				/* Not here */
                				continue;
                			}
                		}
                	}

                    if ($message['AutomatedMessage']['delay_by_seconds']) {
                        /* We need to queue */
                        $delayed->create();
                        $delayed->save(array(
                            'DelayedMessage' => array(
                                'subject' => $message['AutomatedMessage']['subject'],
                                'message' => $message['AutomatedMessage']['message'],
                                'application_id' => $app['Application']['id'],
                                'send_time' => strftime("%Y-%m-%d %H:%M:%S", strtotime("+{$message['AutomatedMessage']['delay_by_seconds']} seconds")),
                                'device_id' => $device['Device']['device_id']
                            )
                        ));
                    } else {
                        AppController::doApiCall("push_outbound_message_send", array(
                            "username" => $app['Account']['username'],
                            "password" => Security::decrypt($app['Account']['password'], Configure::read('Labs.EncryptionKey')),
                            "application_key" => $app['Application']['application_key'],
                            "subject" => $message['AutomatedMessage']['subject'],
                            "thread_id" => $message['AutomatedMessage']['subject'],                            
                            "message" => $message['AutomatedMessage']['message'],
                            'device_id' => $device['Device']['device_id']
                            ), Configure::read('Labs.CoreApiUrl')
                        );
                    }
                }
		echo "OK";
            } else {
	        echo "Unknown Application";
	    }
        } elseif (!empty($_REQUEST['push_application_identifier'])) {
            $app = $this->Application->find('first', array(
                'conditions' => array(
                    'Application.application_identifier' => $_REQUEST['push_application_identifier']
                )
                    ));

            if (!empty($app)) {
                $device = $this->Application->Device->find('first', array(
                    'conditions' => array(
                        'Device.device_id' => $_REQUEST['push_device_id']
                    )
                        ));

                if (empty($device)) {
                    $this->Application->Device->create();
                    if (!$this->Application->Device->save(
                                    array('Device' => array(
                                            'device_id' => $_REQUEST['push_device_id'],
                                            'device_name' => isset($_REQUEST['push_device_name']) ? $_REQUEST['push_device_name'] : __('Unspecified'),
                                            'application_id' => $app['Application']['id']
                                    ))
                    )) {
                        
                    }
                    $device = $this->Application->Device->find('first', array(
                        'conditions' => array(
                            'Device.device_id' => $_REQUEST['push_device_id']
                        )
                    ));
                }


                $messages = $this->Application->AutomatedMessage->find('all', array(
                    'conditions' => array(
                        'AutomatedMessage.event_type' => $_REQUEST['push_event']
                    )
                        ));

                foreach ($messages as $message) {
                    if ($message['AutomatedMessage']['delay_by_seconds']) {
                        /* We need to queue */
                        $delayed->create();
                        $delayed->save(array(
                            'DelayedMessage' => array(
                                'message' => $message['AutomatedMessage']['message'],
                                'application_id' => $app['Application']['id'],
                                'send_time' => strftime("%Y-%m-%d %H:%M:%S", strtotime("+{$message['AutomatedMessage']['delay_by_seconds']} seconds")),
                                'device_id' => $device['Device']['device_id']
                            )
                        ));
                    } else {
                        AppController::doApiCall("push_public_outbound_message_send", array(
                            "api_key" => $app['Application']['api_key'],
                            "message" => $message['AutomatedMessage']['message'],
                            "thread_id" => $message['AutomatedMessage']['subject'],
                            'device_id' => $device['Device']['device_id']
                                ), Configure::read('Labs.CoreApiUrl')
                        );
                    }
                }
            }

            echo "OK";
        } else {
            echo "Unknown Request";
        }



        $this->autoRender = false;
    }

    public function process_delayed_messages() {
        $delayed = ClassRegistry::init('DelayedMessage');
        $delayed->recursive = 0;

        $messages = $delayed->find('all', array(
            'conditions' => array(
                'DelayedMessage.send_time <' => strftime("%Y:%m:%d %H:%M:%S")
            )
                ));

        $apps = array();

        $delete = array();

        foreach ($messages as $message) {
            if (!isset($apps[$message['DelayedMessage']['application_id']])) {
                $apps[$message['DelayedMessage']['application_id']] = $this->Application->find('first', array('conditions' => array('Application.id' => $message['DelayedMessage']['application_id'])));
            }

            if (!empty($apps[$message['DelayedMessage']['application_id']])) {
                $app = $apps[$message['DelayedMessage']['application_id']];
                if ($app['Application']['type'] == APP_TYPE_PRIVATE) {
                    AppController::doApiCall("push_outbound_message_send", array(
                        "username" => $app['Account']['username'],
                        "password" => Security::decrypt($app['Account']['password'], Configure::read('Labs.EncryptionKey')),
                        "application_key" => $app['Application']['application_key'],
                        "subject" => $message['DelayedMessage']['subject'],
                        "thread_id" => $message['DelayedMessage']['subject'],                        
                        "message" => $message['DelayedMessage']['message'],
                        "device_id" => $message['DelayedMessage']['device_id']
                            ), Configure::read('Labs.CoreApiUrl')
                    );
                } else {
                    AppController::doApiCall("push_public_outbound_message_send", array(
                            "api_key" => $app['Application']['api_key'],
                            "message" => $message['AutomatedMessage']['message'],
                            'device_id' => $device['Device']['device_id'],
                            "thread_id" => $message['AutomatedMessage']['subject']
                        ), Configure::read('Labs.CoreApiUrl')
                    );
                }
            }
            
            $delete[] = $message['DelayedMessage']['id'];
        }
        
        $delayed->deleteAll(array('DelayedMessage.id' => $delete));
        
        $this->autoRender = false;
    }

}
