<?php
App::uses('AppModel', 'Model');
/**
 * Account Model
 *
 * @property Application $Application
 */
class Account extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'username';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => array('checkCredentials'),
				'message' => 'Your credentials are invalid, please try again',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Application' => array(
			'className' => 'Application',
			'foreignKey' => 'account_id',
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
    
    
    public function beforeSave($options = array()) {
        if(isset($this->data['Account']['password'])) {
            /* Encrypt */
            $this->data['Account']['password'] = Security::encrypt($this->data['Account']['password'], Configure::read('Labs.EncryptionKey'));
        }
        
    }
    
    public function checkCredentials() {
        if(isset($this->data['Account']['username']) && isset($this->data['Account']['password'])) {
            if(!empty($this->data['Account']['username']) && !empty($this->data['Account']['password'])) {
                $state = AppController::doApiCall("user_get_balance", array(
                    'username' => $this->data['Account']['username'],
                    'password' => $this->data['Account']['password']
                ));
                if($state < 0) {
                    return false;
                }
            }
        }
        return true;
    }

}
