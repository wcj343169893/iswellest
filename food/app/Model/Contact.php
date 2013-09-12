<?php
App::uses('CakeEmail','Network/Email');
class Contact extends AppModel {


    public $useTable = false;  // Not using the database, of course.


    public function send($d){
        $this->set($d);

        if($this->validates()){
        $mail = new CakeEmail('default');
        $mail->to('lx12071987@hotmail.com')
            ->from($d['email'])
            ->subject('Enquiry')
            ->emailFormat('html')
            ->template('contact')->viewVars($d);
        return $mail->send();
        }else{
            return false;
        }
    }


}




