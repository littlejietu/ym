<?php
/**
 * 商品模块下的商品管理
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Goods_audit extends MY_Admin_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Goods_tpl_model');
        $this->load->model('Goods_model');
    }
    
	/**
	 * 商品管理首页：价格待审列表
	 */
	public function index()
	{
		$this->lang->load('admin_layout');
		$this->lang->load('admin_goods');
		$this->load->helper('Goods');
		
		//var_dump($_POST);exit;
		$search_goods_name 	= $this->input->post_get('search_goods_name' );
		$search_commonid 	= $this->input->post_get('search_commonid' );
		$search_store_name 	= $this->input->post_get('search_store_name' );
		$b_name	 			= $this->input->post_get('b_name');
		$b_id 				= $this->input->post_get('b_id' );
		$search_state 		= $this->input->post_get('search_state' );
		$choose_cid 		= $this->input->post_get('choose_cid');
		$category_id_1 = $this->input->post_get('category_id_1');
		$category_id_2 = $this->input->post_get('category_id_2');
		
		$this->load->model('Brand_model');
		$this->load->model('Category_model');
		$this->load->model('Shop_model');
		$this->load->model('Goods_sku_model');

		//获取品牌列表
		//$brand_list = $this->Brand_model->getCache();
		$category_list = $this->Category_model->getCache();

		$page     = _get_page();
		$pagesize = 10;
		$arrParam = array();
		$arrWhere = array('status <>'=>-1, '(audit_price >0 or audit_cost_price>0)='=>1);
		if (!empty($search_goods_name))
		{
			$arrParam['search_goods_name'] = $search_goods_name;
		    $arrWhere['title like'] = "'%$search_goods_name%'";
		}
		if (!empty($search_commonid))
		{
			$arrParam['search_commonid'] = $search_commonid;
		    $arrWhere['id'] = $search_commonid;
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

		$dbprefix = $this->Goods_model->prefix();
        $tb = $dbprefix.'goods a inner join '.$dbprefix.'goods_num b on(a.id=b.goods_id)';
    	//$aList = $this->Message_receiver_model->fetch_page($page, $pagesize, $arrWhere,'*','addtime desc',$tb);
		$goods_list = $this->Goods_model->fetch_page($page, $pagesize, $arrWhere,'*','a.id desc',$tb);
		//echo $this->Goods_model->db->last_query();die;
		foreach ($goods_list['rows'] as $key => $a) {
			$goods_list['rows'][$key]['sku'] = $this->Goods_sku_model->get_list(array('goods_id'=>$a['id']));
		}
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/goods', $arrParam);
		$pagecfg['total_rows']   = $goods_list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		
		$this->pagination->initialize($pagecfg);
		$goods_list['pages'] = $this->pagination->create_links();
		
		$status = array(1=>'出售中',2=>'仓库中',3=>'等待审核',4=>'违规下架');
		$type_json = json_encode($category_list);
		$result = array(
		    'goods_list' => $goods_list['rows'],
		    'brand_list' =>array(), //$brand_list,
		    'category_list' => $category_list,
		    'pages' => $goods_list['pages'],
		    'status' => $status,
		    'arrParam'				=> $arrParam
		);
		$this->load->view('admin/goods_audit',$result);
	}

	public function save(){
		$arrAudit = $this->input->post('audit');

		$this->load->model('Goods_sku_model');

		foreach ($arrAudit as $a) {
			$sku_id_default = 0;
			$goods_id = $a['id'];
			if(!empty($a['price'])){
				$this->Goods_model->update_by_id($goods_id, array('price'=>$a['price'],'audit_price'=>0));
			}
			if(!empty($a['sku_price'])){
				$price_min = 0;
				
				$market_price_default = 0;
				foreach ($a['sku_price'] as $sku_id => $vv) {
					$this->Goods_sku_model->update_by_where(array('id'=>$sku_id), array('price'=>$vv,'audit_price'=>0));
					if(empty($price_min)){
						$price_min = $vv;
						$sku_id_default = $sku_id;
					}
					else if($vv<$price_min){
						$price_min = $vv;
						$sku_id_default = $sku_id;
					}

				}

				if(!empty($price_min)){
					$aSku_default = $this->Goods_sku_model->get_by_where(array('id'=>$sku_id_default));
					$this->Goods_model->update_by_id($goods_id, array('price'=>$price_min, 'market_price'=>$aSku_default['market_price'],'sku_id'=>$sku_id_default,'audit_price'=>0));
				}
			}

			if(!empty($a['cost_price'])){
				$this->Goods_model->update_by_id($goods_id, array('cost_price'=>$a['cost_price'],'audit_cost_price'=>0));
			}
			if(!empty($a['sku_cost_price'])){

				foreach ($a['sku_cost_price'] as $sku_id => $vv) {
					$this->Goods_sku_model->update_by_where(array('id'=>$sku_id), array('cost_price'=>$vv,'audit_cost_price'=>0));
				}

				if(!empty($sku_id_default)){
					$aSku_default = $this->Goods_sku_model->get_by_where(array('id'=>$sku_id_default));
					$this->Goods_model->update_by_id($goods_id, array('cost_price'=>$aSku_default['cost_price'],'audit_cost_price'=>0));
				}
			}
		}

		redirect(ADMIN_SITE_URL.'/goods_audit');

	}
	

}
