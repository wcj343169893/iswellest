<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {
	function __construct(){
		parent::__construct();
	}
	function login($data,$table) {
		$this->db->where('name',$data['name']);
		$this->db->where('paw',sha1($data['paw']));
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return $query->row();
		}
	}
	function checkUser($data,$table) {
		$this->db->where('name',$data['name']);
		$query = $this->db->get($table);
		if($query->num_rows() > 0){
			return $query->row();
		}
	}
	function addUser($data,$table) {
		if($this->db->insert($table,$data))
			return TRUE;
		else
			return FALSE;
	}
	function setUser($data,$table) {
		$this->db->where('uid',$data['uid']);
		if($this->db->updata($table,$data))
			return TRUE;
		else
			return FALSE;
	}
	function delUser($data,$table) {
		$this->db->where('uid',$data['uid']);
		if($this->db->delete($table,$data))
			return TRUE;
		else
			return FALSE;
	}
	
}
?>