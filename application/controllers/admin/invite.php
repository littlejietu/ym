<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invite extends MY_Admin_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Invite_bonus_model');
        $this->load->model('Invite_model');
    }
    
	public function index()
	{
        
	    $arrParam = array();
		$arrParam['order_id'] = $this->input->post_get('order_id');
		$arrParam['buyer_id'] = $buyerName = $this->input->post_get('buyer_id');
		$arrParam['receive_id'] = $recName = $this->input->post_get('receive_id');
		$arrParam['stime'] = $this->input->post_get('addtime');
		$arrParam['etime'] = $this->input->post_get('etime');
		
		$page     = _get_page();//接收前台的页码
		
		$pagesize = 10;
		
		$arrWhere = array();
		$arrWhere['type']=1;//推广类型：分佣
		
		
		if($arrParam['order_id']){
		    $arrWhere['order_id'] = (int)$arrParam['order_id'];
		}
		
		if($arrParam['buyer_id']){
		    $arrWhere['buyer_id'] = (int)$arrParam['buyer_id'];   
		}
		
		if($arrParam['receive_id']){
		    $arrWhere['to_user_id'] = (int)$arrParam['receive_id'];
		}
		
        if($arrParam['stime']){
            $arrWhere['addtime >'] = strtotime($arrParam['stime']);
        }
        
        if($arrParam['etime']){
            $arrWhere['addtime <'] = strtotime($arrParam['etime']);
        }
    
        
		$strOrder = 'addtime desc';
		$arrWhere['status <>'] = -1;
		
		$list = $this->Invite_bonus_model->fetch_page($page, $pagesize, $arrWhere,'*',$strOrder);
		
		
		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/invite', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;

		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();
		$result = array(
		    'list' => $list,
		    'arrParam' => $arrParam,
			);
		$this->load->view('admin/invite_bonus_log',$result);
	}
	
	

	public function userlist()
	{
		$arrParam = array();
		//$cKey = $this->input->post_get('user_id');
		$cKey = $this->input->post_get('txtKey');
		
		$this->load->model('User_model');
		$this->load->model('User_pwd_model');
		
		$page     = _get_page();//接收前台的页码
		$pagesize = 10;
		$arrWhere = array();
		//$arrWhere['type']=1;//推广类型：分佣
		
		
		if($cKey)
		{
		    $arrParam['txtKey'] = $cKey;

		    $aUser = $this->User_pwd_model->get_by_where(array('user_name'=>"'$cKey'"),'id');
		    
		    if(!empty($aUser)){
		    	$arrWhere['user_id'] = $aUser['id'];
		    }
		}
		        
		$strOrder = 'addtime desc';
		
		$list = $this->Invite_model->fetch_page($page, $pagesize, $arrWhere,'*',$strOrder);
		foreach ($list['rows'] as $key => $a) {
			$aUserTmp = $this->User_model->get_by_id($a['user_id'],'user_name,name');
			$a['username'] = '';
			$a['name'] = '';
			if(!empty($aUserTmp)){
				$a['username'] = $aUserTmp['user_name'];
				$a['name'] = $aUserTmp['name'];
			}
			for($i=1;$i<=10;$i++){
				$aUserTmp = $this->User_model->get_by_id($a['parent_id_'.$i],'user_name');
                $a['parent_username_'.$i] = '';
                if(!empty($aUserTmp))
					$a['parent_username_'.$i] = $aUserTmp['user_name'];
            }

            $list['rows'][$key] = $a;
		}

		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/invite/userlist', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;

		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();
		$result = array(
		    'list' => $list,
		    'arrParam' => $arrParam,
			);
		$this->load->view('admin/invite_user_list',$result);
	}
}
?>