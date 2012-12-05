<?php
class AdminTopController extends AppController {
    var $name = "AdminTop";
    var $uses = array();
    
    function admin_index() {
        $this->layout = "empty";
        $this->render("/frame/index");
    }

}
