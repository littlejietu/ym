<?php
/**
 * 地址service
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Buying_service
{
    private $goods_info = array();
    protected $couponModelArr = array();

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model('discount_goods_model');
        $this->ci->load->model('discount_activity_model');
    }

    function __set($name, $value)
    {
        $this->$name = $value;
    }

    private function getCouponModel($id)
    {
        if (!isset($this->couponModelArr[$id])) {
            $this->couponModelArr[$id] = $this->ci->Coupon_model->get_by_id($id);
        }
        return $this->couponModelArr[$id];
    }


    public function get_coupon_price($uid, $coupon_id, $shop_id, $price)
    {
        $coupon = $this->ci->Coupon_User_model->get_by_id($coupon_id);
        $coupon_model = $this->getCouponModel($coupon['coupon_id']);
        if (empty($coupon) || empty($coupon_model)) {
            return -1;//没有这个优惠券
        }
        if ($coupon['user_id'] != $uid) {
            return -2;//优惠券不是这个用户的；
        }

        if ($coupon_model['use_type'] == 2 && $coupon_model['shop_id'] != $shop_id) {
            return -5;//优惠券不能在这个店铺使用
        }
        if ($coupon['status'] != 0) {
            return -3;//优惠券已经失效
        }

        if (floatval($price) < floatval($coupon_model['condition'])) {
            return -4;//优惠券不满足使用条件
        }
        return floatval($coupon_model['price']);
    }

    /*
     *
     * 使用优惠券
     * */
    public function use_coupon($coupon_id)
    {
        $coupon = $this->ci->Coupon_User_model->get_by_id($coupon_id);
        if (empty($coupon)) {
            return false;//没有这个优惠券
        }
        if (intval($coupon['status']) != 0) {
            return false;//无法使用的优惠券
        } else {
            $coupon['status'] = 1;
            $this->ci->Coupon_User_model->update_by_id($coupon_id, $coupon);
            return true;//使用成功
        }

    }

    /*
     * 获得物品参加的活动信息
     * */
    public function get_goods_activity_by_id($gid)
    {
        $time = time();
        $whereArr = array(
            "goods_id" => $gid,
            "status" => 1,
            "start_time <=" => $time,
            "from_sale >" => $time,

        );
        $data = $this->ci->discount_goods_model->get_list($whereArr, 'activity_id');
        for ($i = 0; $i < count($data); $i++) {
            $act = $this->ci->discount_activity_model->get_by_id($data[$i]['activity_id'], 'title');
            $data[$i]['title'] = $act['title'];
        }
        return $data;
    }

    /*
     * 购买活动物品，更新活动物品库存
     *
     * */
    public function buy_goods_in_activity($gid, $num)
    {
        $whereArr = array(
            'goods_id' => $gid,
            'status' => 1,
        );

        $time = time();
        $goods = $this->ci->discount_goods_model->get_by_where($whereArr);
        if (!$goods) {
            return -2;//物品不再活动中
        }
        $activi = $this->ci->discount_activity_model->get_by_id($goods['activity_id']);
        if(empty($activi)){
            return -1;//活动不存在
        }
        $now = getdate();
        if((int)$activi['start_time'] > (int)$now['hours'] || (int)$now['hours'] >= (int)$activi['end_time']){
            return -7;//当前活动未开始
        }
        if ($time < $goods['start_time']) {
            return -5;//该物品活动没开始
        }
        if ($time > $goods['from_sale']) {
            return -6;//该物品活动一结束
        }

        if (intval($goods['total']) - intval($goods['saled']) < $num) {
            return -3;//物品不足
        }
        $goods['saled'] = intval($goods['saled']) + $num;
        $num = $this->ci->discount_goods_model->update_by_id($goods['id'], $goods);
        if ($num) {
            return 1;

        } else {
            return -4;//未知错误;t
        }
    }

    /*
     *	获得活动后物品单价
     *
     * */
    public function getRealPriceInActivity($tpl_id, $price = 1)
    {
        $whereArr = array(
            'goods_id' => $tpl_id,
//			'activity_id' => $aid,
            'status' => 1,

        );

        $goods = $this->ci->discount_goods_model->get_by_where($whereArr);
        if (empty($goods)) {
            return -2;//物品不再活动中
        }
        $activi = $this->ci->discount_activity_model->get_by_id($goods['activity_id']);
        if (empty($activi)) {
            return -1;//活动不存在
        }
        $now = time();
        if ($goods['from_sale'] < $now) {
            return -4;//该物品活动已经结束
        }
        if ($goods['start_time'] > $now) {
            return -3;//该物品活动未开始
        }


        $now = getdate();
        if((int)$activi['start_time'] > (int)$now['hours'] || (int)$now['hours'] >= (int)$activi['end_time']){
            return -6;//当前活动未开始
        }
//        if (intval($goods['total']) - intval($goods['saled']) < $num) {
//            return -5;//物品不足
//        }
        $p = $price * $activi['discount'] / 10000;

        return round($p, 2);


    }


    /**
     * 取得店铺运费(使用运费模板的商品运费不会计算，但会返回模板信息)
     * 先将免运费的店铺运费置0，然后算出店铺里没使用运费模板的商品运费之和 ，存到iscalced下标中
     * 然后再计算使用运费模板的信息(array(店铺ID=>array(运费模板ID=>购买数量))，放到nocalced下标里
     * @param array $buy_list 购买商品列表
     * @param array $free_freight_sid_list 免运费的店铺ID数组
     */
    public function getStoreFreightList($buy_list = array(), $free_freight_sid_list)
    {
        //定义返回数组
        $return = array();
        //先将免运费的店铺运费置0(格式:店铺ID=>0)
        $freight_list = array();

        $return['iscalced'] = $freight_list;

        //最后再计算使用运费模板的信息(店铺ID，运费模板ID，购买数量),使用使用相同运费模板的商品数量累加
        $freight_list = array();
        foreach ($buy_list as $goods_info) {
           if($goods_info['is_free_transport'] == 0 && !empty($goods_info['goods_num'])){
               if (!isset($freight_list[$goods_info['shop_id']][$goods_info['transport_id']])) {
                   $freight_list[$goods_info['shop_id']][$goods_info['transport_id']] = 0;
               }
               $freight_list[$goods_info['shop_id']][$goods_info['transport_id']] += $goods_info['goods_num'];
            }
        }
        $return['nocalced'] = $freight_list;

        return $return;
    }


    /**
     * 根据地区选择计算出所有店铺最终运费
     * @param array $freight_list 运费信息(店铺ID，运费，运费模板ID，购买数量)
     * @param int $city_id 市级ID
     * @return array 返回店铺ID=>运费
     */
    public function calcStoreFreight($freight_list, $city_id)
    {
        if (!is_array($freight_list) || empty($freight_list) || empty($city_id)) return;

        //免费和固定运费计算结果
        $return_list = $freight_list['iscalced'];

        //使用运费模板的信息(array(店铺ID=>array(运费模板ID=>购买数量))
        $nocalced_list = $freight_list['nocalced'];
        //然后计算使用运费运费模板的在该$city_id时的运费值
        if (!empty($nocalced_list) && is_array($nocalced_list)) {
            //如果有商品使用的运费模板，先计算这些商品的运费总金额
            foreach ($nocalced_list as $shop_id => $value) {
                if (is_array($value)) {
                    foreach ($value as $transport_id => $buy_num) {
                        $freight_total = $this->ci->Transport_tpl_model->calc_transport($transport_id, $buy_num, $city_id);
                        if (empty($return_list[$shop_id])) {
                            $return_list[$shop_id] = $freight_total;
                        } else {
                            $return_list[$shop_id] += $freight_total;
                        }
                    }
                }
            }
        }

        return $return_list;
    }


    /**
     * 取得购买商品真真实库存
     * @param array $goods 购买的单个商品信息
     * @return int/array 购买的单个或多个商品真实库存
     */
    public function getRealStock(&$goods_list=array())
    {
        if(!empty($goods_list)){
            foreach($goods_list as $k=>$v){
                $goods_list[$k]['stock_num'] = self::oneStock($v);
            }
            return;
        }else{
            if(isset($this->goods_info['sku_info']['num'])){
                $stock_num = $this->goods_info['sku_info']['num'];
            }elseif(isset($this->goods_info['stock_num'])){
                $stock_num =  $this->goods_info['stock_num'];
            }else{
                $stock_num=0;
            }
            return $stock_num;
        }
    }


    /**
     * 根据库存计算需要计算运费的商品数量
     */
    public function initRealFareNum(&$goods)
    {
        if(!empty($goods[0]) && is_array($goods[0])){
            $this->getRealStock($goods);
            foreach($goods as $k=>$v){
                if($v['stock_num']>=$v['goods_num']){
                    $goods[$k]['goods_num'] =0;
                }elseif($v['stock_num']==0) {
                    $goods[$k]['goods_num'] = $v['goods_num'];
                }else{
                    $goods[$k]['goods_num'] =  $v['goods_num'] - $v['stock_num'];
                }
            }
        }else{
            $this->goods_info=$goods;
            $stock = $this->getRealStock();
            if($stock>=$goods['goods_num']){
                $goods['goods_num'] =0;
            }elseif($stock==0) {
                $goods['goods_num'] = $goods['goods_num'];
            }else{
                $goods['goods_num'] =  $goods['goods_num'] - $stock;
            }
        }
    }


    public function getFare($goods_list, $city_id)
    {
        $fare = 0;
        $this->initRealFareNum($goods_list);
        $freight_list = $this->getStoreFreightList($goods_list, array());
        $store_freight_list = $this->calcStoreFreight($freight_list, $city_id);
        if (!empty($store_freight_list)) {
            $fare = array_sum($store_freight_list);
        }
        return $fare;
    }


    /**
     * 单件购买商品的真实库存
     */
    private static final function oneStock(&$goods){
        $stock_num = 0;
        $aSku = array();

        if(!empty($goods['sku_info']['num'])){
            $stock_num = $goods['sku_info']['num'];
        }else{
            if (!empty($goods['sku_id'])) {
                $aSku = M('Goods_sku')->get_by_where(array('id' => $goods['sku_id']));
            }
            if (!empty($aSku)) {
                $stock_num = $aSku['num'];
            } elseif(!empty($goods['stock_num'])) {
                $stock_num = $goods['stock_num'];
            }else{
                $aGoodNum = M('Goods_num')->get_by_id($goods['goods_id']);
                if(!empty($aGoodNum))
                    $stock_num = $aGoodNum['stock_num'];
            }
        }

        return $stock_num;
    }

    public function getActivityName($tpl_id){
        $whereArr = array(
            'goods_id' => $tpl_id,
//			'activity_id' => $aid,
            'status' => 1,

        );

        $goods = $this->ci->discount_goods_model->get_by_where($whereArr);
        if (empty($goods)) {
            return null;//物品不再活动中
        }
        $activi = $this->ci->discount_activity_model->get_by_id($goods['activity_id'],'title,start_time,end_time');
        if (empty($activi)) {
            return null;//活动不存在
        }
        $time = time();
        if ($goods['from_sale'] < $time) {
            return null;//该物品活动已经结束
        }
        if ($goods['start_time'] > $time) {
            return null;//该物品活动未开始
        }
        $now = getdate();
        if((int)$activi['start_time'] > (int)$now['hours'] || (int)$now['hours'] >= (int)$activi['end_time']){
            return null;
        }


        return $activi['title'];
    }

}

