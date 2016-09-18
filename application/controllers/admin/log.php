<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends MY_Admin_Controller {
	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('Admin_Log_model');
	}
	public function index()
	{
		$this->lang->load('admin_layout');
		$this->lang->load('admin_log');
		$page     = _get_page();
		$pagesize = 10;
		$arrParam = array();
		$arrWhere = array();
		
		$admin_name = '';
		if ($this->input->post())
		{
		    $admin_name = $this->input->post('admin_name');
		    $time_from = $this->input->post('time_from');
		    $time_to = $this->input->post('time_to');
		}
		if (!empty($admin_name))
		{
		    $arrWhere['admin_name like'] = "'%$admin_name%'";
		}
		if (!empty($time_from))
		{
		    $arrWhere['createtime >'] = strtotime($time_from);
		}
		if (!empty($time_to))
		{
		    $arrWhere['createtime <'] = strtotime($time_to);
		}
		$arrParam['orderby'] = 'createtime DESC';
		$list = $this->Admin_Log_model->fetch_page($page, $pagesize, $arrWhere,'*',$arrParam['orderby']);
		
		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/log', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();
        
		$result = array(
		    'list' =>$list['rows'],
		    'pages' => $list['pages'],
		    'arrWhere' => $arrWhere,
		    'admin_name' => $admin_name,
		);
		$this->load->view('admin/log',$result);
	}
	
}
