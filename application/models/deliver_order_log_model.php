<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**配送员信息*/
class Deliver_order_log_model extends XT_Model {

    protected $mTable = 'deliver_order_log';

    /**
     * 配送接单日志
     * $type 1-接单、2-完成
     * $order_id 订单ID
     * $user_id派送员id
     */
    public  function addDeliverLog($type=1,$order_id=0,$user_id){

        $inData =array(
            'order_id'      => $order_id,
            'user_id'       => $user_id,
            'addtime'       => time(),
        );
        if($type==1){
            $inData['content']  = '配送员成功接单！';
        }elseif($type==2){
            $inData['content']  = '配送员完成派送！';
        }

        $this->insert_string($inData);
    }
}