<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flea_Region extends MY_Admin_Controller {
	
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Area_model');
    }
    
	public function index()
	{
		$this->lang->load('admin_layout');
		$this->lang->load('admin_flea_region');
		$flea_area_parent_id = $this->input->get('flea_area_parent_id');
		if(empty($flea_area_parent_id))
		{
		    $flea_area_parent_id = 0;
		}
		$a = $this->Area_model->getAreas();
		//var_dump($a);exit;
		$area = $this->Area_model->getAreaArrayForJson();
		$province = array();
		if (!empty($area))
		{
		    $province = $area['0'];
		}
		
		$provincetype = $this->input->get('province');
		$city = array();
		if ($provincetype != 0 )
		{
		    if(!empty($area[$provincetype]))
		    {
		        $city = $area[$provincetype];
		    }
		    
		}
		$citytype = $this->input->get('city');
		$list = array();
		if(!empty($area[$flea_area_parent_id]))
		{
		    $list = $area[$flea_area_parent_id];
		}
		
// 		$where['parent_id'] = $flea_area_parent_id;
// 		$list = $this->Area_model->get_list($where);
		//var_dump($list);exit;
		if (!empty($citytype))
		{
		    $child_area_deep = 3;
		}
		elseif (!empty($provincetype))
		{
		    $child_area_deep = 2;
		}
		else 
		{
		    $child_area_deep = 1;
		}
		$result = array(
		    'province' => $province,
		    'city' => $city,
		    'list' => $list,
		    'ptype' => $provincetype,
		    'ctype' => $citytype,
		    'flea_area_parent_id' => $flea_area_parent_id,
		    'child_area_deep' => $child_area_deep,
		);
		$this->load->view('admin/flea_region',$result);
	}
	
	public function save()
	{
	    //新增地区数据
	    $province_id = $this->input->post('province_id');
	    $flea_area_parent_id = $this->input->post('flea_area_parent_id');
	    $child_area_deep = $this->input->post('child_area_deep');
	    $new_area_sort = $this->input->post('new_area_sort');
	    $new_area_name = $this->input->post('new_area_name');
	    
	    if (!empty($new_area_sort))
	    {
	        $this->Area_model->add($new_area_sort,$new_area_name,$flea_area_parent_id,$child_area_deep);
	    }
	    
	    //删除地区数据
	    $del_ids = $this->input->post('hidden_del_id');
	    if (!empty($del_ids))
	    {
	        $this->Area_model->del($del_ids,$child_area_deep);
	    }
	    if ($child_area_deep == 0)
	    {
	        redirect( ADMIN_SITE_URL.'/flea_region?flea_area_parent_id=0&province=0' );
	    }
	    elseif ($child_area_deep == 1)
	    {
	        redirect( ADMIN_SITE_URL.'/flea_region?flea_area_parent_id='.$flea_area_parent_id.'&province='.$province_id );
	    }
	    else
	    {
	        redirect( ADMIN_SITE_URL.'/flea_region?flea_area_parent_id='.$flea_area_parent_id.'&province='.$province_id.'&city='.$flea_area_parent_id );
	    }
	}
}
