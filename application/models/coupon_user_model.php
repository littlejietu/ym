<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon_User_model extends XT_Model {

	protected $mTable = 'coupon_user';
	
	const USABLE_STATE=0;
	
    /**
    * 查询用户可用优惠券
    * @date: 2016年3月21日 下午9:01:01
    * @author: hbb
    * @param: variable
    * @return:
    */
	public function get_usable_coupons($uid) {
	    $where = array('user_id' => $uid, 'status' => self::USABLE_STATE);
	    return $this->get_list($where);
	}
}
