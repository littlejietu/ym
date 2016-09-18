<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cron_service
{
    
    // 定时任务执行频率
    const EXE_TIMES = 86400;
    
    // 订单返佣时间 15天
    const ORDER_ABLE_COMMIS_DAY = 15;
    
    //分佣每次
    const LIMIT_START_TIMES = 172800;
    
    // 分佣层级
    const LEVEL = 10;

    public function __construct()
    {
        $this->ci = & get_instance();
    }

    public function set_commis($arrParam)
    {
        $this->ci->load->model('Order_model');
        $this->ci->load->model('Invite_model');
        $this->ci->load->model('Invite_bonus_model');
        
       /* $last_day_start = strtotime(date('Y-m-d 0:00:00'),strtotime('-1 day'));
        $last_day_end = strtotime(date('Y-m-d 23:59:59'),strtotime('-1 day'));*/
        //TODO:考虑有退款退货，不能时间约束。无处理状态。待处理返佣订单优化，日后再说
        $condition=array(
            'status' => C('OrderStatus.Finished'),
            'comm_amt >'=>0,
            // 'finished_time <' => $last_day_end - self::ORDER_ABLE_COMMIS_DAY * self::EXE_TIMES,
            // 'finished_time >' => $last_day_start - self::ORDER_ABLE_COMMIS_DAY * self::EXE_TIMES
        );
        $data_todo_comm = $this->ci->Order_model->get_list($condition, '*', 'finished_time asc');
        

        if(!empty($data_todo_comm)){
            array_walk($data_todo_comm, function (&$v) use($arrParam)  {

                //存在未完成退款，暂不返佣
                if($this->ci->Order_refunds_model->get_list(array('order_id'=>$v['order_id'],'status<>'=>1,'status<>'=>5),'id')){
                    return;
                }

                $invite_info = $this->ci->Invite_model->get_by_id($v['buyer_userid']);

                if(empty($invite_info['parent_id_1'])){
                    return;
                }
                $data['title'] = '推广佣金';
                $data['type'] = 1;
                $data['order_id'] = $v['order_id'];
                $data['order_sn'] = $v['order_sn'];
                $data['buyer_id'] = $v['buyer_userid'];
                $data['platform_id']=$v['platform_id'];
                $data['ip']=$arrParam['ip'];
                $data['addtime']=time();

                for ($i = 0; $i < self::LEVEL; $i ++) { 
                    if (! empty($invite_info['parent_id_' . ($i + 1)])) {
                        $data['to_user_id']=$invite_info['parent_id_' . ($i + 1)];
                        if($this->ci->Invite_bonus_model->get_by_where(array('order_id'=>$data['order_id'],'to_user_id'=>$data['to_user_id']),'id')){
                            continue;
                        }
                        $data['comm_level'] = $i + 1;
                        $data['rate']=C('distribute_rate_'.($i+1));
//                        $data['bonus_amt']=round($v['comm_amt']*(float)C('distribute_rate_'.($i+1)),2);
                        $data['bonus_amt']=(int)($v['comm_amt']*(float)C('distribute_rate_'.($i+1))*100)/100;
                        $this->ci->Invite_bonus_model->insert_string($data);
                    }
                }
            });
        }
    }

    //发放佣金
    public function comm_send(){
        $this->ci->load->model('Invite_bonus_model');
        $this->ci->load->model('User_model');
        $this->ci->load->service('fundOrder_service');
        $this->ci->load->service('message_service');

        $ip = $this->ci->input->ip_address();
        $arrList = $this->ci->Invite_bonus_model->get_list(array('status'=>1));

        foreach ($arrList as $key => $a) {
            if($a['bonus_amt']==0){
                $this->ci->Invite_bonus_model->update_by_id($a['id'], array('status'=>3));
                continue;
            }

            $aUser = $this->ci->User_model->get_by_id($a['to_user_id']);
            $title = '佣金';
            $toUserName = '';
            if(!empty($aUser))
                $toUserName = $aUser['user_name'];

            $arrReturn = $this->ci->fundorder_service->giveCashBonus($title, $a['to_user_id'], $toUserName, $a['bonus_amt'], $ip, 1);

            if($arrReturn['code']=='Success')
            {
                $this->ci->Invite_bonus_model->update_by_id($a['id'], array('status'=>2));
                //发消息
                $tpl_id = 4;
                $receiver = $a['to_user_id'];
                $arrParam = array('{order_sn}'=>$a['order_sn'],'{money}'=>$a['bonus_amt']);

                $this->ci->message_service->send_sys($tpl_id,$receiver,6,$arrParam);    //6普通单个用户
            }
            
        }
    }

    //发消息
    public function batch_send(){
        //$this->ci->load->model('Message_def_model');
        $this->ci->load->model('Message_model');
        $this->ci->load->model('Message_receiver_model');

        $this->ci->load->service('usernum_service');
       
        //取得所有未发送的消息
        $arrMsg = $this->ci->Message_model->get_list(array('is_send'=>0));
        if(!empty($arrMsg)){
            foreach ($arrMsg as $key => $a){
                if(empty($a['receiver']))
                    $this->ci->Message_model->update_by_id($a['id'],array('is_send'=>2));

                else{
                    //全部
                    if($a['receiver']=='all'){
                        $is_push = $a['is_push']==1?1:0;
                        $sql = "INSERT ".$this->ci->Message_model->prefix()."inter_message_receiver(receiver_id,message_id,is_read,is_del,push_status) SELECT id,".$a['id'].",0,1,".$is_push." FROM x_user_pwd WHERE STATUS=1";
                        /*echo $sql;
                        die;*/
                        $this->ci->Message_receiver_model->execute($sql);
                        
                        $this->ci->Message_model->update_by_id($a['id'],array('is_send'=>1));
                    }
                    else{
                        $aReceiver = explode(',',$a['receiver']);
                        foreach ($aReceiver as $key => $v) {
                            $data = array(
                                'receiver_id'=>$v,
                                'message_id'=>$a['id'],
                                'is_read'=>0,
                                'read_time'=>time(),
                                'is_del'=>1,
                                'push_status'=>$a['is_push']==1?1:0,
                                );
                            $this->ci->Message_receiver_model->insert_string($data);

                            //消息统计
                            $this->ci->usernum_service->onMessage($v);
                        }
                        $this->ci->Message_model->update_by_id($a['id'],array('is_send'=>1));
                    }
                }//if(empty($a['receiver']))
            }//foreach ($arrMsg as $key => $a)
        }
    }
    
    //推送
    public function push_message(){
        $arrReturn = array();
        $this->ci->load->model('Message_model');
        $this->ci->load->model('Message_receiver_model');
        //$this->ci->load->model('User_token_model');
        $this->ci->load->library('PushApi');

        $objPush = new PushApi();

        $db = $this->ci->Message_receiver_model->db;
        //未登录用户，不推送

        //全员推,未登录也推
        $aMessageAllList = $this->ci->Message_model->get_list(array('receiver'=>'all','is_push'=>1));
        foreach ($aMessageAllList as $key => $aMessage) {
            $title = !empty($aMessage['title'])?$aMessage['title']:'系统消息';
            $res = $objPush->push('all',$aMessage['content'],'1',$aMessage['content'],600,$title);
            if (!empty($res)) {
                $res_arr = json_decode($res, true);
                if(isset($res_arr['error'])){                   //如果返回了error则证明失败
                    echo $res_arr['error']['message'];          //错误信息
                    echo $res_arr['error']['code'];             //错误码
                    $result = array('status'=>0,'msg'=>'操作错误');   
                    $this->ci->Message_receiver_model->update_by_where(array('message_id'=>$aMessage['id']),array('push_status'=>3));
                }else{
                    $result = array('status'=>1,'msg'=>'推送成功');

                    $this->ci->Message_receiver_model->update_by_where(array('message_id'=>$aMessage['id']),array('push_status'=>2,'push_time'=>time()));
                }
                $this->ci->Message_model->update_by_id($aMessage['id'], array('is_push'=>3));
            }else{
                $result = array('status'=>0,'msg'=>'接口调用失败或无响应');
            }
        }


        //批量推--用户登录才推
        $aReceiverList = $db->select('GROUP_CONCAT(md5(receiver_id)) as receiver,message_id')->from('inter_message_receiver')
        ->join('user_token', 'user_token.user_id=inter_message_receiver.receiver_id and user_token.status=1')
        ->where('push_status',1)->where('is_del',1)->group_by('message_id')->get()->result_array();

        foreach ($aReceiverList as $k => $a) {
            $aMessage = $this->ci->Message_model->get_by_id($a['message_id']);
            $title = !empty($aMessage['title'])?$aMessage['title']:'系统消息';

            //$a['receiver']='all';
            $aReceiverTmp = explode(',', $a['receiver']);
            
            $aJPush = array('alias'=>$aReceiverTmp);
            $res = $objPush->push($aJPush,$aMessage['content'],'1',$aMessage['content'],600,$title);
            if (!empty($res)) {
                $res_arr = json_decode($res, true);
                if(isset($res_arr['error'])){                   //如果返回了error则证明失败
                    echo $res_arr['error']['message'];          //错误信息
                    echo $res_arr['error']['code'];             //错误码
                    $result = array('status'=>0,'msg'=>'操作错误','alias'=>$aJPush);   
                    $this->ci->Message_receiver_model->update_by_where(array('message_id'=>$a['message_id']),array('push_status'=>3));
                }else{
                    $result = array('status'=>1,'msg'=>'推送成功','alias'=>$aJPush);

                    $this->ci->Message_receiver_model->update_by_where(array('message_id'=>$a['message_id']),array('push_status'=>2,'push_time'=>time()));
                }
            }else{
                $result = array('status'=>0,'msg'=>'接口调用失败或无响应');
            }

            $arrReturn[] = $result;
        }

        print_r($arrReturn);
    }
    
    //统计销量
    public function countSale()
    {
        $this->ci->load->model('Order_model');
        $this->ci->load->model('Goods_num_model');
       
        $where=array(
            'status' => C('OrderStatus.Finished'),
            'finished_time >' => time()-36*60*60
            // 'finished_time <' => $last_day_end - self::ORDER_ABLE_COMMIS_DAY * self::EXE_TIMES,
            // 'finished_time >' => $last_day_start - self::ORDER_ABLE_COMMIS_DAY * self::EXE_TIMES
        );
        $list = $this->ci->Order_model->get_list($where, 'order_id', 'finished_time asc');
        //echo $this->ci->Order_model->db->last_query();die;
        
        foreach ($list as $a) {
            $prefix = $this->ci->Goods_num_model->prefix();
            $sql = "UPDATE ".$prefix."goods_num a SET be_buy_num=(SELECT SUM(num) FROM ".$prefix."trd_order_goods b WHERE b.goods_id=a.goods_id AND b.order_id IN(SELECT order_id FROM ".$prefix."trd_order WHERE STATUS='Finished')) 
                        WHERE a.goods_id IN(SELECT goods_id FROM ".$prefix."trd_order_goods WHERE order_id=".$a['order_id'].")";
            $this->ci->Goods_num_model->execute($sql);
        }

        echo date('Y-m-d H:i:s',time()).'执行完毕..';
        
    }
    
}