<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel extends MY_Admin_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->service('excel_service');
        $this->load->model('Order_model');
    }
	
    /**
     * 导出总报表
     */
    public function export_all()
    {
        $this->lang->load('admin_layout');
        $this->lang->load('admin_excel');
        $this->load->view('admin/excel_all');
    }
    
    /**
     * 导出店铺报表
     */
	public function export_by_shop()
	{
	    $this->lang->load('admin_layout');
	    $this->lang->load('admin_excel');
	    $this->load->view('admin/excel_shop');
	}
	
	/**
	 * 导出地区报表
	 */
    public function export_by_area()
	{
	    $this->lang->load('admin_layout');
	    $this->lang->load('admin_excel');
	    $this->load->model('Area_model');
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
	    $this->load->view('admin/excel_area');
	} 
	
	/**
	 * 生成(下载)总报表文件
	 */
	public function export_excel_all()
	{
	    $field_name = $this->input->post('field_name')?$this->input->post('field_name'):'data';
	    $start_time = strtotime($this->input->post('start_time').'00:00:00');
	    $end_time = strtotime($this->input->post('end_time').'23:59:59');
	    $action = $this->input->post('action');
	    $data = array();
	    $title = array();
	    $title = array('商品名','规格','成本价','销售价','销量','总成本价','总销售额','','店铺总成本','店铺总销售额','起始时间','结束时间');
	    $data = $this->excel_service->get_all_excel_datas($start_time,$end_time);
	    
	    $this->excel_service->push_to_excel($data,$field_name,$start_time,$end_time,$title,$action);
	}
	
	/**
	 * 生成(下载)店铺报表文件
	 */
	public function export_excel_shop()
	{
	    $field_name = $this->input->post('field_name')?$this->input->post('field_name'):'data';
	    $start_time = strtotime($this->input->post('start_time').'00:00:00');
	    $end_time = strtotime($this->input->post('end_time').'23:59:59');
	    $seller_username = $this->input->post('seller_username');
	    $action = $this->input->post('action');
	    
	    $data = array();
	    $title = array();
	    $title = array('商品名','规格','成本价','销售价','销量','总成本价','总销售额','','店铺总成本','店铺总销售额','起始时间','结束时间');
	    $data = $this->excel_service->get_excel_datas_by_shop($seller_username,$start_time,$end_time);
	    
	    $this->excel_service->push_to_excel($data,$field_name,$start_time,$end_time,$title,$action);
	}
	
	/**
	 * 生成(下载)地区报表文件
	 */
	public function export_excel_area()
	{
	    $field_name = $this->input->post('field_name')?$this->input->post('field_name'):'data';
	    $start_time = strtotime($this->input->post('start_time').'00:00:00');
	    $end_time = strtotime($this->input->post('end_time').'23:59:59');
	    $province_id = $this->input->post('province_id');
	    $city_id = $this->input->post('city_id');
	    $action = $this->input->post('action');
	    
	    $data = array();
	    $title = array();
	    $area = array();
	    $title = array('商品名','规格','成本价','销售价','销量','总成本价','总销售额','','地区','地区总成本','地区销售额','起始时间','结束时间');
	    $data = $this->excel_service->get_excel_datas_by_area($city_id,$start_time,$end_time);
	    $area['province_id'] = $province_id;
	    $area['city_id'] = $city_id;
	    
	    $this->excel_service->push_to_excel($data,$field_name,$start_time,$end_time,$title,$action,$area);
	}
	
	/**
	 * 查询用户名是否重复
	 */
	function repeat_seller_username(){
	
	    $this->load->model('User_model');
	
	    $user_id 		 = $this->input->get('user_id');
	    $seller_username = $this->input->get('seller_username');
	
	    if(!empty($user_id)) {
	        $userInfo = $this->User_model->get_by_where('user_id !='.$user_id.' and user_name = "'.$seller_username.'"');
	        if(!empty($userInfo)){
	            echo 'true';
	            exit;
	        }
	    }else{
	        $userInfo = $this->User_model->get_by_where('user_name = "'.$seller_username.'"');
	        if(!empty($userInfo)){
	            echo 'true';
	            exit;
	        }
	    }
	    echo 'false';
	    exit;
	
	}
	
	
}