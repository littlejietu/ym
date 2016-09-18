<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends MY_Admin_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Message_Def_model');
    }
	
    //默认执行index
	public function index()
	{
	    $this->lang->load('admin_message');
	    
		$type_id = $this->input->post_get('type_id');
		$field = $this->input->post_get('field');
		$cKey = $this->input->post_get('txtKey');
		$fieldDate = $this->input->post_get('fieldDate');
		$orderby = $this->input->post_get('orderby');

		if ($field == 'message_ti_tle')
		{
		    $field = 'message_title';
		}
		$page     = _get_page();
		$pagesize = 10;
		$arrParam = array();
		$arrWhere = array();

		if($type_id)
		{
		    $arrWhere['type_id'] = $type_id;
			$arrParam['type_id'] = $type_id;
		}
		
		if($cKey)
		{
			$arrParam['key'] = $cKey;
			if($field=='touserid')
				$arrWhere[$field] = $cKey;
			else
				$arrWhere[$field.' like '] = "'%$cKey%'";
		}
		$arrParam['field'] = $field;
		$arrParam['fieldDate'] = $fieldDate;
		
		$strOrder = 'id desc';
		if($orderby)
		{
			$arrParam['orderby'] = $orderby;
			$strOrder = $orderby;
		} 
		$arrWhere['status <>'] =-1;
		$list = $this->Message_Def_model->fetch_page($page, $pagesize, $arrWhere, '*', $strOrder);
		//echo $this->db->last_query();die;  //打印数据库
		$this->load->model('Message_Type_model');
		$msg_type = $this->Message_Type_model->get_list();
		$type_list = array();
		foreach ($msg_type as $key => $value)
		{
		    $type_list[$value['id']] = $value['name'];
		}
		foreach ($list['rows'] as $key => $value)
		{
		    if ($list['rows'][$key]['type_id'] != 0)
		    {
		    $list['rows'][$key]['type_name'] = $type_list[$value['type_id']];
		    }
		}
		//分页
		$pagecfg = array();
		$pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/message', $arrParam);
		$pagecfg['total_rows']   = $list['count'];
		$pagecfg['cur_page'] = $page;
		$pagecfg['per_page'] = $pagesize;
		//$this->load->library('pagination');
		$this->pagination->initialize($pagecfg);
		$list['pages'] = $this->pagination->create_links();
		$result = array(
			'list' => $list,
			'arrParam' => $arrParam,
		    'type_list' =>$type_list,

			);
		$this->load->view('admin/message',$result);
	}
	
	
	public function add()
	{
	     
	    $this->lang->load('admin_message');
		$touserid = 0;
		$result = array(); //变量
		$info = array();
		$type = array();
		if ($id = $this->input->get('id'))
		{
		    
		}
				
		$this->load->model('Message_Type_model');
		$msg_type = $this->Message_Type_model->get_list();
		$type_list = array();
		foreach ($msg_type as $key => $value)
		{
		    $type_list[$value['id']] = $value['name'];
		}
		$info = $this->Message_Def_model->get_by_id($id);
		
		if(!empty($info))
		{
			if( $info['type_id'] != 0){
			    $info['type_name'] = $type_list[$info['type_id']];
			}
		}
		$result = array(
		    'type' =>$msg_type,
			'info'=>$info,
			);
		$this->load->view('admin/message_def_add', $result);
	}

	
	public function send(){
		$this->lang->load('admin_layout');
		$this->lang->load('admin_message_notice');

		$user_name = $this->input->post_get('user_name');

		$data = array(

			'user_name' => $user_name,
		);

		$this->load->view('admin/message_add',$data);
		//echo '1111111';die;
	}
 		
	public function send_save(){

		if ($this->input->is_post())
	    {
	        $config = array(
	               
	                array(
	                    'field'   => 'content1',
	                    'label'   => '通知内容',
	                    'rules'   => 'trim|required'
	                ),
	                array(
	                    'field'   => 'title',
	                    'label'   => '消息标题',
	                    'rules'   => 'trim|required'
	                ),
	                
	        );
	        $this->form_validation->set_rules($config);
	        //验证通过
	        if ($this->form_validation->run() === TRUE)
	        {

	            $this->load->model('Message_model');
	            //如果是指定会员
	            if($this->input->post('send_type')==1){
	            	//指定会员
	            	$tmp_user_name = $this->input->post('user_name');
	            	$arrUserName = explode("\r\n", $tmp_user_name);
	            	//取用户表中取用户id
	            	$this->load->model('User_model');
	            	$arrUserId_tmp = $this->User_model->get_list(array('user_name'=>$arrUserName),'user_id');
	            	//echo $this->User_model->db->last_query();die;
	            	$arrUserId = array();
	          		if(!empty($arrUserId_tmp))
	          		{
	          			foreach ($arrUserId_tmp as $key => $a) {
	          				$arrUserId[] = $a['user_id'];
	          			}
	          		}
	          		//接收者
	          		$receiver = implode(',', $arrUserId);
				//print_r($receiver); die;
	            	//标题
	            	//$this->input->post('title')
	            	//内容
	            	//$this->input->post('content1')

	            }//如果是全部会员
	            else if($this->input->post('send_type')==2){
	            	$tmp_user_name = $this->input->post('title');
	            	$receiver = 'all';
	            	
	            }

	            		//将需要保存的数据赋值给数组$data
		        	$data = array(
		                'sender_id'=>0,
		                'parent_id'=>0,
		                'tpl_id'=>0,
		                'title'=>$this->input->post('title'),
		                'content'=>$this->input->post('content1'),
		                'receiver'=>$receiver,
		                'send_time'=>time(),
		                'reply_time'=>0,
		                'kind'=>1,
		                'is_batch'=>1,
		                'is_send'=>0,
		                'receiver_type'=>4,
		                'type_id'=>$this->input->post('type'),
		                'action_title'=>$this->input->post('action_title'),
		                'web_url'=>$this->input->post('web_url'),
		                'app_url'=>$this->input->post('app_url'),
		                'is_push'=>$this->input->post('is_push'),
		                'status'=>1,
		            );
		            // echo $this->input->post('title');
		            // echo $this->input->post('content1');
		            // die;
		    		
		            $id	= $this->input->post('id');
		            if($id)
		            {
		                $this->Message_model->update_by_id($id,$data);
		            }
		            else
		            {
		            	//保存至数据库
		            	$this->Message_model->insert_string($data);
		            	//echo $this->Message_model->db->last_query();die;  这条是打印放到数据库执行之后的数据
		            }
             
	        }
	        

	        $gotoUrl = ADMIN_SITE_URL.'/message/send';
	        $msg = '';
	        if (empty($id))
	        	$msg = '操作成功，等待推送中';
	        else
	        	$msg = '操作失败';
	        
	        showDialog($msg, $gotoUrl);
			
	    }//-is_post()
	}

	/**///public function tmp_send()
	
	public function save()
	{
	    if ($this->input->is_post())
	    {
	        $config = array(
	                array(
	                    'field'   => 'message_title',
	                    'label'   => '模板名称',
	                    'rules'   => 'trim|required'
	                ),
	                array(
	                    'field'   => 'message_switch',
	                    'label'   => '站内信开关',
	                    'rules'   => 'trim|required'
	                ),
	                array(
	                    'field'   => 'sms_switch',
	                    'label'   => '短信开关',
	                    'rules'   => 'trim|required'
	                ),
	                array(
	                    'field'   => 'email_switch',
	                    'label'   => '邮件开关',
	                    'rules'   => 'trim|required'
	                ),
	        );
	        $this->form_validation->set_rules($config);

	        if ($this->form_validation->run() === TRUE)
	        {
	            $data = array();
	            $id = $this->input->post('id');
	            if (empty($id))
	            {
	                $data['addtime'] = date('Y-m-d H:i:s');
	            }
	            $data['type_id'] = $this->input->post('type_id');
	            $data['action_title'] = $this->input->post('action_title');
	            $data['web_url'] = $this->input->post('web_url');
	            $data['app_url'] = $this->input->post('app_url');
	            $data['message_title'] = $this->input->post('message_title');
	            $data['message_switch'] = $this->input->post('message_switch');
	            $data['message_content'] = $this->input->post('message_content');
	            $data['sms_switch'] = $this->input->post('sms_switch');
	            $data['sms_content'] = $this->input->post('sms_content');
	            $data['email_title'] = $this->input->post('email_title');
	            $data['email_switch'] = $this->input->post('email_switch');
	            $data['email_content'] = $this->input->post('email_content');
	            
	            if (empty($id)){
	                $this->Message_Def_model->insert($data);
	                redirect(ADMIN_SITE_URL.'/message');
	            }
	            else 
	            {
	                $this->Message_Def_model->update_by_id($id,$data);
	                redirect(ADMIN_SITE_URL.'/message');
	            }
	               
	        }
	        else
	        {
	            //验证失败时的操作
	            redirect(ADMIN_SITE_URL.'/message');

	        }
	    }//-is_post()
	
	}
    
	
	function del(){
	    $id	= $this->input->get('id');
	    
	    $this->load->model('Message_Type_model');
	    $data['status'] = -1;
	    $this->Message_Def_model->update_by_id($id,$data);
	    redirect(ADMIN_SITE_URL.'/message');
	}
	
	
	public function email(){
	    $this->lang->load('admin_setting');
	    $this->lang->load('admin_message');
	    
	    //是否通过post提交
	    if ($this->input->is_post())
	    {
	        $config = array(
	            array(
	                'field'   => 'email_host',
	                'label'   => 'SMTP 服务器',
	                'rules'   => 'trim'
	            ),
	            array(
	                'field'   => 'email_port',
	                'label'   => 'SMTP 端口',
	                'rules'   => 'trim'
	            ),
	            array(
	                'field'   => 'email_addr',
	                'label'   => '发信人邮件地址',
	                'rules'   => 'trim'
	            ),
	            array(
	                'field'   => 'email_id',
	                'label'   => 'SMTP 身份验证用户名',
	                'rules'   => 'trim'
	            ),
	            array(
	                'field'   => 'email_pass',
	                'label'   => 'SMTP 身份验证密码',
	                'rules'   => 'trim'
	            ),
	            array(
	                'field'   => 'email_test',
	                'label'   => '测试接收的邮件地址',
	                'rules'   => 'trim'
	            ),
	        );
	        
	        $this->form_validation->set_rules($config);
	        if ($this->form_validation->run() === TRUE)
	        {
	            $data = array();
	            
	            $data['email_host'] = $this->input->post('email_host');
	            $data['email_port'] = $this->input->post('email_port');
	            $data['email_addr'] = $this->input->post('email_addr');
	            $data['email_id'] = $this->input->post('email_id');
	            $data['email_pass'] = $this->input->post('email_pass');
	            $data['email_test'] = $this->input->post('email_test');
	            $this->load->model('Wordbook_model');
	            foreach ($data as $key=>$value)
	            {
	                $where['k'] = $key;
	                $datas['val'] = $value;
	                $this->Wordbook_model->update_by_where($where,$datas);
	            }
	            redirect(ADMIN_SITE_URL.'/message');
	            exit;
	        }
	        else 
	        {
	            //验证失败后的操作
	            redirect(ADMIN_SITE_URL.'/message');
	        }
	        
	    }
	    
	    //不是通过post跳转到该页面则执行下列代码
	    
	    $this->load->model('Wordbook_model');
	    $result = $this->Wordbook_model->get_list();
	    
	    $list = array();
	    foreach ($result as $key=>$value)
	    {
	        $list[$value['k']] = $value['val'];
	    }
	    $result = array(
	        'list'=>$list,
	    );
	    $this->load->view('admin/email',$result);
	    
	}
	
