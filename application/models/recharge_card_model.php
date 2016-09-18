<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recharge_card_model extends XT_Model {

	protected $mTable = 'acct_recharge_card';

	/**
     * 通过给定的卡号数组过滤出来不能被新插入的卡号（卡号存在的）
     *
     * @param array $sns 卡号数组
     *
     * @return array
     */
    /*public function getOccupiedRechargeCardSNsBySNs(array $sns)
    {
        $this->db->table($this->mTable)->where_in('sn', $sns);
        $array = $this->db->get()->row_array();
print_r($array);die;
        $data = array();

        foreach ((array) $array as $v) {
            $data[] = $v['sn'];
        }

        return $data;
    } */


     


	
}