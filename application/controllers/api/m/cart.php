<?php
/**
 * 购物车接口
 * @date: 2016年3月16日 下午2:59:01
 * @author: hbb
 */
defined('BASEPATH') or exit('No direct script access allowed');
class Cart extends TokenApiController {

	public function __construct() {
		parent::__construct();
		$this->load->service('cart_service');
		$this->load->model('Cart_model');

		$user = $this->loginUser;
		$this->uid = $user['user_id'];

	}

	/**
	 * 购物车列表
	 * @date: 2016年3月16日 下午2:59:57
	 * @author: hbb
	 * @param: variable
	 * @return:
	 */
	public function index() {
        $shop_id =(int)$this->input->post('shop_id');
        //删除非当前店铺的所有购物车
        $this->Cart_model->update_to_del_state(array(), $this->uid,$shop_id);
		$cart_list = $this->cart_service->initGoodsList($this->uid);
		if (!empty($cart_list)) {
			output_data(array('cart_list'=>$cart_list['buy']));
		} else {
			//output_error(0, 'CART IS EMPTY!');
		    output_error(0, '购物车没有商品');
		}

	}

	/**
	 * 添加购物车
	 * @date: 2016年3月16日 下午3:07:43
	 * @author: hbb
	 * @param:  goods_id 商品ID
	 * @param:  num      数量
	 * @return:
	 */
	public function add() {
		$this->load->model('Goods_model');
		$goods_id = $this->input->post('goods_id')?(int)$this->input->post('goods_id'):0;
		$sku_id = $this->input->post('sku_id')?(int)$this->input->post('sku_id'):0;
		$cart_num = $this->input->post('num') ? (int)$this->input->post('num') : 1;

		$goods_info = $this->Goods_model->get_info_by_id($goods_id);
		if (empty($goods_info)) {
			//output_error(0, 'COODS INFO IS EMPTY!');
		    output_error(0, '不存在的商品');
		}

		$data = array(
			'buyer_id' => $this->uid,
			'shop_id' => $goods_info['shop_id'],
			'goods_id' => $goods_info['id'],
			'sku_id' => $sku_id,
			'num' => $cart_num,
			'added_price' => $goods_info['price'],
			'addtime' => time(),
		);

		if ($this->cart_service->add_cart_goods($data)) {
			output_data();
		} else {
			//output_error(-1, 'UNKNOW ERROR');
			output_error(-1, '未知错误');
		}

	}

	/**
	 * 购物车数量更新
	 * @date: 2016年3月16日 下午3:02:10
	 * @author: hbb
	 * @param: variable
	 * @return:
	 */
	public function update() {
		$data = array('code' => -1, 'msg' => 'ERROR');
		$cart_id = $this->input->post('cart_id');
		$num = $this->input->post('num');
		if (!empty($cart_id) && !strstr($num, '.') && $num > 0) {
			if ($this->Cart_model->update_cart_num($cart_id, $num, $this->uid)) {
				output_data();
			}
		}
		//output_error(-1, 'ERROR');
		output_error(-1, '错误');
	}

	/**
	 * 删除购物车商品
	 * @date: 2016年3月16日 下午3:06:09
	 * @author: hbb
	 * @param: variable
	 * @return:
	 */
	public function delete() {
		$cart_ids = $this->input->post('cart_ids');
		if ($this->cart_service->del_cart_goods($cart_ids,$this->uid)) {
			output_data();
		}
		//output_error(-1, 'ERROR');
		output_error(-1, '错误');
	}

	/**
	 * 取得购物车已选商品总价
	 * @date: 2016年3月16日 下午3:44:10
	 * @author: hbb
	 * @param: variable
	 * @return:
	 */
	public function amount() {
		$cart_ids = $this->input->post('cart_ids');
		if (!empty($cart_ids)) {
			$total_price = $this->cart_service->get_cart_total_price($cart_ids, $this->uid);
			if ($total_price>=0) {
				output_data(array('total_price' => $total_price));
			}
		}
		//output_error(-1, 'UNKNOW ERROR');
		output_error(-1, '未知错误');
	}



    /**
     * 用户购物车数量
     */
    public function num(){
        $shop_id =(int)$this->input->post('shop_id');
        $num = $this->Cart_model->get_user_cart_num($this->uid,$shop_id);
        output_data(array('num'=>$num.""));
    }

}
?>