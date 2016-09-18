<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends MY_Admin_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Feedback_model');
    }
    
	public function index()
	{
		//$this->lang->load('admin_Feedback');//无法加载语言包就去掉着一句
		$ad_place = $this->input->post_get('ad_place');

		
		$cKey = $this->input->post_get('txtKey');
		
		$page     = _get_page();//接收前台的页码
		
		$pagesize = 8;
		$arrParam = array();
		$arrWhere = array();
		if($ad_place)
		{
		    $arrParam['ad_place'] = $ad_place;
		    $arrWhere['ad_place'] = $ad_place;
		}
		
		if($cKey)
		{
		    $arrParam['txtKey'] = $cKey;
		    $arrWhere['content like '] = "'%$cKey%'";
		}

		$strOrder = 'addtime desc';
		$arrWhere['status <>'] = -1;
		
		$list = $this->Feedback_model->fetch_page($page, $pagesize, $arrWhere,'*',$strOrder);
		//var_dump($page, $pagesize);die;
		//echo $this->db->last_query();die;
		//$this->load->model('Feedback_Place_Model');
		//$ad_placeList = $this->Feedback_Place_Model->get_list();
		
		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/Feedback', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();
		// foreach ($ad_placeList as $key=>$value){
		//     $ad_place[$value['id']] = $value['title'];
		// }
		$result = array(
		    'list' => $list,
		
		    'arrParam' => $arrParam,
			);
			//var_dump($list);die;
		$this->load->view('admin/feedback',$result);
	}
	

	
	
	
	
	public function save()
	{		
	
		//var_dump();die;
			//echo time();die;//
	    //$this->lang->load('admin_Feedback');
		
		
		//输出所有post提交的表单内元素
	//var_dump($_POST);//exit;
	    if ($this->input->is_post())
	    {
	        //验证规则
	        $config = array(
	            array(
	                'field'   => 'content',//后台验证，表中的字段名
	                'label'   => '内容',
	                'rules'   => 'trim|required'//验证规划
	            ),
	        );
	  
	        $this->form_validation->set_rules($config);
	    
	        if ($this->form_validation->run() === TRUE)
	        {
	            $id = (int)$this->input->post('id');
				echo $id;
	            $adcode = '';
	            $this->load->model('Feedback_model');
	            //$oPlace = $this->Feedback_Place_model->get_by_id($id);
	            if($oPlace)
	                $adcode = $oPlace['adcode'];
	            //将需要保存的数据赋值给数组$data
	            $data = array(
	                'user_id'=>$this->input->post('user_id'),
	                'user_name'=>$this->input->post('user_name'),
	                'mobile'=>$this->input->post('mobile'),
	                'content'=>$this->input->post('content'),
	                'addtime'=>time(),
	                'status'=>$this->input->post('status'),
	                'platform_id'=>$this->input->post('platform_id'),
	            );
	    
	            $id	= $this->input->post('id');
	            if($id)
	                $data['id'] = $id;					
			 
	            $id	= $this->input->post('id');
	            if($id)
	                $data['id'] = $id;
					
	            //保存至数据库
	            $this->Feedback_model->insert($data);
				
	            //echo '成功,<a href="/admin/aa">返回列表页</a>';
				
				//echo base_url('/admin/feedback');die;
	            redirect(ADMIN_SITE_URL.'/feedback');
	            exit;
	        }
	    }
	}

	function del(){
	    if ($this->input->is_post())
	    {	
	        $id = $this->input->post('del_id');
			//var_dump($id);
			//var_dump($id);die;
			foreach($id as $k=>$v){
				
				$page = _get_page();
				$data['status'] = -1;
				// 调用修改状态方法
	    		$this->Feedback_model->update_by_id($v,$data);
			}
			
	    }
	    else
	    {
	        $id	= $this->input->get('id');
			$page = _get_page();
			$data['status'] = -1;
		// 调用修改状态方法
	    	$this->Feedback_model->update_by_id($id,$data);
			;
	    }
	    
	    //redirect( ADMIN_SITE_URL.'/Feedback' );
	    header("Location:{$_SERVER['HTTP_REFERER']}");
	
	}
}
?>