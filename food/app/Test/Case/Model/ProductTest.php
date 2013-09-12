<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jakespicer
 * Date: 21/05/13
 * Time: 4:51 PM
 * To change this template use File | Settings | File Templates.
 */
class ProductTest extends CakeTestCase {


    public $fixtures = array(
        'app.product'
    );

    public function setUp() {
        parent::setUp();
        $this->Product = ClassRegistry::init('Product');
    }

       public function testProductCount(){
           $result = $this->Product->find('count');
           $this->assertEquals(1, $result);
       }

    public function testProductID(){
        $result = $this->Product->find('all');
        $this->assertEquals(0, $result[0]['Product']['id']);
    }

    public function tearDown() {
        unset($this->Product);

        parent::tearDown();
    }
}




