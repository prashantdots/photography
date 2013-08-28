<?php
App::uses('EmailsTemplate', 'Model');

/**
 * EmailsTemplate Test Case
 *
 */
class EmailsTemplateTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.emails_template'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->EmailsTemplate = ClassRegistry::init('EmailsTemplate');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->EmailsTemplate);

		parent::tearDown();
	}

}
