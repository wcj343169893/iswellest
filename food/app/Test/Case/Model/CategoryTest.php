<?php
App::uses('Category', 'Model');

/**
 * Category Test Case
 *
 */
class CategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Category = ClassRegistry::init('Category');
	}

    public function testCategoryCount(){
        $result = $this->Category->find('count');
        $this->assertEquals(3, $result);
    }





/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Category);

		parent::tearDown();
	}

}