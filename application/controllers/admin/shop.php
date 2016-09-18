<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends MY_Admin_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Shop_model');
        $this->lang->load('admin_layout');
    }
    
	public function index() {
		
        $cKey = $this->input->post_get('txtKey');
		$page     = _get_page();//翻页  接收前台的页码
		$pagesize = 8;
		$arrParam = array();
		$arrWhere = array();
	
        if($cKey) {
		   	$arrParam['txtKey'] = $cKey; //翻页搜索
		   	$arrWhere['name like '] = "'%$cKey%'"; //搜索
		}
		
		$arrWhere['status <>'] = -1;
		$list = $this->Shop_model->fetch_page($page, $pagesize, $arrWhere,'*');
		//echo $this->Shop_model->db->last_query();
		//die;
		
		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/Shop', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();
		
		$result = array(
		    'list' => $list,
		    'arrParam' => $arrParam,
			);

	$this->load->view('admin/shop',$result);

	}

	public function add()
	{
		//$this->lang->load('admin_layout');
		$this->load->model('Area_model');

	    //需要修改
	    $id	= $this->input->get('id');
	    $result = array();
	    $info = array();

	    $arrPlace = $this->Shop_model->get_list();
	    if(!empty($id)) {

	        $info = $this->Shop_model->get_by_id($id);
	    }
	    $result = array(
	        'info'=>$info,
	        'arrPlace'=>$arrPlace,
	    );

	    $this->load->view('admin/shop_add', $result);
	}
	
	public function save() {

		$this->load->model('Shop_model');
		$this->load->model('User_pwd_model');
		$this->load->model('User_model');
		$this->load->service('sync_service');
		$id = $this->input->post('id');
		//输出所有post提交的表单内元素
	    if ($this->input->is_post()) {
	        //验证规则
	        $config = array(
	            array(
	                'field'   => 'name',//后台验证，表中的字段名
	                'label'   => '店铺名',
	                'rules'   => 'trim|required'//验证规划
	            ),
	            array(
	                'field'   => 'seller_username',
	                'label'   => '店家用户名',
	                'rules'   => 'trim|required'
	            )
	        );
	        $this->form_validation->set_rules($config);
	        if ($this->form_validation->run() === TRUE) {
	            $adcode = '';
				$seller_pwd = $this->input->post('seller_pwd'); //用户密码
				$seller_username = $this->input->post('seller_username'); //用户名
				$status = $this->input->post('status');
	            //将需要保存的数据赋值给数组$data
	            $data = array(
	                'name'				=> $this->input->post('name'),
	                'seller_username'	=> $seller_username,
	                'province_id'		=> $this->input->post('province_id'),
	                'city_id'			=> $this->input->post('city_id'),
	                'area_id'			=> $this->input->post('area_id'),
	                'lng'				=> $this->input->post('lng'),
	                'lat'				=> $this->input->post('lat'),
	                'address'			=> $this->input->post('address'),
	                'is_own'			=> $this->input->post('is_own'),
	                'status'			=> $status,
	            );

				$shopInfo =	$this->Shop_model->get_by_id($id);

				if(!empty($shopInfo)&&!empty($shopInfo['seller_userid'])){

						//用户密码表信息
						$userPwd = array(
								'id'			=> $shopInfo['seller_userid'],
								'user_name'		=> $seller_username,
								'status'		=> $status,
						);
					if(!empty($seller_pwd)) {
						$userPwd['pwd'] = md5($seller_pwd);
					}

					$this->User_pwd_model->insert($userPwd);
					$data['seller_userid'] = $shopInfo['seller_userid'];
					//用户表信息
					$userInfo = array(
							'user_id'		=> $shopInfo['seller_userid'],
							'user_name'		=> $seller_username,
							'status'		=> $status,
					);


					$this->User_model->insert($userInfo);
				}else{
					//用户密码表信息
					$userPwd = array(
							'user_name'		=> $seller_username,
							'status'		=> $status,
					);

					if(!empty($seller_pwd)) {
						$userPwd['pwd'] = md5($seller_pwd);
					}

					$user_id = $this->User_pwd_model->insert_string($userPwd);
					$data['seller_userid'] = $user_id;
					//用户表信息
					$userInfo = array(
							'user_id'		=> $user_id,
							'user_name'		=> $seller_username,
							'status'		=> $status,
					);
					$this->User_model->insert_string($userInfo);
				}

				if($id) {
	                $data['id'] = $id;
	                $this->Shop_model->update_by_id($id,$data);
	            } else {
	            	//保存至数据库
	            	$id = $this->Shop_model->insert_string($data);
	            }
	            //开启店铺状态,同步数据
	            if($status==1){
	            	$this->sync_service->allTplByShopId($id);
	            }

	            redirect(ADMIN_SITE_URL.'/shop');
	            exit;
	        } else {
				//echo base_url('/admin/shop1');die;
	            redirect(ADMIN_SITE_URL.'/shop/add');
	        }
	    }
	}

	function del(){
	    if ($this->input->is_post()) {

	        $id = $this->input->post('del_id');
			foreach($id as $k=>$v) {
				$page = _get_page();
				$data['status'] = -1;
				// 调用修改状态方法
	    		$this->Shop_model->update_by_id($v,$data);
			}
	    } else {
	        $id	= $this->input->get('id');
			$page = _get_page();
			$data['status'] = -1;
		// 调用修改状态方法
	    	$this->Shop_model->update_by_id($id,$data);
	    }
	    redirect( ADMIN_SITE_URL.'/shop' );
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
				echo 'false';
				exit;
			}
		}else{
			$userInfo = $this->User_model->get_by_where('user_name = "'.$seller_username.'"');
			if(!empty($userInfo)){
				echo 'false';
				exit;
			}
		}
		echo 'true';
		exit;

	}

}
?>