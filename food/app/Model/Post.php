<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jakespicer
 * Date: 10/05/13
 * Time: 2:23 PM
 * To change this template use File | Settings | File Templates.
 */
// app/models/post.php
class Post extends AppModel
{
    var $name = 'Post';
    var $actsAs = array ('Searchable');

    var $validate = array(
        'title' => array(
            'rule' => array('minLength', 1)
        ),
        'body' => array(
            'rule' => array('minLength', 1)
        )
    );
}
?>