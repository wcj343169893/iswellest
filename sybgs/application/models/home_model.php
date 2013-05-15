<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {
	function __construct(){
		parent::__construct();
	}
	function addData($data,$table) {
		if($this->db->insert($table,$data))
			return TRUE;
		else
			return FALSE;
	}
	function getData($table) {
		$query = $this->db->get($table);
		return $query;
	}
	function getDataOne($table,$where,$value) {
		$this->db->where($where,$value);
		$query = $this->db->get($table);
		return $query->row();
	}
	function setData($data,$table,$where,$value) {
		$this->db->where($where,$value);
		if($this->db->update($table,$data))
			return TRUE;
		else
			return FALSE;
	}
	function delData($table,$where,$value) {
		$this->db->where($where,$value);
		if($this->db->delete($table))
			return TRUE;
		else
			return FALSE;
	}
	
	function addFile($data) {
		if($this->db->insert('works',$data))
			return TRUE;
		else
			return FALSE;
	}
	
	function getScoreOne($uid,$caid,$wid) {
		if ($uid)$this->db->where('uid',$uid);
		if ($caid)$this->db->where('caid',$caid);
		if ($wid)$this->db->where('wid',$wid);
		$table = 'score';
		$query = $this->db->get($table);
		return $query->row();
	}
	function getScores($uid,$caid,$wid) {
		if ($uid)$this->db->where('uid',$uid);
		if ($caid)$this->db->where('caid',$caid);
		if ($wid)$this->db->where('wid',$wid);
		$table = 'score';
		$query = $this->db->get($table);
		return $query->result();
	}
	
	
	function countNum($table,$caid = 0,$uid = 0) {
		if ($uid)$this->db->where('uid',$uid);
		if ($caid)$this->db->where('caid',$caid);
		$query = $this->db->get($table);
		return $query->num_rows();
	}

	
}
?>