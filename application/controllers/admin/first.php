<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class First extends MY_Admin_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('First_model');
    }
    
	public function index()
	{
		$this->lang->load('admin_first');
		$first_place = $this->input->post_get('place_id');
		$field = $this->input->post_get('field');
		$cKey = $this->input->post_get('key');
		$fieldDate = $this->input->post_get('fieldDate');
		$begtime = $this->input->post_get('begtime');
		$endtime = $this->input->post_get('endtime');
		$orderby = $this->input->post_get('orderby');
        
		
		if($field=='ti_tle')
		    $field = 'title';

		$page     = _get_page();
		$pagesize = 10;
		$arrParam = array();
		$arrWhere = array();
		if($first_place)
		{
		    $arrParam['place_id'] = $first_place;
		    $arrWhere['place_id'] = $first_place;
		}
		
		if($cKey)
		{
		    $arrParam['key'] = $cKey;
		    if($field=='adcode')
		        $arrWhere[$field] = "'$cKey'";
		    else
		        $arrWhere[$field.' like '] = "'%$cKey%'";
		}
		$arrParam['field'] = $field;
		
		
		if($begtime)
		{
		    $arrParam['begtime'] = $begtime;
		    $arrWhere['effect_time >="'] = strtotime($begtime).'"';
		}
		if($endtime)
		{
		    $arrParam['endtime'] = $endtime;
		    $arrWhere['effect_time <="'] = strtotime($endtime).'"';
		}

		
		$strOrder = 'place_id asc,sort desc';
		if($orderby)
		{
		    $arrParam['orderby'] = $orderby;
		}
		else 
		{
		    $arrParam['orderby'] = '';
		}
		$arrWhere['status <>'] = -1;
		
		$list = $this->First_model->fetch_page($page, $pagesize, $arrWhere,'*',$strOrder);
		//echo $this->db->last_query();die;
		$this->load->model('First_Place_Model');
		$ad_placeList = $this->First_Place_Model->get_list();
		
		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/first', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;

		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();
		foreach ($ad_placeList as $key=>$value){
		    $ad_place[$value['id']] = $value['name'];
		}
		foreach ($list['rows'] as $key=>$value)
		{
			$place_name = '';
			if(!empty($value['place_id']) && !empty($ad_place[$value['place_id']]))
				$place_name = $ad_place[$value['place_id']];
		    $list['rows'][$key]['place_name'] = $place_name;

		}
		$result = array(
			'output'=>array(
			   
				'html_title'=>lang('login_index_title_02'),
				'map_nav' => array(),
				'admin_info' => array('name'=>''),
				'top_nav' => '',
				'left_nav'=>'',
				),
		    'list' => $list,
		    'arrParam' => $arrParam,
		    'arrWhere' =>$arrWhere,
		    'ad_placeList'=>$ad_place,
			);

		$this->load->view('admin/first',$result);
	}
	
	public function add()
	{
	    
	    $this->lang->load('admin_first');
	    
	    //需要修改
	    $id	= $this->input->get('id');
	    $result = array();
	    $info = array();
	
	    $this->load->model('First_Place_Model');
	    $arrPlace = $this->First_Place_Model->get_list();
	    if(!empty($id))
	    {
	        $info = $this->First_model->get_by_id($id);
	        $place = $this->First_Place_Model->get_by_id($info['place_id'],'name');
	        $info['place_name'] = $place['name'];
	    }	
	    $result = array(
	        'info'=>$info,
	        'arrPlace'=>$arrPlace,
	        'list_url' =>$_SERVER['HTTP_REFERER'],
	    );
	    $this->load->view('admin/first_add', $result);
	}
	
	public function save()
	{
	    if ($this->input->is_post())
	    {
	        //验证规则
	        $config = array(
	            array(
	                'field'   => 'adv_name',
	                'label'   => '广告名称',
	                'rules'   => 'trim|required'
	            ),
	            array(
	                'field'   => 'ap_id',
	                'label'   => '广告位id',
	                'rules'   => 'trim|required'
	            ),
	        );
	    
	        $this->form_validation->set_rules($config);
	    
	        if ($this->form_validation->run() === TRUE)
	        {
	            $placeid = (int)$this->input->post('placeid');
	            $adcode = '';
	            $this->load->model('First_Place_model');
	            $oPlace = $this->First_Place_model->get_by_id($placeid);
	            if($oPlace)
	                $adcode = $oPlace['adcode'];
	            //将需要保存的数据赋值给数组$data
	            $data = array(
	                'title'=>$this->input->post('adv_name'),
	                'place_id'=>$this->input->post('ap_id'),
	                'content'=>$this->input->post('content'),
	                'memo'=>$this->input->post('memo'),
	                'url'=>$_POST['adv_url'],
	                'sort'=>$this->input->post('sort'),
	                'addtime'=>time(),
	                'updatetime'=>time(),
	                'effect_time'=>time(),
	                'expire_time'=>time(),
	                'status'=> $this->input->post('status')?$this->input->post('status'):0,
	                'title_style'=>$this->input->post('title_style'),
	            );
	            if($this->input->post('img'))
	            {
	                $data['pic'] = $this->input->post('img');
	            }
	            else 
	            { 
	                $data['pic'] = $this->input->post('orig_img');
	            }
	            $id	= $this->input->post('id');
	            if($id)
	                $data['id'] = $id;
	            //保存至数据库
	            $this->First_model->insert($data);
	    
	            //echo '成功,<a href="/admin/aa">返回列表页</a>';
	            //redirect(ADMIN_SITE_URL.'/first');
	            header("Location:{$_POST['list_url']}");
	            exit;
	        }
	        else
	        {
	            //redirect(ADMIN_SITE_URL.'/first');
	            header("Location:{$_POST['list_url']}");
	        }
	        	
	    }
	}
	
	
	function del(){
	    if ($this->input->is_post())
	    {
	        $id = $this->input->post('del_id');
	    }
	    else
	    {
	        $id	= $this->input->get('id');
	    }
	    $page = _get_page();
	    $data['status'] = -1;
	    $where['id'] = $id;
        $this->First_model->update_by_where($where,$data);
        showMessage('删除成功');
	    //redirect( ADMIN_SITE_URL.'/first' );
	
	}
}
