<?php
App::uses('Affiliate', 'Model');

/**
 * Affiliate Test Case
 *
 */
class AffiliateTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.affiliate'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Affiliate = ClassRegistry::init('Affiliate');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Affiliate);

		parent::tearDown();
	}

}
