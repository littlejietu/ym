<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_Place extends MY_Admin_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Article_Place_Model');
    }
    
	public function index()
	{
		//$this->lang->load('admin_article_place');//无法加载语言包就去掉着一句
		$ad_place = $this->input->post_get('ad_place');
		$field = $this->input->post_get('field');
		$cKey = $this->input->post_get('txtKey');
		$fieldDate = $this->input->post_get('fieldDate');
		$begtime = $this->input->post_get('begtime');
		$endtime = $this->input->post_get('endtime');
		$orderby = $this->input->post_get('orderby');
		
        
		
		if($field=='ti_tle')
		    $field = 'name';
		//var_dump($field);die;
		$page     = _get_page();//接收前台的页码
		
		$pagesize = 200;
		$arrParam = array();
		$arrWhere = array();
		if($ad_place)
		{
		    $arrParam['ad_place'] = $ad_place;
		    $arrWhere['ad_place'] = $ad_place;
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
		$arrParam['fieldDate'] = $fieldDate;
		
		if($begtime)
		{
		    $arrParam['begtime'] = $begtime;
		    $arrWhere["$fieldDate >="] = strtotime($begtime);
		}
		if($endtime)
		{
		    $arrParam['endtime'] = $endtime;
		    $arrWhere["$fieldDate <="] = strtotime("$endtime 23:59:59");
		}
		$strOrder = 'id desc';
		if($orderby)
		{
		    $arrParam['orderby'] = $orderby;
		    $strOrder = $orderby;
		}
        //只是删除视图里的显示，相当于隐藏数据，不是物理删除
		else 
		{
		    $arrParam['orderby'] = '';
		}
		$arrWhere['status <>'] = -1;
		
		$list = $this->Article_Place_Model->fetch_page($page, $pagesize, $arrWhere);
		//var_dump($page, $pagesize);die;
		//echo $this->db->last_query();die;
		$this->load->model('Article_Place_Model');
		$ad_placeList = $this->Article_Place_Model->get_list();
		
		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/article_place', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();
		foreach ($ad_placeList as $key=>$value){
		    $ad_place[$value['id']] = $value['name'];
		}
		///d打印数组
		//var_dump($list);die;
		foreach ($list['rows'] as $key=>$value){
		    $place = $this->Article_Place_Model->get_by_id($value['id'],'name');
		    $list['rows'][$key]['place_name'] = $place['name'];
		}
		$result = array(
			'output'=>array(
			    'ap_name'=>'',
				//'html_name'=>lang('login_index_name_02'),
				'map_nav' => array(),
				'admin_info' => array('name'=>''),
				'top_nav' => '',
				'left_nav'=>'',
			    'page'=>'',
				),
		    'list' => $list,
	
		    'arrParam' => $arrParam,
		    'ad_placeList'=>$ad_placeList,
			);
			//var_dump($list);die;
		$this->load->view('admin/article_place',$result);
	}
	

	
	
	public function add()
	{
		//输出添加时间然后结束
		//echo time();die;//
		//var_dump($id);
	    //$this->lang->load('admin_article_place');//语言包
	    
	    //需要修改
	    $id	= $this->input->get('id');
	    $result = array();
	    $info = array();
		
		
		
	    $this->load->model('Article_Place_Model');
	    $arrPlace = $this->Article_Place_Model->get_list();
	
	    if(!empty($id))
	    {
	        $info = $this->Article_Place_Model->get_by_id($id);
	        $place = $this->Article_Place_Model->get_by_id($info['id'],'name');
	        $info['name'] = $place['name'];
	    }
	
	    $result = array(
	        'info'=>$info,
	        'arrPlace'=>$arrPlace,
	    );
	//var_dump($info);die;
	    $this->load->view('admin/article_place_add', $result);
	}
	
	public function save()
	{		
	
		
			//echo time();//
	    //$this->lang->load('admin_article_place');
		
		
		//输出所有post提交的表单内元素
	//var_dump($_POST);//exit;
	    if ($this->input->is_post())
	    {  //var_dump($post);die;
	    /*
	        //验证规则
	        $config = array(
	            array(
	                'field'   => 'name',//后台验证，表中的字段名
	                'label'   => '链接名称',
	                'rules'   => 'trim|required'//验证规划
	            ),
	           
				
	            array(
	                'field'   => 'url',
	                'label'   => '链接地址',
	                'rules'   => 'trim|required'
	            )
	        );*/
	  // echo time();
	  // print_r();
	     // $this->form_validation->set_rules($config);
	     //echo time();die;
	      /*  if ($this->form_validation->run() === TRUE)
	        {//echo time();die;*/
	            $id = (int)$this->input->post('id');
				echo $id;
	            $adcode = '';
	            $this->load->model('Article_Place_Model');
	            //$oPlace = $this->Article_Place_Model->get_by_id($id);
	            if($oPlace)
	                $adcode = $oPlace['adcode'];
	            //将需要保存的数据赋值给数组$data
	            $data = array(
	                'name'=>$this->input->post('name'),
	                'parent_id'=>$this->input->post('parent_id'),
	            
	                
	                'sort'=>$this->input->post('sort'),
	                
	                'status'=>$this->input->post('status'),
	            );
	    
	            $id	= $this->input->post('id');
	            if($id)
	                $data['id'] = $id;
	            //var_dump($date);die;
//接收图片必须用这个，数据库里才会有图片名字					
			/* if($this->input->post('img'))
	            {
	                $data['pic'] = $this->input->post('img');
	            }
	            else 
	            { 
	                $data['pic'] = $this->input->post('orig_img');
	            }
	            $id	= $this->input->post('id');
	            if($id)
	                $data['id'] = $id;*/
					
					
					
	            //保存至数据库
	            $this->Article_Place_Model->insert($data);
				
			
	            //echo '成功,<a href="/admin/aa">返回列表页</a>';
				
				//echo base_url('/admin/article_place');die;
	            redirect(ADMIN_SITE_URL.'/article_place');
	            exit;
	        }
	        else
	        {//echo base_url('/admin/article_place1');die;
	            redirect(ADMIN_SITE_URL.'/article_place/add');
	        }
	        	
	   
	}
	
	
	function del(){
	    if ($this->input->is_post())
	    {	
	        $id = $this->input->post('del_id');
			//var_dump($id);
			//var_dump($id);die;
//删除俩个或一两个以上，ID传过来的是一个数组,(1)先把$id遍历出来，然后把方法放到循环里执行
			foreach($id as $k=>$v){
				
				$page = _get_page();//接收页码
				$data['status'] = -1;//状态改为-1，默认隐藏。
				// 调用修改状态方法
	    		$this->Article_Place_Model->update_by_id($v,$data);//执行修改方法，并没有删除物理文件
				//要想删除物理文件 调用 delete_by_id($id); 方法
			}
			
	    }
	    else
	    {
	        $id	= $this->input->get('id'); //单个删除
			$page = _get_page();
			$data['status'] = -1;
		// 调用修改状态方法
	    	$this->Article_Place_Model->update_by_id($id,$data);
			;
	    }
	    
	    redirect( ADMIN_SITE_URL.'/article_place' );
		
	
	}
}
/////////////////////////////////////////////////////////////////////




?>


