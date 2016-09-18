<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Offpay_area extends MY_Admin_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Area_model');
		$this->load->model('Deliver_model');
    }
    
	public function index()
	{
		$this->lang->load('admin_layout');
		
		
		$list = $this->Area_model->getAreaArrayForJson();
		$area = $this->Area_model->getAreas();
		$where['shop_id'] = 1;
		$province = $list[0];
		$area_checked = $this->Deliver_model->get_city_checked_child_array($where);
		$city_checked_child_array = array();
		if (!empty($area_checked['county']))
		{
		    foreach ($area_checked['county'] as $key=>$value)
		    {
		        $city_checked_child_array[$area['parent'][$value]][] = $value;
		    }
		}
		foreach ($area_checked['city'] as $key=>$value)
		{
		    if(!isset($city_checked_child_array[$value]))
		    {
		        $city_checked_child_array[$value] = array();
		    }    
		}
        $result = array(
            'province' => $province,
            'list' => $list,
            'city_checked_child_array' =>$city_checked_child_array,
            'area' => $area,
        );
        
		$this->load->view('admin/offpay_area',$result);
	}
	
	public function save()
	{
	    if ($this->input->post())
	    {
	        $county = $this->input->post('county');
	        $city = $this->input->post('city');
	        $province = $this->input->post('province');
	        $area = 'province|';
	        if (!empty($province))
	        {
	            foreach ($province as $key => $value)
	            {
	                $area .= $value.',';
	            }
	        }
	        $area .= '|city|';
	        if (!empty($city))
	        {
	            foreach ($city as $key => $value)
	            {
	                $area .= $value.',';
	            }
	        }
	        $area .= '|county|';
	        if (!empty($county))
	        {
	            $area .= $county;
	        }
	        $data['area_id'] = $area;
	        
	        $where['shop_id'] = 1;
	        $this->Deliver_model->update_by_where($where,$data);
	        redirect(ADMIN_SITE_URL.'/offpay_area');
	    }
	}
	
}
