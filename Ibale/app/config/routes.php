<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
    $routingPrefix = Configure::read('Routing.prefixes');

	Router::connect('/', array('controller' => 'toppage', 'action' => 'index', 'home'));
    Router::connect('/product/list/*' , array('controller' => 'Product', 'action' => 'index'));
    Router::connect('/order/list/*'   , array('controller' => 'Order'  , 'action' => 'index'));
    Router::connect('/address/list/*' , array('controller' => 'Address', 'action' => 'index'));
    Router::connect('/bookmark/list/*' , array('controller' => 'ProductBookmark', 'action' => 'index'));
    Router::connect('/gift_top/list/*' , array('controller' => 'GiftTop', 'action' => 'product_list'));
    Router::connect('/group_buy/list/*' , array('controller' => 'GroupBuy', 'action' => 'index'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

    Router::connect('/'.$routingPrefix[0], array('controller' => 'AdminTop', 'action' => 'index', 'admin'=>true));
    Router::connect('/'.$routingPrefix[0].'/login', array('controller' => 'Admin', 'action' => 'login', 'admin'=>true));
    Router::connect('/'.$routingPrefix[0].'/logout', array('controller' => 'Admin', 'action' => 'logout', 'admin'=>true));