public function mobile(){
	    $this->lang->load('admin_setting');
	    $this->lang->load('admin_message');
	    
	    //是否通过post提交
	    if ($this->input->is_post())
	    {
	        $config = array(
	            array(
	                'field'   => 'mobile_host_type',
	                'label'   => '选择短信平台',
	                'rules'   => 'trim'
	            ),
	            array(
	                'field'   => 'mobile_host',
	                'label'   => '短信服务商名称',
	                'rules'   => 'trim'
	            ),
	            array(
	                'field'   => 'mobile_username',
	                'label'   => '短信平台账号',
	                'rules'   => 'trim'
	            ),
	            array(
	                'field'   => 'mobile_pwd',
	                'label'   => '短信平台密码',
	                'rules'   => 'trim'
	            ),
	            array(
	                'field'   => 'mobile_key',
	                'label'   => '短信平台Key',
	                'rules'   => 'trim'
	            ),
	            array(
	                'field'   => 'mobile_signature',
	                'label'   => '短信内容签名',
	                'rules'   => 'trim'
	            ),
	            array(
	                'field'   => 'mobile_memo',
	                'label'   => '备注信息',
	                'rules'   => 'trim'
	            ),
	        );
	        
	        $this->form_validation->set_rules($config);
	        if ($this->form_validation->run() === TRUE)
	        {
	            $data = array();
	            
	            $data['mobile_host_type'] = $this->input->post('mobile_host_type');
	            $data['mobile_host'] = $this->input->post('mobile_host');
	            $data['mobile_username'] = $this->input->post('mobile_username');
	            $data['mobile_pwd'] = $this->input->post('mobile_pwd');
	            $data['mobile_key'] = $this->input->post('mobile_key');
	            $data['mobile_signature'] = $this->input->post('mobile_signature');
	            $data['mobile_memo'] = $this->input->post('mobile_memo');
	            $this->load->model('Wordbook_model');
	            foreach ($data as $key=>$value)
	            {
	                $where['k'] = $key;
	                $datas['val'] = $value;
	                $this->Wordbook_model->update_by_where($where,$datas);
	            }
	            redirect(ADMIN_SITE_URL.'/message');
	            exit;
	        }
	        else 
	        {
	            //验证失败后的操作
	            redirect(ADMIN_SITE_URL.'/message');
	        }
	        
	    }
	    //不是通过post跳转到该页面则执行下列代码
	     
	    $this->load->model('Wordbook_model');
	    $result = $this->Wordbook_model->get_list();
	     
	    $list = array();
	    foreach ($result as $key=>$value)
	    {
	        $list[$value['k']] = $value['val'];
	    }
	    $result = array(
	        'list'=>$list,
	    );
	    $this->load->view('admin/mobile',$result);
	    }
}
