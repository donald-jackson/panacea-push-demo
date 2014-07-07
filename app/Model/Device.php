<?php
App::uses('AppModel', 'Model');
/**
 * Device Model
 *
 */
class Device extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'device_name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'device_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);
	
	public $belongsTo = array(
		'Application' => array(
			'className' => 'Application',
			'foreignKey' => 'application_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
