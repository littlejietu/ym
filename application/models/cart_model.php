<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends XT_Model
{

    protected $mTable = 'trd_shopcart';
    protected $mPkId = 'id';
    const NORMAL_CART_STATE = 1;
    const DEL_CART_STATE = -1;

    /**
     * 查询用户购物车列表
     * @date: 2016年3月16日 下午4:39:13
     * @author: hbb
     * @param: $uid 用户ID
     * @return：array
     */
    public function get_user_cart_list($uid)
    {
        $where = array('buyer_id' => $uid, 'status' => self::NORMAL_CART_STATE);
        $arrCart = $this->get_list($where);
        return $arrCart;
    }

    /**
     * 购物车数量
     * @param $uid
     * @return int
     */
    public function get_user_cart_num($uid, $shop_id = 0)
    {
        $where = array('buyer_id' => $uid, 'status' => self::NORMAL_CART_STATE);
        $shop_id && $where['shop_id'] = $shop_id;
        return $this->sum($where, 'num');
    }

    /**
     * 查询购物车提交订单确认页商品
     * @date: 2016年3月16日 下午4:39:13
     * @author: hbb
     * @param: array $cartIds 购物车ID
     * @param: int $buyerId 购买用户id
     * @return：array
     */
    public function get_cart_buy_list(array $cartIds, $buyerId)
    {
        $where = array('id' => $cartIds, 'buyer_id' => $buyerId, 'status' => self::NORMAL_CART_STATE);
        $arrCart = $this->get_list($where);
        return $arrCart;
    }

    /**
     * 添加购物车
     * @date: 2016年3月16日 下午5:01:43
     * @author: hbb
     * @param: $data
     * @return boolean true/false
     */
    public function add_cart_info($data)
    {
        return $this->insert($data);
    }

    /**
     * 更新购物车商品数量
     * @param $cartId 购物车id
     * @param int $buyerId 购买用户id
     * @param $num 购物车商品数量
     * @return boolean true/false
     */
    public function update_cart_num($cartId, $num, $buyerId)
    {
        $data = array('num' => $num);
        $where = array('id' => $cartId, 'buyer_id' => $buyerId);

        return $this->update_by_where($where, $data);
    }

    /**
     * 更新购物车商品状态，设为删除
     * @param array $cartIds 购物车id
     * @param int $buyerId 购买用户id
     * @param $num 购物车商品数量
     * @return boolean true/false
     */
    public function update_to_del_state(array $cartIds, $buyerId, $shop_id = 0)
    {
        $data = array('status' => self::DEL_CART_STATE);

        $where['buyer_id'] = $buyerId;
        if (!empty($cartIds)) {
            $where['id'] = $cartIds;
        }
        if (!empty($shop_id)) {
            $where['shop_id<>'] = $shop_id;
        }elseif(empty($cartIds)){
            return false;
        }

        return $this->update_by_where($where, $data);
    }

    /**
     * 根据SKUID查询SKU信息
     * @date: 2016年3月17日 上午11:15:43
     * @author: hbb
     * @param: $skuid int
     * @return: array
     */
    public function get_sku_info($skuid)
    {
        $arrSku = M('goods_sku')->get_by_where(array('id' => $skuid));
        return $arrSku;
    }

}
