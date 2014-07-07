<?php
App::uses('AutomatedMessage', 'Model');

/**
 * AutomatedMessage Test Case
 *
 */
class AutomatedMessageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.automated_message',
		'app.application',
		'app.account'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AutomatedMessage = ClassRegistry::init('AutomatedMessage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AutomatedMessage);

		parent::tearDown();
	}

}
