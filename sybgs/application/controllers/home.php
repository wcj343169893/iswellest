<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Home extends CI_Controller {
	var $uid;
	var $role;
	function __construct() {
		parent::__construct ();
		header ( "Content-Type:text/html; charset=utf-8" );
		$this->load->model ( 'Home_model' );
		if (! $this->session->userdata ( 'is_login' )) {
			redirect ( 'login' );
		} else {
			GLOBAL $login;
			$this->uid = $this->session->userdata ( 'uid' );
			$this->role = $this->session->userdata ( 'role' );
			$login ['name'] = $this->session->userdata ( 'name' );
			$login ['uid'] = $this->session->userdata ( 'uid' );
			$login ['qx1'] = $this->session->userdata ( 'qx1' );
			$login ['qx2'] = $this->session->userdata ( 'qx2' );
			$login ['role'] = $this->session->userdata ( 'role' );
			$this->load->vars ( "uid", $this->uid );
			$this->load->vars ( "role", $this->role );
			$this->load->vars ( "user_name", $login ['name'] );
		}
	}
	
	/*
	 * 以下为iframe页面加载方法
	 */
	function index() {
		GLOBAL $login;
		$data = $login;
		$this->load->view ( 'home_index', $data );
	}
	function top() {
		GLOBAL $login;
		$data = $login;
		$this->load->view ( 'home_top', $data );
	}
	function menu() {
		GLOBAL $login;
		$data = $login;
		$this->load->view ( 'home_menu', $data );
	}
	function main() {
		GLOBAL $login;
		$data = $login;
		$this->load->view ( 'home_main', $data );
	}
	/*
	 * 访问权限控制
	 */
	function isAdmin() {
		GLOBAL $login;
		if ($login ['uid'] != 'admin')
			redirect ( 'home/noAccess' );
	}
	function isUsers($num = 1) {
		GLOBAL $login;
		if ($num > 2 || $num < 1)
			redirect ( 'home/noAccess' );
		$qx = 'qx' . $num;
		if (! $login [$qx])
			redirect ( 'home/noAccess' );
	}
	function noAccess() {
		$this->load->view ( 'home_no' );
	}
	/*
	 * 以下为用户中心处理方法
	 */
	function me() {
		GLOBAL $login;
		$data = $login;
		$data ['title'] = '个人资料';
		
		if ($login ['uid'] != 'admin')
			$data ['user'] = $this->Home_model->getDataOne ( 'users', 'uid', $login ['uid'] );
		else
			$data ['user'] = $this->Home_model->getDataOne ( 'admin', 'name', 'admin' );
		$this->load->view ( 'home_me', $data );
	}
	function userslist() {
		$this->isAdmin ();
		$data ['title'] = '用户列表';
		$data ['role'] = intval ( $this->uri->segment ( 3, 0 ) );
		$table = 'users';
		$this->db->order_by ( "uid", "desc" );
		$this->db->where ( 'role', $data ['role'] );
		$query = $this->db->get ( $table );
		$data ['users'] = $query->result ();
		$this->db->close ();
		$this->load->view ( 'home_users_list', $data );
	}
	function addUsers() {
		$this->isAdmin ();
		$data ['role'] = intval ( $this->uri->segment ( 3, 0 ) );
		$data ['title'] = '添加用户信息';
		$this->load->view ( 'home_users_add', $data );
	}
	function checkUser() {
		$name = trim ( $this->input->post ( 'name' ) );
		if ($this->Home_model->getDataOne ( 'users', 'name', $name ))
			echo "<script language='javascript'>alert('用户名已存在,请核对后重新添加!!');document.getElementById('name').value = '';document.getElementById('name').focus();</script>";
	}
	function addUsersSave() {
		$this->isAdmin ();
		$data ['name'] = trim ( $this->input->post ( 'name' ) );
		$data ['paw'] = trim ( sha1 ( $this->input->post ( 'paw' ) ) );
		$data ['tel'] = trim ( $this->input->post ( 'tel' ) );
		$data ['email'] = trim ( $this->input->post ( 'email' ) );
		$data ['qx1'] = $this->input->post ( 'qx1' );
		$data ['qx2'] = $this->input->post ( 'qx2' );
		$data ['role'] = $this->input->post ( 'role' );
		$query = $this->Home_model->addData ( $data, 'users' );
		if ($query)
			echo "<script language='javascript'>alert('添加成功!!');window.location.href='" . site_url ( 'home/userslist' ) . "';</script>";
		else
			exit ( "<script>alert('添加失败,请核对信息后重新添加!!');window.history.go(-1)</script>" );
	}
	function modUsers() {
		$this->isAdmin ();
		$uid = intval ( $this->uri->segment ( 3, 0 ) );
		$data ['user'] = $this->Home_model->getDataOne ( 'users', 'uid', $uid );
		$data ['title'] = '修改' . $data ['user']->name . '的资料';
		$data ['role'] = $data ['user']->role;
		$this->load->view ( 'home_users_mod', $data );
	}
	function modUsersSave() {
		$this->isAdmin ();
		$mtype = trim ( $this->input->post ( 'mtype' ) );
		$role = $this->input->post ( 'role' );
		if ($mtype) {
			$data ['tel'] = trim ( $this->input->post ( 'tel' ) );
			$data ['email'] = trim ( $this->input->post ( 'email' ) );
			$data ['qx1'] = $this->input->post ( 'qx1' );
			$data ['qx2'] = $this->input->post ( 'qx2' );
		} else {
			$data ['paw'] = trim ( sha1 ( $this->input->post ( 'paw' ) ) );
		}
		$uid = trim ( $this->input->post ( 'uid' ) );
		$query = $this->Home_model->setData ( $data, 'users', 'uid', $uid );
		if ($query)
			echo "<script language='javascript'>alert('修改成功!!');window.location.href='" . site_url ( 'home/userslist/' . $role ) . "';</script>";
		else
			exit ( "<script>alert('修改失败,请核对信息后重新添加!!');window.history.go(-1)</script>" );
	}
	function delUsers() {
		$this->isAdmin ();
		$uid = intval ( $this->uri->segment ( 3, 0 ) );
		$query = $this->Home_model->delData ( 'users', 'uid', $uid );
		if ($query)
			echo "<script language='javascript'>alert('删除成功!!');window.location.href='" . site_url ( 'home/userslist' ) . "';</script>";
		else
			exit ( "<script>alert('删除失败,请重试!!');window.history.go(-1)</script>" );
	}
	
	/*
	 * 以下为项目作品评分处理方法
	 */
	function gradelist() {
		GLOBAL $login;
		$data = $login;
		
		$data ['title'] = '实验报告书评分';
		$data ['caid'] = intval ( $this->uri->segment ( 3, 100 ) );
		
		$this->isUsers ( $data ['caid'] );
		
		$this->db->where ( 'caid', $data ['caid'] );
		$table = 'works';
		$query_all = $this->db->get ( $table );
		$total = $query_all->num_rows ();
		$data ['total'] = $total;
		
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'home/gradelist' ) . '/' . $data ['caid'];
		$config ['total_rows'] = $total;
		$config ['per_page'] = '12';
		$config ['uri_segment'] = 4;
		$config ['first_link'] = '第一页';
		$config ['prev_link'] = '上一页';
		$config ['next_link'] = '下一页';
		$config ['last_link'] = '最后一页';
		$config ['cur_tag_open'] = '<span class="current">';
		$config ['cur_tag_close'] = '</span>';
		// $config['use_page_numbers']=true;
		$this->paginaConfig($config);
		$this->pagination->initialize ( $config );
		$data ['pagination'] = $this->pagination->create_links ();
		
		$end = $config ['per_page'];
		$uri = intval ( $this->uri->segment ( 4, 0 ) );
		$start = $config ['per_page'];
		
		$this->db->order_by ( "wid", "desc" );
		$this->db->where ( 'caid', $data ['caid'] );
		$query = $this->db->get ( $table, $start, $uri );
		$data ['works'] = $query->result ();
		
		$data ['complete'] = $this->Home_model->countNum ( 'score', $data ['caid'], $data ['uid'] );
		$data ['all'] = $this->Home_model->countNum ( 'works', $data ['caid'], 0 );
		$data ['left'] = $data ['all'] - $data ['complete'];
		if ($data ['caid'] == 1)
			$data ['alert'] = "<script>alert('您已完成科技理念类的实验报告书的评分工作，如果您还有科技实物类实验报告书的评分未完成，请尽快评审!!');</script>";
		else
			$data ['alert'] = "<script>alert('您已完成科技实物类的实验报告书的评分工作，如果您还有科技理念类实验报告书的评分工作，请尽快评审!!');</script>";
		
		$this->db->close ();
		$this->load->view ( 'home_grade_list', $data );
	}
	function addGrade() {
		GLOBAL $login;
		$data = $login;
		$data ['title'] = '实验报告书评分';
		$data ['wid'] = intval ( $this->uri->segment ( 3, 1 ) );
		$data ['works'] = $this->Home_model->getDataOne ( 'works', 'wid', $data ['wid'] );
		$data ['play'] = '';
		
		$this->isUsers ( $data ['works']->caid );
		
		$file_arr = explode ( "||", $data ['works']->wfile );
		foreach ( $file_arr as $wfile ) {
			$data ['play'] .= $this->judgeFileType ( trim ( $wfile ) );
		}
		$this->load->view ( 'home_grade_add', $data );
	}
	function judgeFileType($wfile) {
		$image = array (
				'.gif',
				'.jpg',
				'.jpeg',
				'.png',
				'.bmp' 
		);
		$flash = array (
				'swf',
				'.swf',
				'.swf' 
		);
		$media = array (
				'.flv',
				'.wmv',
				'.avi',
				'.mpg',
				'.flv',
				'.f',
				'.FLV',
				'.WMV',
				'.AVI',
				'.MPG',
				'.mp4',
				'.MP4' 
		);
		$RealPlayer = array (
				'.rm',
				'.rmvb',
				'.RM',
				'.RMVB' 
		);
		
		$wftype = strchr ( $wfile, "." );
		
		if (array_search ( $wftype, $flash )) {
			return "<div><embed src='uploads/" . $wfile . "' type='application/x-shockwave-flash' width='850' height='550' quality='high' /></div><br />";
		} elseif (array_search ( $wftype, $media )) {
			return "<div><embed src='uploads/" . $wfile . "' type='video/x-ms-asf-plugin' width='850' height='550' autostart='true' loop='false' /></div><br />";
		} elseif (array_search ( $wftype, $RealPlayer )) {
			return "<div><embed src='uploads/" . $wfile . "' type='video/x-ms-asf-plugin' width='850' height='550' autostart='true' loop='false' /></div><br />";
		} else {
			return "<div><img src='uploads/" . $wfile . "' style='max-width:850px;' /></div><br />";
		}
	}
	function addGradeSave() {
		$sid = $this->input->post ( 'sid' );
		$caid = trim ( $this->input->post ( 'caid' ) );
		$this->isUsers ( $caid );
		if ($sid) {
			$data ['score1'] = trim ( $this->input->post ( 'grade1' ) );
			$data ['score2'] = trim ( $this->input->post ( 'grade2' ) );
			$data ['score3'] = trim ( $this->input->post ( 'grade3' ) );
			$data ['score4'] = trim ( $this->input->post ( 'grade4' ) );
			$data ['score5'] = trim ( $this->input->post ( 'grade5' ) );
			$data ['score6'] = trim ( $this->input->post ( 'grade6' ) );
			$data ['score7'] = trim ( $this->input->post ( 'grade7' ) );
			$query = $this->Home_model->setData ( $data, 'score', 'sid', $sid );
		} else {
			$data ['caid'] = $caid;
			$data ['uid'] = trim ( $this->input->post ( 'uid' ) );
			$data ['wid'] = trim ( $this->input->post ( 'wid' ) );
			$data ['score1'] = trim ( $this->input->post ( 'grade1' ) );
			$data ['score2'] = trim ( $this->input->post ( 'grade2' ) );
			$data ['score3'] = trim ( $this->input->post ( 'grade3' ) );
			$data ['score4'] = trim ( $this->input->post ( 'grade4' ) );
			$data ['score5'] = trim ( $this->input->post ( 'grade5' ) );
			$data ['score6'] = trim ( $this->input->post ( 'grade6' ) );
			$data ['score7'] = trim ( $this->input->post ( 'grade7' ) );
			$query = $this->Home_model->addData ( $data, 'score' );
		}
		if ($query)
			echo "<script language='javascript'>alert('评分成功!!');window.location.href='" . site_url ( 'home/gradelist' ) . '/' . $caid . "';</script>";
		else
			exit ( "<script>alert('评分失败,请重新评分!!');window.history.go(-1)</script>" );
	}
	function modGrade() {
		GLOBAL $login;
		$data = $login;
		$data ['title'] = '实验报告书评分';
		$sid = intval ( $this->uri->segment ( 3, 1 ) );
		$data ['score'] = $this->Home_model->getDataOne ( 'score', 'sid', $sid );
		$data ['works'] = $this->Home_model->getDataOne ( 'works', 'wid', $data ['score']->wid );
		$data ['play'] = '';
		
		$this->isUsers ( $data ['works']->caid );
		
		$file_arr = explode ( "||", $data ['works']->wfile );
		foreach ( $file_arr as $wfile ) {
			$data ['play'] .= $this->judgeFileType ( trim ( $wfile ) );
		}
		
		$this->load->view ( 'home_grade_mod', $data );
	}
	function isWin() {
		$sid = $this->input->post ( 'sid' );
		$iswin = $this->input->post ( 'iswin' );
		if ($iswin)
			$data ['iswin'] = 0;
		else
			$data ['iswin'] = 1;
		if ($this->Home_model->setData ( $data, 'score', 'sid', $sid ))
			echo 'OK';
		else
			echo "<script>alert('操作失败,请重试!!');</script>";
	}
	/*
	 * 以下为项目管理处理方法
	 */
	function addWorks() {
		// $this->isAdmin();
		$data ['title'] = '添加实验报告书';
		$data ['caid'] = intval ( $this->uri->segment ( 3, 0 ) );
		$this->load->view ( 'home_works_add', $data );
	}
	function changeFiles() {
		// $this->isAdmin();
		$data ['name'] = trim ( $this->input->post ( 'name' ) );
		$data ['type'] = trim ( $this->input->post ( 'type' ) );
		$this->load->view ( 'home_works_changefiles', $data );
	}
	function addWorksSave() {
		// $this->isAdmin();
		$data ['caid'] = trim ( $this->input->post ( 'caid' ) );
		$data ['wname'] = trim ( $this->input->post ( 'wname' ) );
		$data ['wauthor'] = $this->input->post ( 'wauthor' );
		$data ['wbz'] = $this->input->post ( 'wbz' );
		$data ['uid'] = $this->uid;
		$wfile= $this->input->post ( 'wfile' );
		$data ['wfile'] ="";
		if(!empty($wfile)){
			$data ['wfile']=implode("||", $wfile);
		}
		$query = $this->Home_model->addData ( $data, 'works' );
		if ($query)
			echo "<script language='javascript'>alert('添加成功!!');window.location.href='" . site_url ( 'home/workslist' ) . '/' . $data ['caid'] . "';</script>";
		else
			exit ( "<script>alert('添加失败,请核对信息后重新添加!!');window.history.go(-1)</script>" );
	}
	function modWorks() {
		//home_works_mod
		$wid = intval ( $this->uri->segment ( 3, 0 ) );
		$data ['works'] = $this->Home_model->getDataOne ( 'works', 'wid', $wid );
		$data ['title'] = '修改' . $data ['works']->wname;
		$data ['caid'] = $data['works']->caid;
		if(!empty($data['works']->wfile)){
			$data['wfiles'] = explode("||", $data['works']->wfile);
		}
		$this->load->view ( 'home_works_mod', $data );
	}
	function modWorksSave() {
		// $this->isAdmin();
		$data ['caid'] = trim ( $this->input->post ( 'caid' ) );
		$data ['wname'] = trim ( $this->input->post ( 'wname' ) );
		$data ['wauthor'] = $this->input->post ( 'wauthor' );
		$data ['wbz'] = $this->input->post ( 'wbz' );
		$wid = trim ( $this->input->post ( 'wid' ) );
		$wfile= $this->input->post ( 'wfile' );
		$data ['wfile'] ="";
		if(!empty($wfile)){
			$data ['wfile']=implode("||", $wfile);
		}
		$query = $this->Home_model->setData ( $data, 'works', 'wid', $wid );
		if ($query)
			echo "<script language='javascript'>alert('修改成功!!');window.location.href='" . site_url ( 'home/workslist' ) . '/' . $data ['caid'] . "';</script>";
		else
			exit ( "<script>alert('添加失败,请核对信息后重新添加!!');window.history.go(-1)</script>" );
	}
	function ajaxworkslist() {
		$iDisplayStart = intval ( $_REQUEST ["iDisplayStart"] ); // 开始位置
		$iDisplayLength = intval ( $_REQUEST ["iDisplayLength"] ); // 长度
		$table = 'works';
		$query_all = $this->db->get ( $table );
		$total = $query_all->num_rows ();
		
		$query = $this->db->get ( $table, $iDisplayLength, $iDisplayStart );
		$result = $query->result ();
		$data = array (
				"sEcho" => intval ( $_GET ['sEcho'] ),
				"iTotalRecords" => $total,
				"iTotalDisplayRecords" => $total,
				"aaData" => $result,
				"sColumns" => "wid,wname,wauthor,wftype,wbz" 
		);
		header ( "Content-type:text/json" );
		echo json_encode ( $data );
		exit ();
	}
	function workslist() {
		// $this->output->enable_profiler(TRUE);
		$data ['title'] = '实验报告书列表';
		$data ['caid'] = intval ( $this->uri->segment ( 3, 1 ) );
		
		$this->db->where ( 'caid', $data ['caid'] );
		if ($this->uid > 0 && $this->role) {
			$this->db->where ( 'uid', $this->uid );
		} else {
			$this->isAdmin ();
		}
		$table = 'works';
		$query_all = $this->db->get ( $table );
		$total = $query_all->num_rows ();
		$data ['total'] = $total;
		
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'home/workslist' ) . '/' . $data ['caid'];
		$config ['total_rows'] = $total;
		$config ['per_page'] = '10';
		$config ['uri_segment'] = 4;
		$config ['first_link'] = '第一页';
		$config ['prev_link'] = '上一页';
		$config ['next_link'] = '下一页';
		$config ['last_link'] = '最后一页';
		$config ['cur_tag_open'] = '<span class="current">';
		$config ['cur_tag_close'] = '</span>';
		$this->paginaConfig($config);
		// $config['use_page_numbers']=true;
		$this->pagination->initialize ( $config );
		$data ['pagination'] = $this->pagination->create_links ();
		
		$end = $config ['per_page'];
		$uri = intval ( $this->uri->segment ( 4, 0 ) );
		$start = $config ['per_page'];
		
		$this->db->order_by ( "wid", "desc" );
		$this->db->where ( 'caid', $data ['caid'] );
		if ($this->uid > 0 && $this->role) {
			$this->db->where ( 'uid', $this->uid );
		}
		$query = $this->db->get ( $table, $start, $uri );
		$data ['works'] = $query->result ();
		$this->db->close ();
		$this->load->view ( 'home_works_list', $data );
	}
	/**
	 * 构造datatable 样式的分页
	 * */
	function paginaConfig(&$config){
		$config ['full_tag_open'] = "<ul>";
		$config ['full_tag_close'] = "</ul>";
		//<li class="active"><a href="#">1</a></li>
		$config ['cur_tag_open'] = '<li class="active"><a href="#">';
		$config ['cur_tag_close'] = '</a></li>';
		$config ['first_tag_open'] = 
		$config ['last_tag_open'] = 
		$config ['prev_tag_open'] = 
		$config ['num_tag_open'] = 
		$config ['next_tag_open'] = 
		'<li>';
		
		$config ['first_tag_close'] = 
		$config ['last_tag_close'] = 
		$config ['prev_tag_close'] = 
		$config ['num_tag_close'] = 
		$config ['next_tag_close'] = 
		'</li>';
	}
	function delWorks() {
		// $this->isAdmin();
		$wid = intval ( $this->uri->segment ( 4, 0 ) );
		$file = $this->Home_model->getDataOne ( 'works', 'wid', $wid );
		$query = $this->Home_model->delData ( 'works', 'wid', $wid );
		if ($query) {
			$fpath = "uploads/" . $file->wfile;
			@unlink ( $fpath );
			echo "<script language='javascript'>alert('删除成功!!');window.location.href='" . site_url ( 'home/workslist' ) . "';</script>";
		} else
			exit ( "<script>alert('删除失败,请重试!!');window.history.go(-1)</script>" );
	}
	/*
	 * 以下为分数统计与导出功能处理方法
	 */
	function scorelist() {
		$this->isAdmin ();
		GLOBAL $login;
		$data = $login;
		
		$data ['title'] = '实验报告书评分';
		$data ['caid'] = intval ( $this->uri->segment ( 3, 1 ) );
		
		$this->db->where ( 'caid', $data ['caid'] );
		$table = 'works';
		$query_all = $this->db->get ( $table );
		$total = $query_all->num_rows ();
		$data ['total'] = $total;
		
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'home/scorelist' ) . '/' . $data ['caid'];
		$config ['total_rows'] = $total;
		$config ['per_page'] = '12';
		$config ['uri_segment'] = 4;
		$config ['first_link'] = '第一页';
		$config ['prev_link'] = '上一页';
		$config ['next_link'] = '下一页';
		$config ['last_link'] = '最后一页';
		$config ['cur_tag_open'] = '<span class="current">';
		$config ['cur_tag_close'] = '</span>';
		// $config['use_page_numbers']=true;
		$this->pagination->initialize ( $config );
		$data ['pagination'] = $this->pagination->create_links ();
		
		$end = $config ['per_page'];
		$uri = intval ( $this->uri->segment ( 4, 0 ) );
		$start = $config ['per_page'];
		
		$this->db->order_by ( "wid", "desc" );
		$this->db->where ( 'caid', $data ['caid'] );
		$query = $this->db->get ( $table, $start, $uri );
		$data ['works'] = $query->result ();
		$this->db->close ();
		$this->load->view ( 'home_score_list', $data );
	}
	function scoreOne() {
		$this->isAdmin ();
		GLOBAL $login;
		$data = $login;
		$data ['title'] = '实验报告书得分';
		$wid = intval ( $this->uri->segment ( 3, 1 ) );
		$data ['wid'] = $wid;
		$data ['works'] = $this->Home_model->getDataOne ( 'works', 'wid', $wid );
		$data ['score'] = $this->Home_model->getScores ( 0, 0, $wid );
		$data ['play'] = '';
		
		$file_arr = explode ( "||", $data ['works']->wfile );
		foreach ( $file_arr as $wfile ) {
			$data ['play'] .= $this->judgeFileType ( trim ( $wfile ) );
		}
		
		$this->load->view ( 'home_score_one', $data );
	}
	function scoreofmine() {
		GLOBAL $login;
		$data = $login;
		
		$data ['title'] = '实验报告书评分';
		$data ['caid'] = intval ( $this->uri->segment ( 3, 100 ) );
		
		$this->isUsers ( $data ['caid'] );
		
		$this->db->where ( 'caid', $data ['caid'] );
		$table = 'works';
		$query_all = $this->db->get ( $table );
		$total = $query_all->num_rows ();
		$data ['total'] = $total;
		
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'home/scoreofmine' ) . '/' . $data ['caid'];
		$config ['total_rows'] = $total;
		$config ['per_page'] = '12';
		$config ['uri_segment'] = 4;
		$config ['first_link'] = '第一页';
		$config ['prev_link'] = '上一页';
		$config ['next_link'] = '下一页';
		$config ['last_link'] = '最后一页';
		$config ['cur_tag_open'] = '<span class="current">';
		$config ['cur_tag_close'] = '</span>';
		// $config['use_page_numbers']=true;
		$this->pagination->initialize ( $config );
		$data ['pagination'] = $this->pagination->create_links ();
		
		$end = $config ['per_page'];
		$uri = intval ( $this->uri->segment ( 4, 0 ) );
		$start = $config ['per_page'];
		
		$this->db->order_by ( "wid", "desc" );
		$this->db->where ( 'caid', $data ['caid'] );
		$query = $this->db->get ( $table, $start, $uri );
		$data ['works'] = $query->result ();
		$this->db->close ();
		$this->load->view ( 'home_score_mine', $data );
	}
	function excel() {
		GLOBAL $login;
		$data = array ();
		$caid = intval ( $this->uri->segment ( 3, 1 ) );
		if ($caid == 1)
			$filename = '科技理念类评分统计结果';
		else
			$filename = '科技实物类评分统计结果';
		if ($login ['uid'] != 'admin') {
			$uid = $login ['uid'];
			$filename .= '_' . $login ['name'];
			if ($caid == 1)
				$title = array (
						'作品名称',
						'科学性',
						'环保理念',
						'创新性',
						'可行性',
						'文字表述',
						'总分',
						'(是/否)及格' 
				);
			else
				$title = array (
						'作品名称',
						'科学性',
						'环保理念',
						'创新性',
						'可行性',
						'经济性',
						'总分',
						'进决赛否' 
				);
		} else {
			$uid = 0;
			if ($caid == 1)
				$title = array (
						'作品名称',
						'作者',
						'科学性',
						'环保理念',
						'创新性',
						'可行性',
						'文字表述',
						'总分',
						'(是/否)及格',
						'评分人数' 
				);
			else
				$title = array (
						'作品名称',
						'作者',
						'科学性',
						'环保理念',
						'创新性',
						'可行性',
						'经济性',
						'总分',
						'(是/否)及格',
						'评分人数' 
				);
		}
		$this->db->where ( 'caid', $caid );
		$table = 'works';
		$query = $this->db->get ( $table );
		$works = $query->result ();
		$i = 0;
		foreach ( $works as $row ) {
			$data [$i] ['wname'] = $row->wname;
			if ($uid) {
				$score = $this->Home_model->getScoreOne ( $uid, $caid, $row->wid );
				if ($score) {
					$data [$i] ['fs1'] = $score->score1;
					$data [$i] ['fs2'] = $score->score2;
					$data [$i] ['fs3'] = $score->score3;
					$data [$i] ['fs4'] = $score->score4;
					$data [$i] ['fs5'] = $score->score5;
					$data [$i] ['fs7'] = $score->score7;
					$data [$i] ['iswin'] = $score->iswin ? '是' : '否';
				} else {
					$data [$i] ['fs1'] = 0;
					$data [$i] ['fs2'] = 0;
					$data [$i] ['fs3'] = 0;
					$data [$i] ['fs4'] = 0;
					$data [$i] ['fs5'] = 0;
					$data [$i] ['fs7'] = 0;
					$data [$i] ['iswin'] = '';
				}
			
			} else {
				$data [$i] ['wauthor'] = $row->wauthor;
				$score = $this->Home_model->getScores ( 0, $caid, $row->wid );
				if ($score) {
					$j = 0;
					$fenshu1 = 0;
					$fenshu2 = 0;
					$fenshu3 = 0;
					$fenshu4 = 0;
					$fenshu5 = 0;
					$fenshu6 = 0;
					$fenshu7 = 0;
					$iswin = 0;
					$islose = 0;
					foreach ( $score as $fen ) {
						$j ++;
						$fenshu1 += $fen->score1;
						$fenshu2 += $fen->score2;
						$fenshu3 += $fen->score3;
						$fenshu4 += $fen->score4;
						$fenshu5 += $fen->score5;
						$fenshu7 += $fen->score7;
						if ($fen->iswin)
							$iswin ++;
						else
							$islose ++;
					}
					$data [$i] ['fs1'] = $fenshu1 / $j;
					$data [$i] ['fs2'] = $fenshu2 / $j;
					$data [$i] ['fs3'] = $fenshu3 / $j;
					$data [$i] ['fs4'] = $fenshu4 / $j;
					$data [$i] ['fs5'] = $fenshu5 / $j;
					$data [$i] ['fs7'] = $fenshu7 / $j;
					$data [$i] ['iswin'] = $iswin . '/' . $islose;
					$data [$i] ['renshu'] = $j;
				} else {
					$data [$i] ['fs1'] = 0;
					$data [$i] ['fs2'] = 0;
					$data [$i] ['fs3'] = 0;
					$data [$i] ['fs4'] = 0;
					$data [$i] ['fs5'] = 0;
					$data [$i] ['fs7'] = 0;
					$data [$i] ['iswin'] = '';
					$data [$i] ['renshu'] = 0;
				}
			
			}
			$i ++;
		}
		$this->db->close ();
		$this->load->library ( 'excel' );
		$this->excel->writer ( $title, $data, iconv ( "UTF-8", "GBK//IGNORE", $filename ) );
	}
	function excel2() {
		$this->isAdmin ();
		GLOBAL $login;
		$data = array ();
		$wid = intval ( $this->uri->segment ( 3, 1 ) );
		$works = $this->Home_model->getDataOne ( 'works', 'wid', $wid );
		$score = $this->Home_model->getScores ( 0, 0, $wid );
		
		if ($works->caid == 1)
			$title = array (
					'用户姓名',
					'科学性',
					'环保理念',
					'创新性',
					'可行性',
					'文字表述',
					'总分',
					'(是/否)及格' 
			);
		else
			$title = array (
					'用户姓名',
					'科学性',
					'环保理念',
					'创新性',
					'可行性',
					'经济性',
					'总分',
					'(是/否)及格' 
			);
		
		$i = 0;
		$fenshu1 = 0;
		$fenshu2 = 0;
		$fenshu3 = 0;
		$fenshu4 = 0;
		$fenshu5 = 0;
		$fenshu6 = 0;
		$fenshu7 = 0;
		$iswin = 0;
		$islose = 0;
		if ($score) {
			foreach ( $score as $fen ) {
				$user = $this->Home_model->getDataOne ( 'users', 'uid', $fen->uid );
				$data [$i] ['name'] = $user->name;
				$data [$i] ['fs1'] = $fen->score1;
				$data [$i] ['fs2'] = $fen->score2;
				$data [$i] ['fs3'] = $fen->score3;
				$data [$i] ['fs4'] = $fen->score4;
				$data [$i] ['fs5'] = $fen->score5;
				$data [$i] ['fs7'] = $fen->score7;
				$data [$i] ['iswin'] = $fen->iswin ? '是' : '否';
				
				$fenshu1 += $fen->score1;
				$fenshu2 += $fen->score2;
				$fenshu3 += $fen->score3;
				$fenshu4 += $fen->score4;
				$fenshu5 += $fen->score5;
				$fenshu7 += $fen->score7;
				if ($fen->iswin)
					$iswin ++;
				else
					$islose ++;
				
				$i ++;
			}
		}
		$j = $i + 1;
		$data [$j] ['name'] = '平均分';
		$data [$j] ['fs1'] = $fenshu1 / $i;
		$data [$j] ['fs2'] = $fenshu2 / $i;
		$data [$j] ['fs3'] = $fenshu3 / $i;
		$data [$j] ['fs4'] = $fenshu4 / $i;
		$data [$j] ['fs5'] = $fenshu5 / $i;
		$data [$j] ['fs7'] = $fenshu7 / $i;
		$data [$j] ['iswin'] = $iswin . '/' . $islose;
		
		$j = $j + 2;
		$data [$j] ['name'] = $works->wname;
		$data [$j] ['fs1'] = $works->wauthor;
		if ($works->caid == 1)
			$data [$j] ['fs2'] = '科技理念类';
		else
			$data [$j] ['fs2'] = '科技实物类';
		$data [$j] ['fs3'] = $works->wbz;
		
		$filename = $data [$j] ['fs2'] . '_' . $works->wname . '_得分明细';
		
		$this->db->close ();
		
		$this->load->library ( 'excel' );
		$this->excel->writer ( $title, $data, iconv ( "UTF-8", "GBK//IGNORE", $filename ) );
	}
	/*
	 * 系统设置
	 */
	function cleanWorks() {
		$this->isAdmin ();
		$this->load->view ( 'home_system_cleanw' );
	}
	function cleanScores() {
		$this->isAdmin ();
		$this->load->view ( 'home_system_cleanc' );
	}
	function clean() {
		$this->isAdmin ();
		$table = $this->input->post ( 'table' );
		if ($this->db->empty_table ( $table )) {
			if ($table == 'works') {
				$this->load->helper ( 'file' );
				delete_files ( './uploads/' );
			}
			$this->db->close ();
			echo "<script language='javascript'>alert('数据已清空~!!');</script>";
		}
	}
	/*
	 * 注销退出系统
	 */
	function logout() {
		$this->session->sess_destroy ();
		redirect ( 'login' );
	}
}
