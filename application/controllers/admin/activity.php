<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends MY_Admin_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Goods_tpl_model');
		$this->load->model('goods_model');
		$this->load->model('discount_goods_model');
		$this->load->model('Discount_activity_model');
		$this->load->service('buying_service');
	}

	public function getPrice(){
		output_data($this->buying_service->getrealPriceInActivity(887));
	}

	public function getTplPrice(){

	}

	public function index()
	{


		$page     = _get_page();
		$pagesize = 10;
		$where = array(
			'status' => 1,
		);
		$activity  = $this->Discount_activity_model->fetch_page($page,$pagesize,$where);
//		$count =  $this->Discount_activity_model->count($where);
		$data = array(
			'page' =>$page,
			'pagesize' =>$pagesize,
			'total' =>$activity['count'],
			'data' =>$activity
		);

		//var_dump($_POST);exit;

		$this->load->view('admin/activity/activitylist',$data);
	}
	/*
	*
	* 	当前活动参加的物品
	* */
//	public function goods_list(){
//		$id = $this->input->get_post('activity_id');
//		$search_goods_name = $this->input->post('search_goods_name' );
//		if (!empty($search_goods_name))
//		{
//			$arrWhere['title like'] = "'%$search_goods_name%'";
//		}
//		$page     = _get_page();
//		$pagesize = 10;
//		$arrParam = array('activity_id' => $id,
//			'title' =>$this->input->get_post('title'));
//		$time = time();
//		$whereArr = array(
//			'status' =>1,
//			'activity_id' => $id,
//			"start_time <=" =>$time,
//			"from_sale >" =>$time,
//		);
//		$disgoods = $this->discount_goods_model->fetch_page($page,$pagesize,$whereArr);
//		$goodslist = array();
//		foreach($disgoods['rows'] as $key => $value) {
//			$goods = $this->Goods_tpl_model->get_by_where(array('tpl_id'=> $value['goods_id']));
//			if(empty($goods)){
////				unset($disgoods[$key]);
//				continue;
//			}
//			array_push($goodslist,$goods);
//
//		}
//
//		$pagecfg = array();
//		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/activity/getGoodsList', $arrParam);
//		$pagecfg['total_rows']   = 0;//$goods_list['count'];
//		$pagecfg['cur_page'] = $page;
//		$pagecfg['per_page'] = $pagesize;
//
//		$this->load->model('Goods_num_model');
//		$goods_num = $this->Goods_num_model->getList();
//		//获取品牌列表
//		$this->load->model('Brand_model');
//		$brand_list = $this->Brand_model->getCache();
//
//		$this->load->model('Category_model');
//		$category_list = $this->Category_model->getCache();
//		$pages =$this->pagination->initialize($pagecfg);
//		$result = array(
//			'goods_list' => $goodslist,
//			'goods_num' => $goods_num,
//			'brand_list' => $brand_list,
//			'category_list' => $category_list,
////			'status' 			=> $status,
//			'search_goods_name'	=> $search_goods_name,
//			'pages' =>$this->pagination->create_links(),
//			'activity_id' => $id,
//			'title' =>$this->input->get_post('title')
//		);
//		$this->load->view('admin/activity/curgoods',$result);
//	}

	public function getGoodsList(){
		$this->lang->load('admin_layout');
		$this->lang->load('admin_goods');
		$search_goods_name = $this->input->post_get('search_goods_name' );
		$search_commonid = $this->input->post_get('search_commonid' );
		$activity_status =  $this->input->post_get('activity_status' );
		if(empty($activity_status)){
			$activity_status = 2;
		}
//		$search_store_name = $this->input->post('search_store_name' );
//		$b_name = $this->input->post('b_name' );
//		$b_id = $this->input->post('b_id' );
//		$search_state = $this->input->post('search_state' );
		//获取库存信息
		$this->load->model('Goods_num_model');
		$goods_num = $this->Goods_num_model->getList();
		//获取品牌列表
		$this->load->model('Brand_model');
		$brand_list = $this->Brand_model->getCache();

		$this->load->model('Category_model');
//		$category_list = $this->Category_model->getCache();
		$acid = $this->input->post_get('id');
		$page     = $this->input->post_get('page');
		if(!$page){
			$page = 1;
		}
		$pagesize = 10;
		$arrParam = array(
			'id' => $acid,
			'title' =>$this->input->get_post('title'),
			'activity_status' => $activity_status,
			'search_commonid' => $search_commonid,
			'search_goods_name' => $search_goods_name,
		);
		$arrWhere = array();
		if (!empty($search_goods_name))
		{
			$arrWhere['title like'] = "'%$search_goods_name%'";
		}
		if (!empty($search_commonid))
		{
			$arrWhere['tpl_id like'] = "'%$search_commonid'";
		}
//		if (!empty($search_state))
//		{
//			$arrWhere['status'] = $search_state;
//		}
//		if (!empty($b_id))
//		{
//			$arrWhere['brand_id'] = $b_id;
//		}
//		if (!empty($search_store_name))
//		{
//			$this->load->model('Shop_model');
//			$where['name like'] = "%$search_store_name%";
//			$res = $this->Shop_model->get_list($where,$fields='id');
//			$id = array();
//			foreach ($res as $key => $value)
//			{
//				$id[] = $value['id'];
//			}
//			if ($id)
//			{
//				$arrWhere['shop_id'] = $id;
//			}
//		}

		$dbprefix = $this->Goods_tpl_model->prefix();

		$goods_list = null;
		if($activity_status == 1){
//			$arrWhere['a.status'] = 1;
//			$tb = $dbprefix.'goods_tpl a inner join '.$dbprefix.'discount_goods b on(a.tpl_id=b.goods_id and b.activity_id='.$acid.' and b.status =1)';
//			$goods_list = $this->Goods_tpl_model->fetch_page($page, $pagesize, $arrWhere,'*','a.tpl_id desc',$tb);
			$arrWhere['status'] = 1;
			$arrWhere['tpl_id in '] = '(select goods_id from x_discount_goods where status=1 and activity_id = '.$acid.')';
			$goods_list = $this->Goods_tpl_model->fetch_page($page, $pagesize, $arrWhere);

		}else if($activity_status == 2){
			$arrWhere['status'] = 1;
			$arrWhere['tpl_id not in '] = '(select goods_id from x_discount_goods where status=1)';
//			$tb = $dbprefix.'goods_tpl a inner join '.$dbprefix.'discount_goods b on((a.tpl_id != b.goods_id and b.status = 1) or (a.tpl_id = b.goods_id and b.status = 2))';
//			$spl = tpl_id not in(select goods_id from x_discount_goods where status=1) AND status = 1';

			$goods_list = $this->Goods_tpl_model->fetch_page($page, $pagesize, $arrWhere);


		}else{
			$arrWhere['status'] = 1;
			$goods_list = $this->Goods_tpl_model->fetch_page($page, $pagesize, $arrWhere,'*');
		}

		foreach($goods_list['rows'] as $key => $vlaue ){
			$time = time();
			$arr = array(
				'goods_id' =>$goods_list['rows'][$key]['tpl_id'],
				'status' =>1,
//				"start_time <=" =>$time,
//				"from_sale >" =>$time,
			);
			$go = $this->discount_goods_model->get_by_where($arr);
			$goods_list['rows'][$key]['total_num'] = 0;
			$goods_list['rows'][$key]['saled_num'] = 0;
			if(empty($go)){
				$goods_list['rows'][$key]['activity_id'] = 0;
			}else{
				$goods_list['rows'][$key]['total_num'] = $go['total'];
				$goods_list['rows'][$key]['saled_num'] = $go['saled'];
				if($time  > intval($go['from_sale'])){
					$goods_list['rows'][$key]['activity_id'] =-1;
				}else{
					$goods_list['rows'][$key]['activity_id'] =$go['activity_id'];//活动中

				}
			}
		}

		$pagecfg = array();
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/activity/getGoodsList', $arrParam);
		$pagecfg['total_rows']   = $goods_list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;

		$this->pagination->initialize($pagecfg);

		$status = array(1=>'出售中',2=>'仓库中',3=>'等待审核',4=>'违规下架');
//		$type_json = json_encode($category_list);

		$result = array(
			'goods_list' => $goods_list['rows'],
			'goods_num' => $goods_num,
			'brand_list' => $brand_list,
//			'category_list' => $category_list,
			'pages' => $this->pagination->create_links(),
			'status' 			=> $status,
//			'type_json'			 => $type_json,
			'search_goods_name'	=> $search_goods_name,
			'search_commonid'	=> $search_commonid,
			'activity_id' => $acid,
			'title' =>$this->input->get_post('title'),
			'activity_status' =>$activity_status
		);
		$this->load->view('admin/activity/addgoods',$result);
	}

	public function getActivityList(){

		$page     = _get_page();
		$pagesize = 10;
		$where = array(
			'status' => 1,
		);
		$activity  = $this->Discount_activity_model->fetch_page($page,$pagesize,$where);
		$count =  $this->Discount_activity_model->count($where);
		$data = array(
			'page' =>$page,
			'pagesize' =>$pagesize,
			'total' =>$count,
			'data' =>$activity,
		);
		output_data($data);

	}

	public function addGoodsToActivity(){
		$goods_id = $this->input->post_get('goods_id');
		$acid = $this->input->post_get('activity_id');
		$this->Discount_activity_model->get_by_id($acid);
		$activity_goods_id = $this->input->get_post('activity_goods_id');
//		$goodslst = $this->discount_goods_model->get_list(array('goods_id' => $goods_id,'status' =>1));
//		if(!empty($goodslst)){
//			output_error(-4,"该物品已经在活动中了");
//		}
		$whereArr = array(
			'id' => $acid,
			'status <>' => -1
		);
		$act = $this->Discount_activity_model->get_by_where($whereArr);
		if(empty($act)){
			output_error(-5,"没有这个活动");
		}

		$goods = $this->Goods_tpl_model->get_by_id($goods_id);
		if(!$goods){
			output_error(-6,"没有这个商品");
		}

		$config = array(
//			array(
//				'field'=>'price',
//				'label'=>'price',
//				'rules'=>'greater_than[0]|required',
//			),
			array(
				'field'=>'total',
				'label'=>'total',
				'rules'=>'greater_than[0]|required',
			),
			array(
				'field'=>'start_time',
				'label'=>'start_time',
				'rules'=>'trim|required',
			),
			array(
				'field'=>'from_sale',
				'label'=>'from_sale',
				'rules'=>'trim|required',
			),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() === TRUE){
			$start = strtotime($this->input->post_get('start_time').' 0:0:0');
			$end  = strtotime($this->input->post_get('from_sale').' 0:0:0');
			if($start > $end){
				output_error(-2,'下架时间不能小于上架时间');
			}
			$goodslst = $this->discount_goods_model->get_by_where(array('goods_id' => $goods_id,'status' =>1));
			if($goodslst){
				$goodobj = array(
//					'price' => $this->input->post_get('price'),
					'total' => $this->input->post_get('total'),
					'from_sale' =>$end,
					'start_time' =>$start,
				);
				$dat = $this->discount_goods_model->update_by_id($goodslst['id'],$goodobj);
			}else{
				$goodobj = array(
					'goods_id' => $goods_id,
					'category_id_1' => $this->input->post_get('category_id_1'),
					'activity_id' =>$acid,
//					'price' => $this->input->post_get('price'),
					'total' => $this->input->post_get('total'),
					'limit' => -1,
					'status' =>1,
					'add_time' =>time(),
					'from_sale' =>$end,
					'start_time' =>$start,
				);
				$dat = $this->discount_goods_model->insert_string($goodobj);
			}

			if($dat){
				if($activity_goods_id){
					output_data(1);
				}else{
					output_data(2);
				}

			}else{
				output_error(-3,'未知错误');
			}
		}else{
			output_error(-5,'数据提交出错');
		}



	}

	public function editActivity(){
		$acid = $this->input->post_get('id');
		$whereArr = array(
			'id' => $acid,
			'status <>' => -1
		);
		$act = $this->Discount_activity_model->get_by_where($whereArr);
		if(empty($act)){
			output_error(-2,"没有这个活动");
		}
		$config = array(
//			array(
//				'field'=>'discount',
//				'label'=>'discount',
//				'rules'=>'greater_than[0]|required',
//			),
			array(
				'field'=>'start_time',
				'label'=>'start_time',
				'rules'=>'integer|required|less_than[25]|greater_than[-1]',
			),
			array(
				'field'=>'end_time',
				'label'=>'end_time',
				'rules'=>'integer|greater_than[-1]|less_than[25]',
			),
			array(
				'field'=>'desc',
				'label'=>'desc',
				'rules'=>'trim|required',
			),
		);
		$acobj = array(
			'desc' => $this->input->post_get('desc'),
//			'discount' =>$this->input->post_get('discount'),
			'start_time' => $this->input->post_get('start_time'),
			'start_time' => $this->input->post_get('start_time'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() === TRUE){
			$act = $this->Discount_activity_model->update_by_id($acid,$acobj);
			if($act){
				output_data($act);
			}else{
				output_error(-3,'未知错误');
			}
		}else{
			output_error(-5,'数据提交出错');
		}
	}



	public function getGoods(){
		$goods_id = $this->input->post_get('goods_id');
		$goods = $this->discount_goods_model->get_by_where(array('goods_id' =>$goods_id));
		if(empty($goods)){
			output_error(-1,'活动中没有这个商品');
		}
		$goods['start_time'] = date('Y-m-d',$goods['start_time']);
		$goods['from_sale'] = date('Y-m-d',$goods['from_sale']);
		output_data($goods);
	}

	public function getGoodsInActivity(){
		$goods_id = $this->input->post_get('goods_id');
		$goods = $this->discount_goods_model->get_by_id($goods_id);
		if(empty($goods)){
			output_error(-1,'活动中没有这个商品');
		}
		$goods_detail = $this->goods_tpl_model->get_by_id($goods_id);
		if(empty($goods_detail)){
			output_error(-1,'没有这个商品');
		}
		$goods['title'] = $goods_detail['title'];

		output_data($goods);
	}

	public function deleteGoods(){
		$goods_id = $this->input->get_post('goods_id');
		$where = array(
			'goods_id' =>$goods_id,
			'status' =>1,
		);
		$goods = $this->discount_goods_model->get_by_where($where);
		if(empty($goods)){
			output_error(-1,'活动中没有这个商品');
		}
		$res = $this->discount_goods_model->update_by_id($goods['id'],array('status' =>2));
		if($res){
			output_data($res);
		}else{
			output_error(-2,'删除失败');
		}
	}

}
