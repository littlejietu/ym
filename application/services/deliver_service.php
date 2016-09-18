<?php
/**
 * 地址service
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Deliver_service {

	public function __construct() {
		$this->ci = &get_instance();
		$this->ci->load->model('Deliver_order_log_model');
		$this->ci->load->model('Deliver_user_model');
	}

	public function getOrderLog($orderId) {
		$aList = $this->ci->Deliver_order_log_model->get_list(array('order_id'=>$orderId),'order_id,user_id as deliver_userid,content,addtime','id');
		foreach ($aList as $k => $a) {
			$aUser = $this->ci->Deliver_user_model->get_by_id($a['deliver_userid']);
			if(!empty($aUser)){
				$a['name'] = $aUser['name'];
				$a['mobile'] = $aUser['mobile'];
			}
			$aList[$k] = $a;
		}

		return empty($aList)?null:$aList;
	}
	

}