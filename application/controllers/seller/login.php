<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {

    	$this->load->view('seller/login');
    }

	/**
	 *前台验证码
	 */
	public function captcha(){
		$this->load->helper('captcha');
		create_captcha(4,90,26,'verify');
	}


	/**
	 * 商家登录
	 */
	public function seller_login(){

		if($this->input->post()) {

			$this->load->model('Shop_model');
			$this->load->model('User_pwd_model');
			$this->load->model('User_model');
			$arrRes 	= array();
			$user_name 	= $this->input->post('user_name');
			$pwd 		= $this->input->post('pwd');
			$code 		= $this->input->post('code');

			$this->load->helper('captcha');

			#region CI自带验证

			$config = array(
				array(
					'field'=>'user_name',
					'label'=>'用户名',
					'rules'=>'trim|required',
				),
				array(
					'field'=>'pwd',
					'label'=>'密码',
					'rules'=>'trim|required',
				),
				array(
					'field'=>'code',
					'label'=>'密码',
					'rules'=>'trim|required',
				)
			);

			$this->form_validation->set_rules($config);

		#endregion

			//验证验证码是否真正确
			if(!check_captcha($code,'verify')){
				$arrRes['code'] = '-1';
				$arrRes['msg'] = 'CODE_ERROR';
				showMessage('验证码不能为空！','/seller/login');
			}
			//查询商家表信息
			$shopInfo =	$this->Shop_model->get_by_where('seller_username = "' .$user_name.'"');

			//判断用户名是否正确
			if(empty($shopInfo)) {
				$arrRes['code'] = '-1';
				$arrRes['msg'] = 'SHOP_ERROR';
				showMessage('用户名或密码错误1！','/seller/login');
			}

			//查询用户密码表信息
			$userPwdInfo =	$this->User_pwd_model->get_by_id($shopInfo['seller_userid']);
			if(empty($userPwdInfo)) {

				$arrRes['code'] = '-1';
				$arrRes['msg'] = 'USERINFO_ERROR';
				showMessage('用户名或密码错误2！','/seller/login');
			}

			//判断输入密码是否正确
			if(md5($pwd)!=$userPwdInfo['pwd']) {

				$arrRes['code'] = '-1';
				$arrRes['msg'] = 'PWD_ERROR';
				showMessage('用户名或密码错误3！','/seller/login');
			}

			//查询用户详细信息
			$userInfo =	$this->User_model->get_by_id($shopInfo['seller_userid']);
			$_SESSION['user_id']	= $userInfo['user_id'];
			$_SESSION['name']		= $userInfo['name'];
			$_SESSION['shop_name']	= $shopInfo['name'];
			$_SESSION['user_name']	= $userInfo['user_name'];
			$_SESSION['user_logo']	= $userInfo['logo'];
			$_SESSION['shop_id']	= $shopInfo['id'];

			$arrRes['code'] = '1';
			$arrRes['msg'] = 'SUCCESS';

//			showMessage('登录成功！','/seller/home');
			redirect(SELLER_SITE_URL.'/home');
		}
	}

	public function logout(){

		$_SESSION['user_id'] = '';
		$_SESSION['name'] = '';
		$_SESSION['user_name'] = '';
		$_SESSION['user_logo'] = '';
		$_SESSION['shop_id'] = '';

		redirect(SELLER_SITE_URL);
	}

}