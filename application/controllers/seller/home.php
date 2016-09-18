<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends BaseSellerController {

	public function index()
    {
    	$result = array(
    		'output'=>array(
                'loginUser'=>$this->loginUser,
    			),
    		);

    	$this->load->view('seller/home',$result);
    }
}