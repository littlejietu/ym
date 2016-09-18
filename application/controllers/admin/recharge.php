<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recharge extends MY_Admin_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('FundOrder_model');
    }
    
	public function index()
	{
		
		$cUserName = $this->input->post_get('txtUserName');
		$cName = $this->input->post_get('txtName');
		$this->load->model('User_model');
		
		$page     = _get_page();//接收前台的页码
		
		$pagesize = 10;
		$arrParam = array();
		$arrWhere = array('type_id'=>2);
		if($cUserName)
		{
		    $arrParam['txtUserName'] = $cUserName;
		    $aUser = $this->User_model->get_by_where(array('user_name'=>"'".$cUserName ."'" ));
		    if(!empty($aUser))
		    	$arrWhere['buyer_userid'] = $aUser['user_id'];
		    else
		    	$arrWhere['buyer_userid'] = -1;
		}
		
		if($cName)
		{
		    $arrParam['txtName'] = $cName;
		    $aUser = $this->User_model->get_by_where(array('name'=>"'".$cName."'"));
		    if(!empty($aUser))
		    	$arrWhere['buyer_userid'] = $aUser['user_id'];
		    else
		    	$arrWhere['buyer_userid'] = -1;
		}

		$strOrder = 'fund_order_id desc';
		
		$list = $this->FundOrder_model->fetch_page($page, $pagesize, $arrWhere,'*',$strOrder);
		
		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/Recharge', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();
		
		$result = array(
		    'list' => $list,
		
		    'arrParam' => $arrParam,
			);
			//var_dump($list);die;
		$this->load->view('admin/recharge',$result);
	}
	
}
?>