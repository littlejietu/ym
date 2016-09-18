<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operation extends MY_Admin_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Wordbook_model');
    }
	
	public function index()
	{
	    
		$this->lang->load('admin_setting');
		$this->lang->load('admin_layout');
        
		$result = $this->Wordbook_model->get_list();
		$list = array();
		foreach ($result as $key=>$value)
		{
		    $list[$value['k']] = $value['val'];
		}
		$result = array(
		    'list'=>$list,
		);

		$this->load->view('admin/operation',$result);
	}
	
	public function save()
	{
	    if ($this->input->is_post())
	    {
	        $data = array(
	            'apkdownload_url'=>$this->input->post('apkdownload_url'),
	            'activity_url'=>$this->input->post('activity_url'),
	            'order_commis_day'=>$this->input->post('order_commis_day'),
	            'distribute_rate_1'=>$this->input->post('distribute_rate_1'),
	            'distribute_rate_2'=>$this->input->post('distribute_rate_2'),
	            'distribute_rate_3'=>$this->input->post('distribute_rate_3'),
	            'distribute_rate_4'=>$this->input->post('distribute_rate_4'),
	            'distribute_rate_5'=>$this->input->post('distribute_rate_5'),
	            'distribute_rate_6'=>$this->input->post('distribute_rate_6'),
	            'distribute_rate_7'=>$this->input->post('distribute_rate_7'),
	            'distribute_rate_8'=>$this->input->post('distribute_rate_8'),
	            'distribute_rate_9'=>$this->input->post('distribute_rate_9'),
	            'distribute_rate_10'=>$this->input->post('distribute_rate_10'),
	            'start_ad'=>$this->input->post('start_ad'),
	            'start_ad_time'=>$this->input->post('start_ad_time'),
	            'order_confirm_day'=>$this->input->post('order_confirm_day'),
	            );
	            $this->Wordbook_model->updateSetting($data);
	            
	            redirect(ADMIN_SITE_URL.'/operation');
	        }
	    }
}
