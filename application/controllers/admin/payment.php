<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends MY_Admin_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Payment_model');
    }
    
	public function index()
	{
	    $this->lang->load('admin_layout');
	    $this->lang->load('admin_payment');
	    
	    $list = $this->Payment_model->get_list();
	    
	    $result = array(
	        'list' => $list,
	    );
	    $this->load->view('admin/payment',$result);
	}
	
	public function edit()
	{
	    $this->lang->load('admin_layout');
	    $this->lang->load('admin_payment');
	    
	    if ($this->input->get('id'))
	    {
	        $id = $this->input->get('id');
	        $info = $this->Payment_model->get_by_id($id);
	        $config = $this->Payment_model->get_config_by_id($id);
	        $result = array(
	            'info' => $info,
	            'config' =>$config,
	        );
	        $this->load->view('admin/payment_edit',$result);
	    }
	    
	}
	
	public function save()
	{
	    if ($this->input->post())
	    {
	        $config = array(
	            array(
	                'field'   => 'payment_id',
	                'label'   => '支付方式id',
	                'rules'   => 'trim|required'
	            ),
	            array(
	                'field'   => 'payment_status',
	                'label'   => '当前支付方式的状态',
	                'rules'   => 'trim|required'
	            ),
// 	            array(
// 	                'field'   => 'config_name',
// 	                'label'   => '配置',
// 	                'rules'   => 'trim|required'
// 	            ),
	        );
	        
	        $this->form_validation->set_rules($config);
	        if ($this->form_validation->run() === TRUE)
	        {
	            $id =  $this->input->post('payment_id');
	            $config_name = $this->input->post('config_name');
	            $config = '';
	            if (!empty($config_name))
	            {
	                $config_name = explode(',',$config_name);
	                $config = '';
	                foreach ($config_name as $key => $value)
	                {
	                    $config .= $value.','.$this->input->post($value).'|';
	                }
	            }
	            
	        }
	        $data = array(
	            'config' => $config,
	            'status' => $this->input->post('payment_status'),
	        );
	        
	        if ($this->Payment_model->update_by_id($id,$data))
	        {
	            redirect(ADMIN_SITE_URL.'/payment');
	        }
	    }
	}
}
