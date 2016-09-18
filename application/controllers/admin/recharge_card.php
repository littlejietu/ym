<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recharge_card extends MY_Admin_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Recharge_card_model');
    }
    
	public function index()
	{
		
        $cKey = $this->input->post_get('sn');
        $cKeyy = $this->input->post_get('batch');
        $cKeyy1 = $this->input->post_get('status');
		
		$page     = _get_page();//翻页  接收前台的页码
		
		$pagesize = 10;
		$arrParam = array();
		$arrWhere = array();
	
        if($cKey)
		{
		   	$arrParam['sn'] = $cKey; //翻页搜索
		   	$arrWhere['sn like '] = "'%$cKey%'"; //搜索
		}
		 if($cKeyy)
		{
		   	$arrParam['batch'] = $cKeyy; //翻页搜索
		   	$arrWhere['batch like '] = "'%$cKeyy%'"; //搜索
		}
		if($cKeyy1)
		{
		   	$arrParam['status'] = $cKeyy1; //翻页搜索
		   	$arrWhere['status like '] = "'%$cKeyy1%'"; //搜索
		}
		
		$arrWhere['status <>'] = -1;
		$list = $this->Recharge_card_model->fetch_page($page, $pagesize, $arrWhere,'*');
		//print_r($list);
		//die;
		//echo $this->Recharge_card_model->db->last_query();  //打印
		//die;
		
		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/Recharge_card', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();
		
		//print_r($list);die;
		$result = array(
		    'list' => $list,
		
		    'arrParam' => $arrParam,
			);

		// print_r($arrParam); //打印数据
			//var_dump($list);die;
		$this->load->view('admin/recharge_card',$result);
	}
	

	
	
	public function add()
	{

		$this->lang->load('admin_layout');
		//输出添加时间然后结束
		//echo time();die;//
		//var_dump($id);
	    //$this->lang->load('admin_Recharge_card');//语言包
	    
	    //需要修改
	    $id	= $this->input->get('id');
	    $result = array();
	    $info = array();
		
		
		
	    $arrPlace = $this->Recharge_card_model->get_list();
	
	    if(!empty($id))
	    {
	        $info = $this->Recharge_card_model->get_by_id($id);
		//var_dump($info);die;

	        $place = $this->Recharge_card_model->get_by_id($info['id'],'');
	        //$info['title'] = $place['title'];
	    }
	
	    $result = array(
	        'info'=>$info,
	        'arrPlace'=>$arrPlace,
	    );

	   
	   	

	//var_dump($info);die;
	    $this->load->view('admin/Recharge_card_add', $result);
	}
	
	public function save()
	{
		//var_dump($this->input->post());die;
        $denomination = (float) $this->input->post('denomination');
        if ($denomination < 0.01) {
            showMessage('面额不能小于0.01', '', 'html', 'error');
            return;
        }
        if ($denomination > 1000) {
            showMessage('面额不能大于1000', '', 'html', 'error');
            return;
        }

        $snKeys = array();

        switch ($this->input->post('type')) {
        case '0':
            $total = (int) $this->input->post('total');
            if ($total < 1 || $total > 9999) {
                showMessage('总数只能是1~9999之间的整数', '', 'html', 'error');
                exit;
            }
            $prefix = (string) $this->input->post('prefix');
            if (!preg_match('/^[0-9a-zA-Z]{0,16}$/', $prefix)) {
                showMessage('前缀只能是16字之内字母数字的组合', '', 'html', 'error');
                exit;
            }
            while (count($snKeys) < $total) {
                $snKeys[$prefix . md5(uniqid(mt_rand(), true))] = null;
            }
            break;

        case '1':
            $f = $_FILES['_textfile'];
            if (!$f || $f['error'] != 0) {
                showMessage('文件上传失败', '', 'html', 'error');
                exit;
            }
            if (!is_uploaded_file($f['tmp_name'])) {
                showMessage('未找到已上传的文件', '', 'html', 'error');
                exit;
            }
            foreach (file($f['tmp_name']) as $sn) {
                $sn = trim($sn);
                if (preg_match('/^[0-9a-zA-Z]{1,50}$/', $sn))
                    $snKeys[$sn] = null;
            }
            break;

        case '2':
            foreach (explode("\n", (string) $this->input->post('manual')) as $sn) {
                $sn = trim($sn);
                if (preg_match('/^[0-9a-zA-Z]{1,50}$/', $sn))
                    $snKeys[$sn] = null;
            }
            break;

        default:
            showMessage('参数错误', '', 'html', 'error');
            exit;

        }
    	
         //var_dump($snKeys);exit;
        $totalKeys = count($snKeys);
        if ($totalKeys < 1 || $totalKeys > 9999) {
            showMessage('只能在一次操作中增加1~9999个充值卡号', '', 'html', 'error');
            exit;
        }

        if (empty($snKeys)) {
            showMessage('请输入至少一个合法的卡号', '', 'html', 'error');
            exit;
        }

        $snOccupied = 0;
        // chunk size = 50
        foreach (array_chunk(array_keys($snKeys), 50) as $snValues) {
            // foreach ($this->Recharge_card_model->getOccupiedRechargeCardSNsBySNs($snValues) as $sn) {
            //     $snOccupied++;
            //     unset($snKeys[$sn]);
            // }
        }

        if (empty($snKeys)) {
            showMessage('操作失败，所有新增的卡号都与已有的卡号冲突', '', 'html', 'error');
            exit;
        }

        $batchflag = $this->input->post('batchflag');
        $adminName = 'aa';
        $ts = time();
        //var_dump($_POST);
        
        // if ($this->input->post('type') ==0) {
        // 	$snToInsert = array();
	       //  foreach (array_keys($snKeys) as $sn) {
	       //      $snToInsert[] = array(
	       //          'sn' => $sn,
	       //          'denomination' => $denomination,
	       //          'batch' => $batchflag,
	       //          'admin_username' => $adminName,
	       //          'create_time' => $ts,
	       //          'status'=>1
	       //      );
	       //  }
	       //  for ($i=0; $i < $this->input->post('total'); $i++) { 
	       //  	$this->Recharge_card_model->insert($snToInsert[$i]);
	       //  }
        // }
        // elseif($this->input->post('type') ==2)
        // {
        // 	$snToInsert = array();
        // 	foreach (array_keys($snKeys) as $sn) {
	       //      $snToInsert[] = array(
	       //          'sn' => $sn,
	       //          'denomination' => $denomination,
	       //          'batch' => $batchflag,
	       //          'admin_username' => $adminName,
	       //          'create_time' => $ts,
	       //          'status'=>1
	       //      );
	       //  }
	       //  //print_r($snToInsert);exit;
	       //  for ($i=0; $i < count($snToInsert); $i++) { 
	       //  	$this->Recharge_card_model->insert($snToInsert[$i]);
	       //  }
        // }


        // elseif($this->input->post('type') ==1)
        // {
        	
        // }

			$snToInsert = array();
        	foreach (array_keys($snKeys) as $sn) {
	            $snToInsert[] = array(
	                'sn' => $sn,
	                'denomination' => $denomination,
	                'batch' => $batchflag,
	                'admin_username' => $adminName,
	                'create_time' => $ts,
	                'status'=>1
	            );
	        }
	        //print_r($snToInsert);exit;
	        for ($i=0; $i < count($snToInsert); $i++) { 
	        	$this->Recharge_card_model->insert($snToInsert[$i]);
	        }

         

        //var_dump($snToInsert);exit;
        // if (!$this->Recharge_card_model->insert($snToInsert)) {
        //     showMessage('操作失败', '', 'html', 'error');
        //     exit;
        // }

        $countInsert = count($snToInsert);
        //$this->log("新增{$countInsert}张充值卡（面额￥{$denomination}，批次标识“{$batchflag}”）");

        $msg = '操作成功';
        if ($snOccupied > 0)
            $msg .= "有 {$snOccupied} 个卡号与已有的未使用卡号冲突";

        //showMessage($msg, ADMIN_SITE_URL.'/recharge_card');

        redirect(ADMIN_SITE_URL.'/recharge_card');
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
	    		$this->Recharge_card_model->update_by_id($v,$data);
			}
			
	    }
	    else
	    {
	        $id	= $this->input->get('id');
			$page = _get_page();
			$data['status'] = -1;
		// 调用修改状态方法
	    	$this->Recharge_card_model->update_by_id($id,$data);

	    }
	    
	    redirect( ADMIN_SITE_URL.'/recharge_card' );
		
	
	}

	
	
}
?>