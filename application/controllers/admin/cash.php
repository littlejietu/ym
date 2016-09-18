<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cash extends MY_Admin_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('FundOrder_model');
    }
    
	public function index()
	{
		
		$cUserName = $this->input->post_get('txtUserName');
// 		$cName = $this->input->post_get('txtName');
        $type = $this->input->post_get('type');
		$this->load->model('User_model');
		
		$page     = _get_page();//接收前台的页码
		$pagesize = 10;
		$arrParam = array();
		$arrWhere = array('type_id'=>3);
		if($cUserName)
		{
		    $arrParam['txtUserName'] = $cUserName;
		    $aUser = $this->User_model->get_by_where(array('user_name like'=>"'".$cUserName ."'" ));
		    if(!empty($aUser))
		    	$arrWhere['buyer_userid'] = $aUser['user_id'];
// 		    else
// 		    	$arrWhere['buyer_userid'] = -1;
		}
		
// 		if($cName)
// 		{
// 		    $arrParam['txtName'] = $cName;
// 		    $aUser = $this->User_model->get_by_where(array('name'=>"'".$cName."'"));
// 		    if(!empty($aUser))
// 		    	$arrWhere['buyer_userid'] = $aUser['user_id'];
// 		    else
// 		    	$arrWhere['buyer_userid'] = -1;
// 		}
        $arrParam['type'] = 0;
        if ($type == 1)
        {
            $arrParam['type'] = 1;
            $arrWhere['status'] = "'".C('FundOrderStatus.Payed')."'";
        }
        if ($type == 2)
        {
            $arrParam['type'] = 2;
            $arrWhere['status'] = "'".C('FundOrderStatus.Settled')."'";
        }
        if ($type == 3)
        {
            $arrParam['type'] = 3;
            $arrWhere['status'] = array(C('FundOrderStatus.Waiting'),C('FundOrderStatus.Paying'),C('FundOrderStatus.WaitingSettle'),C('FundOrderStatus.Closed'),C('FundOrderStatus.Refunded'));
        }
		$strOrder = 'fund_order_id desc';
		$list = $this->FundOrder_model->fetch_page($page, $pagesize, $arrWhere,'*',$strOrder);
		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/Cash', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();
		
		$result = array(
		    'list' => $list,
		    'arrParam' => $arrParam,
			);
		$this->load->view('admin/cash',$result);
	}
	
	public function audit()
	{
		$this->load->model('Audit_model'); //审核状态记录
		$this->load->model('Admin_model'); 
		$this->load->model('FundOrder_Model'); //现金提现申请主表
		$auditInfo = array();
		$id	= $this->input->post_get('id');

		$admin_id = !empty($_COOKIE['admin_id'])?$_COOKIE['admin_id']:'0';

	    //需要修改
	    $result = array();
	    $info 	= array();
	    $auditInfo = array();
	 	
	    if(!empty($id))
	    {
	        $info 			= $this->FundOrder_model->get_by_id($id);
	        $place 			= $this->FundOrder_Model->get_by_id($info['fund_order_id'],'title');
	        $info['title'] 	= $place['title'];
	        $auditInfo 		= $this->Audit_model->get_by_where( array('item_id'=>$id,'item_type'=>1));
	        $adminInfo 		= $this->Admin_model->get_by_id($auditInfo['admin_id']);
	        $auditInfo['list_url'] = $_SERVER['HTTP_REFERER'];
	        if(!empty($auditInfo))$auditInfo['admin_name'] 	= $adminInfo['name'];
	    }

	  	//根据管理员ID获取管理员信息
	    $result = array(
	        'info'		=>$info,
	        'auditInfo'	=> $auditInfo,
	        
	    );
		//var_dump($info);die;
	    $this->load->view('admin/cash_audit', $result);
	}

	public function save_audit(){
		$this->load->service('fundOrder_service');
		$this->load->service('message_service');
		$this->load->model('FundOrder_model');
		$this->load->model('Audit_model');
		//保存数据
		if($this->input->is_post()){

			$admin_id = !empty($_COOKIE['admin_id'])?$_COOKIE['admin_id']:'0';
			$id = $this->input->post_get('id');	//订单id
			$audit_status = $this->input->post('audit_status');
			$audit_content = $this->input->post('audit_content');
			$data = array('id'=>$this->input->post('audit_id'),
				'audit_content'=>$audit_content, 
				'admin_id' => $admin_id,
				'audit_ip' =>$this->input->ip_address(),
				'audit_status' => $audit_status,
				'audit_time' => time()
			);
        	$this->Audit_model->sysAuditRequest($data);

			// 审核通过并提现成功
			if ($audit_status == 1) {
				$arrReturn = $this->fundorder_service->checkedCashByHand($id);
				//发消息
				if(strtoupper($arrReturn['code']) =='SUCCESS')
				{
					$aFundOrder = $this->FundOrder_model->get_by_id($id);
			        $tpl_id = 5;
			        $receiver = $aFundOrder['buyer_userid'];
			        $arrParam = array('{money}'=>$aFundOrder['balance_amt']);

			        $this->message_service->send_sys($tpl_id,$receiver,6,$arrParam);	//6普通单个用户
			        
				}
			} else if ($audit_status == 2) {
				// 审核未通过,提现-还款
				$arrReturn = $this->fundorder_service->refundCashByHand($id);
				if(strtoupper($arrReturn['code']) =='SUCCESS')
				{
					$aFundOrder = $this->FundOrder_model->get_by_id($id);

					$tpl_id = 6;
			        $receiver = $aFundOrder['buyer_userid'];
			        $arrParam = array('{money}'=>$aFundOrder['balance_amt'],'{reason}'=>$audit_content);

			        $this->message_service->send_sys($tpl_id,$receiver,6,$arrParam);	//6普通单个用户
				}

			}
			
			header("Location:{$_POST['list_url']}");
			//redirect(ADMIN_SITE_URL.'/cash/audit?id='.$id);
		}
	}
	
}
?>