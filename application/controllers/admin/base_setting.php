<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Setting extends MY_Admin_Controller {
	
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Wordbook_model');
    }
    
	public function index()
	{
		$this->lang->load('admin_setting');
		$this->lang->load('admin_layout');
        
		$list = $this->Wordbook_model->getList();
		$result = array(
		    'list'=>$list,
		);
		$this->load->view('admin/base_setting',$result);
	}
	

	//防灌水设置
	public function dump()
	{
	    $this->lang->load('admin_setting');
	    $this->lang->load('admin_layout');
	    
	    if ($this->input->is_post())
	    {
	        $config = array(
	            array(
	                'field'   => 'guest_comment',
	                'label'   => '允许游客咨询',
	                'rules'   => 'trim|required'
	            ),
	        );
	        
	        $this->form_validation->set_rules($config);
	        if ($this->form_validation->run() === TRUE)
	        {
	            $data = array();
	            $data['guest_comment'] = $this->input->post('guest_comment');
	            if ($this->input->post('captcha_status_login'))
	            {
	                $data['captcha_status_login'] = $this->input->post('captcha_status_login');
	            }
	            else 
	            {
	                $data['captcha_status_login'] = 0;
	            }
	            if ($this->input->post('captcha_status_register'))
	            {
	                $data['captcha_status_register'] = $this->input->post('captcha_status_register');
	            }
	            else
	            {
	                $data['captcha_status_register'] = 0;
	            }
	            if ($this->input->post('captcha_status_goodsqa'))
	            {
	                $data['captcha_status_goodsqa'] = $this->input->post('captcha_status_goodsqa');
	            }
	            else
	            {
	                $data['captcha_status_goodsqa'] = 0;
	            }

	            $this->Wordbook_model->updateSetting($data);
	            redirect(ADMIN_SITE_URL.'/base_setting');
	            // foreach ($data as $key=>$value)
	            // {
	            //     $where['k'] = $key;
	            //     $datas['val'] = $value;
	            //     $this->Wordbook_model->update_by_where($where,$datas);
	            // }
	            
	        }
	    }
	    
	    //不是通过post提交则执行以下代码
	    $result = $this->Wordbook_model->get_list();
	    $list = array();
	    foreach ($result as $key=>$value)
	    {
	        $list[$value['k']] = $value['val'];
	    }
	    $result = array(
	        'list'=>$list,
	    );
	    $this->load->view('admin/deny_dump',$result);
	}
	
	public function save()
	{
	    if ($this->input->is_post())
	    {
	        $config = array(
	            array(
	                'field'   => 'site_name',
	                'label'   => '网站名称',
	                'rules'   => 'trim|required'
	            ),
	        );
	    }
	    
	    $this->form_validation->set_rules($config);
	    if ($this->form_validation->run() === TRUE)
	    {
	        $data = array(
	            'site_name'=>$this->input->post('site_name'),
	            'icp_number'=>$this->input->post('icp_number'),
	            'site_phone'=>$this->input->post('site_phone'),
	            'site_tel400'=>$this->input->post('site_tel400'),
	            'site_email'=>$this->input->post('site_email'),
	            'statistics_code'=>$this->input->post('statistics_code'),
	            'time_zone'=>$this->input->post('time_zone'),
	            'site_status'=>$this->input->post('site_status'),
	            'closed_reason'=>$this->input->post('closed_reason'),
	        );
	        if ($this->input->post('img')){
	            $data['img'] = $this->input->post('img');
	        }
	        else 
	        {
	            $data['img'] = $this->input->post('orig_img');
	        }
	        if ($this->input->post('logo')){
	            $data['logo'] = $this->input->post('logo');
	        }
	        else
	        {
	            $data['logo'] = $this->input->post('orig_logo');
	        }
	        if ($this->input->post('member_logo')){
	            $data['member_logo'] = $this->input->post('member_logo');
	        }
	        else
	        {
	            $data['member_logo'] = $this->input->post('orig_member_logo');
	        }
	        if ($this->input->post('seller_logo')){
	            $data['seller_logo'] = $this->input->post('seller_logo');
	        }
	        else
	        {
	            $data['seller_logo'] = $this->input->post('orig_seller_logo');
	        }
	        if ($this->input->post('site_logowx')){
	            $data['site_logowx'] = $this->input->post('site_logowx');
	        }
	        else
	        {
	            $data['site_logowx'] = $this->input->post('orig_site_logowx');
	        }

	        $this->Wordbook_model->updateSetting($data);
	        // var_dump($data);exit;
	        // foreach ($data as $key=>$value)
	        // {
	        //     $where['k'] = $key;
	        //     $datas['val'] = $value;
	        //     $this->Wordbook_model->update_by_where($where,$datas);
	        // }
	        redirect(ADMIN_SITE_URL.'/base_setting');
	    }
	    
	   
	}
}
