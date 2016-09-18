<?php
/**
 * 商品模块下的商品管理
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Goods_tpl extends MY_Admin_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Goods_tpl_model');
    }
    
	/**
	 * 商品管理首页：所有商品
	 */
	public function index()
	{
		$this->lang->load('admin_layout');
		$this->lang->load('admin_goods');
		$this->load->model('Brand_model');
		$this->load->model('Category_model');
		$this->load->helper('Goods');

		$search_goods_name 	= $this->input->post_get('search_goods_name' );
		$search_commonid 	= $this->input->post_get('search_commonid' );
		$search_store_name 	= $this->input->post_get('search_store_name' );
		$b_name	 			= $this->input->post_get('b_name');
		$b_id 				= $this->input->post_get('b_id' );
		$search_state 		= $this->input->post_get('search_state' );
		$choose_cid 		= $this->input->post_get('choose_cid');
		$category_id_1 = $this->input->post_get('category_id_1');
		$category_id_2 = $this->input->post_get('category_id_2');

		//获取品牌列表
		//$brand_list 	= $this->Brand_model->getCache();

		$page     = _get_page();
		$pagesize = 10;
		$arrParam = array();
		$arrWhere = array();
		if (!empty($search_goods_name))
		{
			$arrParam['search_goods_name'] = $search_goods_name;
		    $arrWhere['title like'] = "'%$search_goods_name%'";
		}
		if (!empty($search_commonid))
		{
			$arrParam['search_commonid'] = $search_commonid;
		    $arrWhere['tpl_id'] = $search_commonid;
		}
		if (!empty($search_state))
		{
			$arrParam['status'] = $search_state;
		    $arrWhere['status'] = $search_state;
		}
		if (!empty($b_id))
		{
			$arrParam['brand_id'] = $b_id;
		    $arrWhere['brand_id'] = $b_id;
		}
		if (!empty($search_store_name))
		{
			$arrParam['search_store_name'] = $search_store_name;

		    $this->load->model('Shop_model');
		    $where['name like'] = "%$search_store_name%";
		    $res = $this->Shop_model->get_list($where,$fields='id');
		    $id = array();
		    foreach ($res as $key => $value)
		    {
		        $id[] = $value['id'];
		    }
		    if ($id)
	        {
	            $arrWhere['shop_id'] = $id;
	        }
		}
		if($choose_cid){
			$arrParam['choose_cid'] = $choose_cid;
			$arrWhere['category_id'] = $choose_cid;
		}
		
		if($category_id_1)
		{
			$arrParam['category_id_1'] = $category_id_1;
			$arrWhere['category_id_1'] = $category_id_1;
		}
		if($category_id_2)
		{
			$arrParam['category_id_2'] = $category_id_2;
			$arrWhere['category_id_2'] = $category_id_2;
		}
		

		$arrWhere['status <>'] = -1;
		$goods_list = $this->Goods_tpl_model->fetch_page($page, $pagesize, $arrWhere,'*');
		
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/goods_tpl', $arrParam);
		$pagecfg['total_rows']   = $goods_list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		
		$this->pagination->initialize($pagecfg);
		$goods_list['pages'] = $this->pagination->create_links();
		
		$status = array(0=>'仓库中',1=>'出售中',2=>'仓库中',3=>'等待审核',4=>'违规下架');
		//$type_json = json_encode($category_list);

		$result = array(
		    'goods_list' 			=> $goods_list['rows'],
		    'brand_list' 			=> array(),//$brand_list,
		    //'category_list' 		=> $category_list,
		    'pages' 				=> $goods_list['pages'],
		    'status' 				=> $status,
		    //'type_json' 			=> $type_json,
			// 'search_goods_name'		=> $search_goods_name,
			// 'search_commonid'		=> $search_commonid,
			// 'search_store_name'		=> $search_store_name,
			// 'b_name'				=> $b_name,
			// 'b_id'					=> $b_id,
			// 'search_state'			=> $search_state,
			'arrParam'				=> $arrParam
		);

		$this->load->view('admin/goods_tpl/goods_tpl',$result);
	}

	/**
	 * 违规下架商品
	 */
	public function goods_lockup()
	{
	    //var_dump($_POST);exit;
	    $this->lang->load('admin_layout');
	    $this->lang->load('admin_goods');
	    
	    $b_id = $this->input->post('b_id' );
	    $search_store_name = $this->input->post('search_store_name' );
	    $search_goods_name = $this->input->post('search_goods_name' );
	    
	    //获取品牌列表
	    $this->load->model('Brand_model');
	   // $brand_list = $this->Brand_model->getCache();

	    $this->load->model('Category_model');
	    $category_list = $this->Category_model->getCache();
	    
	    $page     = _get_page();
	    $pagesize = 10;
	    $arrParam = array();
	    $arrWhere = array();
	    if (!empty($search_goods_name))
	    {
	        $arrWhere['title like'] = "'%$search_goods_name%'";
	    }
	    if (!empty($search_store_name))
	    {
	        $this->load->model('Shop_model');
	        $where['name like'] = "%$search_store_name%";
	        $res = $this->Shop_model->get_list($where,$fields='id');
	        $id = array();
	        foreach ($res as $key => $value)
	        {
	            $id[] = $value['id'];
	        }
	        if ($id)
	        {
	            $arrWhere['shop_id'] = $id;
	        }
	    }
	    if (!empty($b_id))
	    {
	        $arrWhere['brand_id'] = $b_id;
	    }
	    $arrWhere['status'] = 4;
	    
	    $goods_list = $this->Goods_tpl_model->fetch_page($page, $pagesize, $arrWhere,'*');
	    //分页
	    $pagecfg = array();
	    $pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/goods_lockup', $arrParam);
	    $pagecfg['total_rows']   = $goods_list['count'];
	    $pagecfg['cur_page'] = $page;
	    $pagecfg['per_page'] = $pagesize;
	    
	    $this->pagination->initialize($pagecfg);
	    $goods_list['pages'] = $this->pagination->create_links();
	    
	    
	    $result = array(
	        'goods_list' => $goods_list['rows'],
	        'brand_list' => array(),//$brand_list,
	        'category_list' => $category_list,
	        'pages' => $goods_list['pages'],
	    );
	    
	    $this->load->view('admin/goods_lockup',$result);
	}
	
	/**
	 * 违规商品下架
	 */
	public function lockup_save()
	{
		$this->load->service('sync_service');
	    $status = $this->input->get('status');
	    $bOnline = $status=='1'?true:false;
	    if ($this->input->get('id'))
	    {
	        $id = $this->input->get('id');
	        $data = array('status'=>$status);
	        $this->Goods_tpl_model->update_by_id($id,$data);
			$this->sync_service->tplOnOff($id, $bOnline);

	    }
	    if($this->input->post('id'))
	    {
	        $id = $this->input->post('id');
	        foreach ($id as $key => $value)
	        {
	        	$data = array('status'=>$status);
	            $this->Goods_tpl_model->update_by_id($value,$data);
	            $this->sync_service->tplOnOff($value,$bOnline);
	        }
	    }

	    redirect(ADMIN_SITE_URL.'/goods_tpl');
	}


	/**
	 * 等待审核页面
	 */
	/*public function goods_waitverify()
	{
// 	    var_dump($_POST);exit;
	    $this->lang->load('admin_layout');
	    $this->lang->load('admin_goods');
	    
	    $search_goods_name = $this->input->post('search_goods_name' );
		$search_store_name = $this->input->post('search_store_name' );
		$b_id = $this->input->post('b_id' );
		$search_verify = $this->input->post('search_verify' );

	    //获取品牌列表
	    $this->load->model('Brand_model');
	    $brand_list = $this->Brand_model->getCache();
	     
	    $this->load->model('Category_model');
	    $category_list = $this->Category_model->getCache();
	     
	    $page     = _get_page();
	    $pagesize = 10;
	    $arrParam = array();
	    $arrWhere = array();
	    if (!empty($search_goods_name))
	    {
	        $arrWhere['title like'] = "'%$search_goods_name%'";
	    }
	    if (!empty($search_verify))
	    {
	        $arrWhere['status'] = $search_verify;
	    }
	    else
	    {
	        $arrWhere['status'] =array(3,4);
	    }
	    if (!empty($b_id))
	    {
	        $arrWhere['brand_id'] = $b_id;
	    }
	    if (!empty($search_store_name))
	    {
	        $this->load->model('Shop_model');
	        $where['name like'] = "%$search_store_name%";
	        $res = $this->Shop_model->get_list($where,$fields='id');
	        $id = array();
	        foreach ($res as $key => $value)
	        {
	            $id[] = $value['id'];
	        }
	        if ($id)
	        {
	            $arrWhere['shop_id'] = $id;
	        }
	    }
	     
	    
	    $goods_list = $this->Goods_tpl_model->fetch_page($page, $pagesize, $arrWhere,'*');
	    
	    $pagecfg = array();
	    $pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/goods/goods_waitverify', $arrParam);
	    $pagecfg['total_rows']   = $goods_list['count'];
	    $pagecfg['cur_page'] = $page;
	    $pagecfg['per_page'] = $pagesize;
	    
	    $this->pagination->initialize($pagecfg);
	    $goods_list['pages'] = $this->pagination->create_links();
	    
	    $result = array(
	        'goods_list' => $goods_list['rows'],
	        'brand_list' => $brand_list,
	        'category_list' => $category_list,
	        'pages' => $goods_list['pages'],
	    );
	     
	    $this->load->view('admin/goods_waitverify',$result);
	}*/
	
	/**
	 * 审核提交的商品
	 */
	/*public function verify()
	{
	    if ($this->input->get('id'))
	    {
	        $id = $this->input->get('id');
	    }
	    $data['status'] = 1;
	    $this->Goods_tpl_model->update_by_id($id,$data);
	    redirect(ADMIN_SITE_URL.'/goods/goods_waitverify');
	}*/
	
	/**
	 * 删除选定的违规商品
	 */
	public function del()
	{
	    $data['status'] = -1;
	    if ($this->input->get('id'))
	    {
	        $id = $this->input->get('id');
	        $this->Goods_tpl_model->update_by_id($id,$data);
	    }
	    if($this->input->post('id'))
	    {
	        $id = $this->input->post('id');
	        foreach ($id as $key => $value)
	        {
	            $this->Goods_tpl_model->update_by_id($value,$data);

	        }
	    }
	    redirect(ADMIN_SITE_URL.'/goods/goods_tpl');
	}
	
	/**
	 * 商品设置页面
	 */ 
	 /*public function goods_set()
	 {
	     $this->lang->load('admin_layout');
	     $this->lang->load('admin_goods');
	     
	     $this->load->model('Wordbook_model');
	     //如果有post数据，则修改表
	     if ($this->input->post())
	     {
	         $where['k'] = 'goods_verify';
	         $data['val'] = $this->input->post('goods_verify');
	         $this->Wordbook_model->update_by_where($where,$data);
	         redirect(ADMIN_SITE_URL.'/goods');
	     }
	     else 
	     {
	         $where['k'] = "'goods_verify'";
	         $goods_verify = $this->Wordbook_model->get_by_where($where);
	          
	         $result = array(
	             'goods_verify' => $goods_verify,
	         );
	         $this->load->view('admin/goods_set',$result);
	     }
	     
	 }*/
	 
	 /**
     * AJAX查询品牌
     */
    public function ajax_get_brand(){
        $this->load->model('Brand_model');
        $category_id = intval($this->input->get('category_id'));
        $initial = $this->input->get('letter');
        $keyword = $this->input->get('keyword');
        $type = $this->input->get('type');
        
        
        // 验证类型是否关联品牌
        if ($type == 'letter') {
            switch ($initial) {
                case 'all':
                    break;
                case '0-9':
                    $where = array();
                    $where['initial'] = array('0','1','2','3','4','5','6','7','8','9');
                    break;
                default:
                    $where = array();
                    $where['initial'] = $initial;
                    break;
            }
        } else {
            $where= "name like '%$keyword%' or initial like '%$keyword%'";
        }
        //$brand_list = $this->Brand_model->get_list($where);
        //echo $this->Brand_model->db->last_query();exit;
        //echo json_encode($brand_list);die();
    }

}
