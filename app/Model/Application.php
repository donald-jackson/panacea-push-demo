<?php
App::uses('AppModel', 'Model');
/**
 * Application Model
 *
 * @property Account $Account
 * @property AutomatedMessage $AutomatedMessage
 */
class Application extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'description';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'description' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
	            'settings' => array(
                'rule' => array('checkSettings')
            )
		),
		'type' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
		
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Account' => array(
			'className' => 'Account',
			'foreignKey' => 'account_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'AutomatedMessage' => array(
			'className' => 'AutomatedMessage',
			'foreignKey' => 'application_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
        'Device' => array(
			'className' => 'Device',
			'foreignKey' => 'application_id',
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
    
    function checkSettings() {
        if(isset($this->data['Application']['type']) && ($this->data['Application']['type'] == APP_TYPE_PUBLIC)) {
            /* Needs an API KEY */ 
            if(empty($this->data['Application']['api_key']) || empty($this->data['Application']['application_identifier'])) {
                return false;
            }
        } else {
            /* Needs App Key + Account */
            if(empty($this->data['Application']['account_id']) || empty($this->data['Application']['account_id'])) {
                return false;
            }
        }
	return true;
    }

}
