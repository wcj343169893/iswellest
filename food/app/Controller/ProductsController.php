<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 */
class ProductsController extends AppController {

/**
 * index method
 *
 * @return void
 */
    public $components = array('Filter.Filter');

    public $filters = array
    (

        'index' => array
        (
            'Product' => array
            (
                'name || description' => array('label'=>'Keyword','condition LIKE' => '='),
                'cateID' => array(
                    'type' => 'select','label'=>'Category',
                ),
                'Price' => array(
                    'type' => 'select','label'=>'Price',
                ),

            )
        )
    );

	public function index() {
        $categories = $this->Product->Category->find('list',array('order'=>'name ASC'),array('fields'=>array('id','name')));
        $this->set('categories', $categories);


        $this->paginate = array ('limit' => 5, 'order' => array ('Product.name'=>'asc'));

        $this->Product->recursive = 0;
        $this->set('products', $this->paginate());
        $this->set('variable', $this->Product->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$product = $this->Product->find('first', array(
				'recursive' => -1,
				'contain' => array(
						'Category',
						'Manufacturer'
				),
				'conditions' => array(
						'Product.active' => 1,
						'Product.slug' => $id
				)
		));
		if (empty($product)) {
			$this->redirect(array('action' => 'index'), 301);
		}
		
		$this->Product->updateAll(
				array(
						'Product.views' => 'Product.views + 1',
				),
				array('Product.id' => $product['Product']['id'])
		);
		
		$this->set(compact('product'));
		
		$this->set('title_for_layout', $product['Product']['name'] . ' ' . Configure::read('Settings.SHOP_TITLE'));
	
        $categories = $this->Product->Category->find('list',array('order'=>'name ASC'),array('fields'=>array('id','name')));
        $this->set('categories', $categories);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
        $categories = $this->Product->Category->find('list',array('order'=>'name ASC'),array('fields'=>array('id','name')));
        $this->set('categories', $categories);

		if ($this->request->is('post')) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        $categories = $this->Product->Category->find('list',array('order'=>'name ASC'),array('fields'=>array('id','name')));
        $this->set('categories', $categories);

		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Product->delete()) {
			$this->Session->setFlash(__('Product deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Product was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

    public function search($name = null){
        $categories = $this->Product->Category->find('list',array('order'=>'type ASC'),array('fields'=>array('id','name')));
        $this->set('categories', $categories);

        //old search code
        /*  $conditions = array('name LIKE' => $name);
          $this->set('products', $this->Product->find('all', array(
                      'condition' => $conditions)),$this->paginate()); */

        //Janet's Code
        if (!isset( $this->data['Search']))
        {
            $this->set('products', $this->paginate());
        }
        else
        {
            //this will be executed if the user enters a name and selects a category
            if($this->data['Product']['pname'] != '' && $this->data['Product']['cat'] != '')
            {
                $conditions = array("Product.cateID" => $this->data['Product']['cat'], "Product.name LIKE" => "%".$this->data['Product']['pname']."%");
                $this->paginate = array('conditions' => $conditions);
                $products = $this->paginate('Product');

                $this->set(compact('products'));
            }
            //this will be executed if the user ONLY selects a category
            else if($this->data['Product']['cat'] != '')
            {
                $conditions = array("Product.cateID" => $this->data['Product']['cat']);
                $this->paginate = array('conditions' => $conditions);
                $products = $this->paginate('Product');

                $this->set(compact('products'));
            }
            //this will be executed if the user ONLY enters a name
            else if($this->data['Product']['pname'] != '')
            {
                $conditions = array("Product.name LIKE" => "%".$this->data['Product']['pname']."%");
                $this->paginate = array('conditions' => $conditions);
                $products = $this->paginate('Product');

                $this->set(compact('products'));
            }

        }
    }

}
