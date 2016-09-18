<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends MY_Admin_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Comment_goods_model');
        $this->load->service('goodsnum_service');
    }
    
	public function index()
	{
		$this->lang->load('admin_comment');//无法加载语言包就去掉着一句
		$this->lang->load('admin_layout');
		$ad_place = $this->input->post_get('ad_place');
		$this->load->model('Goods_model');
		$this->load->model('Shop_model');
		$this->load->model('User_model');
		$addtime = $this->input->post_get('addtime');
		$etime = $this->input->post_get('etime');
		
		$cKey = $this->input->post_get('txtKey');
		//$txtUserName = $this->input->post_get('txtUserName');
		$cKey1 = $this->input->post_get('txtKeyy');
		//$cUser = $this->input->post_get('txtUser');
		
		$page     = _get_page();//接收前台的页码
		
		$pagesize = 10;
		$arrParam = array();
		$arrWhere = array();

		if($cKey)
		{
		    $arrParam['txtKey'] = $cKey;

		    $this->load->model('Goods_model');
		    $res = $this->Goods_model->get_list(array('title like'=>"%$cKey%"),$fields='id');
		    $id = array();
		    foreach ($res as $key => $value)
		    {
		        $id[] = $value['id'];
		    }
		    if ($id)
	            $arrWhere['goods_id'] = $id;
		}

		if($addtime)
		{
		    $arrWhere['addtime >= "'] = strtotime($addtime).'"';
		    $arrParam['addtime'] = $addtime;
		}
		if($etime)
		{
		    $arrWhere['addtime <="'] = strtotime($etime)+122400 .'"';
		    $arrParam['etime'] = $etime;
		}

		$strOrder = 'addtime desc';
		$arrWhere['status <>'] = -1;
		//echo $this->Comment_goods_model->db->last_query();die;
		$list = $this->Comment_goods_model->fetch_page($page, $pagesize, $arrWhere,'*',$strOrder);
		//echo $this->Comment_goods_model->db->last_query();die;
		foreach ($list['rows'] as $key => $a) {
    		$aItem = $list['rows'][$key];
    		//评论用户信息
    		$aUser = $this->User_model->get_by_id($a['buyer_id'],'user_name');
    		if(empty($aUser))
    			$aUser = array();

    		//商品信息
    		$aGoods = $this->Goods_model->get_by_id($a['goods_id'],'id as goods_id,shop_id,title');

    		if(!empty($aGoods))
    		{
    			$aItem = array_merge($aGoods, $aUser, $aItem);
    			$aShop = $this->Shop_model->get_by_id($aGoods['shop_id'],'name as shop_name');
    			if(!empty($aShop))
    				$aItem = array_merge($aShop, $aItem);

    			$list['rows'][$key] = $aItem;
    		}
    		// else
    		// 	unset($list['rows'][$key]);

    	}
		//echo $this->Comment_goods_model->db->last_query();die;
		//print_r($list);die;
		//var_dump($page, $pagesize);die;
		//echo $this->Comment_goods_model->db->last_query();die;
		//$this->load->model('Link_Place_Model');
		//$ad_placeList = $this->Link_Place_Model->get_list();
		
		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/Comment', $arrParam);
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
		$this->load->view('admin/comment',$result);
		//echo $this->Comment_goods_model->db->last_query();die;
	}
	

	
	/*public function save()
	{		
	
		//var_dump();die;
			//echo time();die;//
	    //$this->lang->load('admin_Comment');
		
		
		//输出所有post提交的表单内元素
	//var_dump($_POST);//exit;
	    if ($this->input->is_post())
	    {
	        
	   // echo time();
	  // print_r();
	        $this->form_validation->set_rules($config);
	    
	        if ($this->form_validation->run() === TRUE)
	        {
	            $id = (int)$this->input->post('id');
				echo $id;
	            $adcode = '';
	            $this->load->model('Comment_goods_model');
	            //$oPlace = $this->Link_Place_model->get_by_id($id);
	            if($oPlace)
	                $adcode = $oPlace['adcode'];
	            //将需要保存的数据赋值给数组$data
	            $data = array(
	                'order_id'=>$this->input->post('order_id'),
	                'buyer_id'=>$this->input->post('buyer_id'),
	                'goods_id'=>$this->input->post('goods_id'),
	                'sku_id'=>$this->input->post('sku_id'),
	                'comment'=>$this->input->post('comment'),
	                'push_comment'=>$this->input->post('push_comment'),
	                'reply_comment'=>$this->input->post('reply_comment'),
	                'pic_path'=>$this->input->post('pic_path'),
	                'score_level'=>$this->input->post('score_level'),
	                'addtime'=>time(),
	                'status'=>1,
	            );
	    
	            $id	= $this->input->post('id');
	            if($id)
	                $data['id'] = $id;
//接收图片必须用这个，数据库里才会有图片名字					
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
	            $this->Comment_goods_model->insert($data);
				
			
	            //echo '成功,<a href="/admin/aa">返回列表页</a>';
				
				//echo base_url('/admin/link');die;
	            redirect(ADMIN_SITE_URL.'/Comment');
	            exit;
	        }
	       
	    }
	}*/
	
	
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
	    		$this->Comment_goods_model->update_by_id($v,$data);
			}
			
	    }
	    else
	    {
	        $id	= $this->input->get('id');
			$page = _get_page();
			$data['status'] = -1;
		// 调用修改状态方法
		    $comment = $this->Comment_goods_model->get_by_id($id);
	    	$this->Comment_goods_model->update_by_id($id,$data);
	    	$this->goodsnum_service->onComment($comment['goods_id'],$comment['buyer_id'],$comment['score_level'],empty($comment['pic_path']?'0':'1'));
	    }
	    showMessage('删除成功');
	    redirect( ADMIN_SITE_URL.'/Comment' );
		
	
	}
}
?>