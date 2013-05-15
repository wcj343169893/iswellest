<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
 	
	function __construct() {
		parent::__construct();
		header("Content-Type:text/html; charset=utf-8");
	}
	
	function index()
	{	
		$data['msg'] = 0;
		$this->load->view('login',$data);
	}
	function checkUser()
	{
		$this->load->model('Users_model');
		$data['name'] = $this->input->post('name');
		$data['paw'] = $this->input->post('paw');
		$query = $this->Users_model->login($data,'users');
		$this->db->close();
 		if ($query){
 			$session['is_login'] = TRUE;
 			$session['name'] = $query->name;
 			$session['uid'] = $query->uid;	
 			$session['qx1'] = $query->qx1;
		    $session['qx2'] = $query->qx2;
		    $session['role'] = $query->role;

 			$this->session->set_userdata($session);
 			
 			redirect('home');
 			
 		}else{
	 		$query = $this->Users_model->login($data,'admin');
	 		if ($query){
	 			$session['is_login'] = TRUE;
	 			$session['name'] = $query->name;
	 			$session['uid'] = 'admin';
	 			$session['qx1'] = 0;
			    $session['qx2'] = 0;
	
	 			$this->session->set_userdata($session);
	 			
	 			redirect('home');
	 			
	 		}else {
	 			$data['msg'] = "<script>alert('用户名或密码错误!!请重试~!!');</script>";
	 			$this->load->view('login',$data);
	 		}
 		}
	}
}
