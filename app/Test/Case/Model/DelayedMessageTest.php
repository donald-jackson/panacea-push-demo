<?php
App::uses('DelayedMessage', 'Model');

/**
 * DelayedMessage Test Case
 *
 */
class DelayedMessageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.delayed_message',
		'app.application',
		'app.account',
		'app.automated_message',
		'app.device'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DelayedMessage = ClassRegistry::init('DelayedMessage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DelayedMessage);

		parent::tearDown();
	}

}
