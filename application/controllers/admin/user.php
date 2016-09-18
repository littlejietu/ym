<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Admin_Controller {
	
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }
    
	public function index()
	{
		$this->lang->load('admin_layout');
		$this->lang->load('admin_user');

		$cKey = $this->input->post_get('search_field_value');
		$page     = _get_page();
		$pagesize = 10;
		$arrParam = array();
		$arrWhere = array();

		if($cKey)
		{
		    $arrParam['search_field_value'] = $cKey;
		    $arrWhere['user_name like '] = "'%$cKey%'";
		}
		
		$arrWhere['status <>'] = -1;
		$user_list = $this->User_model->fetch_page($page, $pagesize, $arrWhere,'*'	);
		foreach ($user_list['rows'] as $key => $value)
		{
		    $user_list['rows'][$key]['logo'] = strstr($value['logo'],'http://')?$value['logo']:(empty($value['logo'])?'':BASE_SITE_URL.'/'.$value['logo']);
		}
		
		$user_num_list = array();
		$user_login_list = array();
		$user_account_list =array();
		
		if(!empty($user_list['rows'])){
		    $arrUserIds=array_column($user_list['rows'], 'user_id');
		
    		$this->load->model('User_num_model');
    		$user_num_list = $this->User_num_model->get_list(array('user_id'=>$arrUserIds));
    		
    		$this->load->model('User_detail_model');
    		$user_login_list = $this->User_detail_model->get_list(array('user_id'=>$arrUserIds));
    
    		
    		$this->load->model('Account_model');
    		$user_account_list = $this->Account_model->get_list(array('user_id'=>$arrUserIds));
    		
		}
		
		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/user', $arrParam);
		$pagecfg['total_rows']   = $user_list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		 
		$this->pagination->initialize($pagecfg);
		$user_list['pages'] = $this->pagination->create_links();
		
		$status = array(1=>'正常',2=>'锁定' );
		$result = array(
		    'user_num_list' => $user_num_list,
		    'user_list' => $user_list,
		    'user_login_list' => $user_login_list,
		    'user_account_list'=>$user_account_list,
		    'status' => $status,
		    'cKey'		=> $cKey,
		);
		$this->load->view('admin/user',$result);
	}
	
	public function add()
	{
	    $this->lang->load('admin_layout');
	    $this->lang->load('admin_user');
	    

	    
	    $this->load->view('admin/user_add');
	}
	
	public function edit()
	{
	    if ($this->input->post())
	    {
	        $password = $this->input->post('member_passwd');
	        $user_id = $this->input->post('member_id');
			$status = $this->input->post('memberstate');
	        $data = array(
	            'user_id' => $user_id,
	            'name' => $this->input->post('member_truename'),
	            'sex' => $this->input->post('member_sex'),
	            'mobile' => $this->input->post('member_mobile'),
	            'logo' => $this->input->post('img'),
	            'mobile_verify' => $this->input->post('membermobilebind'),
	            'status' => $status,
	        );

	        if (!empty($password))
	        {
	            $this->load->model('User_pwd_model');
				$user_pwd['pwd'] = md5(trim($password));
				$user_pwd['status'] =  $status;
	            $this->User_pwd_model->update_by_id($user_id,$user_pwd);
	        }

			$where['user_id'] = $user_id;
	        $this->User_model->update_by_where($where,$data);
	        
	        //redirect(ADMIN_SITE_URL.'/user');
	        $gotoUrl = ADMIN_SITE_URL.'/user';
            showDialog(lang('nc_common_op_succ'), $gotoUrl, 'succ');
	    }
	    
	    
	    $this->lang->load('admin_layout');
	    $this->lang->load('admin_user');
	    $where = array();
	    $where['user_id'] = $this->input->get('id');
	    $info = $this->User_model->get_by_where($where);
	    $this->load->model('Account_model');
	    $account = $this->Account_model->get_by_where($where);
        
	    if($info && $account){
	        $info=array_merge($info,$account);
	    }
	    
	    
	    $result = array(
	        'info' => $info,
	    );
	    $this->load->view('admin/user_edit',$result);
	}
	
	public function save()
	{
	    if ($this->input->post())
	    {
	        $config = array(
	            array(
	                'field'   => 'member_name',
	                'label'   => '会员名称',
	                'rules'   => 'trim|required'
	            ),
	            array(
	                'field'   => 'member_passwd',
	                'label'   => '会员密码',
	                'rules'   => 'trim|required'
	            ),
	            array(
	                'field'   => 'member_tel',
	                'label'   => '电子邮箱',
	                'rules'   => 'trim|required'
	            ),
	        );
	    }
	    
	    $this->form_validation->set_rules($config);
	    var_dump($this->form_validation->run());
	    if ($this->form_validation->run() === TRUE)
	    {
	        // $data = array(
	        //     'member_name' => $this->input->post('member_name'),
	        //     'member_passwd' => $this->input->post('member_passwd'),
	        //     'member_email' => $this->input->post('member_tel'),
	        //     'member_truename' => $this->input->post('member_truename'),
	        //     'member_name' => $this->input->post('img'),
	        // );

	        $user_pwd_data = array(
	            'user_name' => $this->input->post('member_name'),
	            'pwd' => md5(trim($this->input->post('member_passwd'))),
	            'status' => '1',
	            'platform_id' => '1',
	        );

	        $this->load->model('User_pwd_model');

	        if ($inset_id = $this->User_pwd_model->insert_string($user_pwd_data))
	        {
	            $this->load->model('User_num_model');
	            $user_data = array(
	                'user_id' => $inset_id,
	                'user_name' => $this->input->post('member_name'),
	                'name' =>$this->input->post('member_truename'),
	                'mobile' =>$this->input->post('member_tel'),
	                'logo' => $this->input->post('img'),
	                'sex' => $this->input->post('member_sex'),
	                'reg_time' => time(),
	                'reg_ip' => $_SERVER["REMOTE_ADDR"],
	                'update_time' => time(),
	                'status' => '1',
	                'platform_id' => '1',
	            );

	            $this->User_model->insert($user_data);
	            $user_num_data = array(
	                'user_id' => $inset_id,
	            );

	            $this->User_num_model->insert($user_num_data);
	            //redirect(ADMIN_SITE_URL.'/user');

	            $gotoUrl = ADMIN_SITE_URL.'/user';
                showDialog(lang('nc_common_op_succ'), $gotoUrl, 'succ');
				exit;
	        }    
	        else
            {
                //showMessage('商品添加失败', getReferer(), 'html', 'error');
                $gotoUrl = ADMIN_SITE_URL.'/user';
                showDialog(lang('store_goods_index_goods_edit_fail'), $gotoUrl);
            }   
	    }
	}

	public function del()
	{
	    $id = $this->input->post('del_id');
	    if ($id)
	    {
	        foreach ($id as $value)
	        {
	            $where['user_id'] = $id;
	            $data['status'] = -1;
	            $this->User_model->update_by_where($where,$data);
	        }
	    }
	    redirect(ADMIN_SITE_URL.'/user');
	}

	
	public function ajax_check_name()
	{
	    $user_name = $this->input->get('user_name');
	    if (!empty($user_name))
	    {
	        $this->load->model('User_pwd_model');
	        $where['user_name'] = "'$user_name'";
	        $res = $this->User_pwd_model->get_by_where($where);
	        if (!empty($res))
	        {
	            exit('false');
	        }
	        else 
	        {
	            exit('true');
	        }
	    }
	    else 
	    {
	        exit('false');
	    }
	}
}
