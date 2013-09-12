<?php
class Contact extends AppModel {


    public $useTable = false;  // Not using the database, of course.

    public function send($d){
        App::uses('CakeEmail','Network/Email');
        $email = new CakeEmail('default');
        $email->to('lx12071987@hotmail.com')
            ->from('lx12071987@hotmail.com')
            ->subject('test');
        return $email->send('Test');
    }


}




