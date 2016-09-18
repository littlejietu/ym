<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 退款申请理由
 */

class Order_refunds_reason_model extends XT_Model{

    protected $mTable = 'trd_order_refunds_reason';

    /**
     * 根据地区ID获取地区名称
     */
    public function getClassName($id){
        $info = $this->get_by_id($id,'title');
        if(!empty($info)){
            return $info['title'];
        }
        return '';
    }

}
