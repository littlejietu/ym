<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address_model extends XT_Model {

	protected $mTable = 'user_address';
	protected $mPkId = 'id';

	public function get_default_info($uid) {
		return $this->get_by_where(array('userid' => $uid, 'is_default' => 1, 'status' => 1));
	}

}