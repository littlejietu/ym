<?php
/**
 * 购买相关API
 * @date: 2016年3月18日 下午4:29:59
 * @author: hbb
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Buy extends TokenApiController {
	public function __construct() {
		parent::__construct();
		$this->load->service('address_service');
		$this->load->service('cart_service');
		$this->load->service('buy_service');
		$this->load->service('order_service');
		$this->load->service('coupon_service');
		
		$user = $this->loginUser;
		$this->uid = $user['user_id'];
		$this->user_name = $user['user_name'];
	}

	/**
	 * 函数用途描述
	 * @date: 2016年3月18日 下午4:29:55
	 * @author: hbb
	 * @param: variable
	 * @return:
	 */
	public function index() {
		$this->confirm();
	}

	/**
	 * 校验用户地址是否存在
	 * @date: 2016年3月18日 下午4:31:23
	 * @author: hbb
	 * @return: boolean
	 */
	public function check_address() {
	    $this->XT_Model->set_table('user_address');
		if ($this->XT_Model->get_by_where(array('userid' => $this->uid, 'status' => 1), 'id')) {
			output_data(array());
		}
		output_data(array(4,'ADDRESS IS EMPTY'));
	}

	/**
	 * 订单确认
	 * @date: 2016年3月18日 下午4:31:23
	 * @author: hbb
	 * @param: string $_POST['cart_id']  goods_id(cart_id)|sku_id|num,goods_id(cart_id)|sku_id|num
	 * @param: string $_POST['ifcart'] 是否购物车提交
	 * @return: array $data
	 */
	public function confirm() {
		$cart_id = $this->input->post('cart_id');
		$ifcart = $this->input->post('ifcart');

		$cart_id = explode('|', $cart_id);
		$user_id = $this->uid;
		$shop_id = 0;
		$total_amt = 0;

		//收货地址
		$address_info = $this->address_service->get_default_address($user_id);
		$city_id=!empty($address_info['city_id'])?$address_info['city_id']:0;
		unset($address_info['city_id']);
		
		//购买商品和金额
		if ($ifcart) {
			$buy_data = $this->cart_service->initGoodsList($user_id, $cart_id, $city_id);
		} else {
			$buy_data = $this->buy_service->get_buy_goods($cart_id, $city_id);
		}

        if(!is_array($buy_data)){
            switch($buy_data){
                case -1:
                    output_error(-1,'错误');
                    break;
                case -2:
                    output_error(-2,'所购商品无效');
                    break;
                case -3:
                    output_error(-3,'一次最多只可购买50种商品');
                    break;
                case 0:
                    output_error(0,'商品已售罄');
                    break;
            }
            exit;
        }

        //先考虑一家店铺
        if(!empty($buy_data['buy'][0]['shop']['id'])){
            $shop_id=$buy_data['buy'][0]['shop']['id'];
        }

        if(!empty($buy_data['amount']['total_goods'])){
            $total_amt=$buy_data['amount']['total_goods'];
        }

		//优惠券
		$coupon_list=$this->coupon_service->get_order_use_coupons($user_id, $shop_id, $total_amt);
		$coupons=array(
		    'num'=>count($coupon_list),
		    'list'=>empty($coupon_list)?null:$coupon_list,
		);
		
		output_data(
		    array(
    		    'address' => empty($address_info)?null:$address_info,
    		    'goods' => $buy_data['buy'],
		        'delivery'=>$buy_data['delivery'],
		        'coupon'=>$coupons,
		        'amount'=>$buy_data['amount']
		    )
		);
	}
	
	
	/**
	* 创建订单
	* @date: 2016年3月22日 下午3:28:34
	* @author: hbb
	* @param: variable
	* @return:
	*/
	public function create() {
	    $cart = $this->input->post('cart');
	    $address_id = $this->input->post('address_id');
        $ifcart =  $this->input->post('ifcart');
	    $invoiceId = 0;
        $arrBuy = array('buyer_userid'=>$this->uid,'buyer_username'=>$this->user_name);
        if($cart){
            $arrOrderIds = $this->order_service->createOrderList($cart, $arrBuy, $address_id, $invoiceId, $ifcart);
            if($arrOrderIds){
                output_data(array('order_ids'=>implode(',', $arrOrderIds)));
            }
        }
        
    	//output_error(-1,'ERROR');
        output_error(-1,'错误');
	}
	
	
	
	/**
	* 付款界面 收银台
	* @date: 2016年3月22日 下午5:03:23
	* @author: hbb
	* @param: variable
	* @return:
	*/
	public function cashier(){
	    $order_id = $this->input->post('order_id');
	    $agetn_type= $this->input->post('agent_type')?1:0;
	    
	    if(empty($order_id)){
	        //output_error(-1,'ERROR');
	        output_error(-1,'错误');
	    }

	    $arrIds=explode(',', $order_id);
	    if(is_array($arrIds)){
	        //支付金额
	        $this->load->model('Order_model');
	        $orderInfo=$this->Order_model->get_list(
	            array(
	                'order_id'=>$arrIds,
	                'status'=>array(
	                    C('OrderStatus.Create'),
	                    C('OrderStatus.WaitPay')
	                )
	            ),
	            'order_id,pay_amt'
	        );
	        //$pay_amount = array_reduce($orderInfo, function ($foo, $v) {return $foo + $v['pay_amt'];});
	        $pay_amount=0;
	        $order_ids=array();
	        foreach ($orderInfo as $v)
	        {
	            $pay_amount +=$v['pay_amt'];
	            $order_ids[]=$v['order_id'];
	        }
	        if(array_diff($arrIds,$order_ids)){
	            //output_error(-1,'ORDERID IS INVALID');
	            output_error(-1,'非法的订单ID');
	        }
	        $pay_amount=number_format($pay_amount,2,'.','');
	        
	        //用户余额
    	 //    $this->XT_Model->set_table('acct_user_account');
    		// $user_account = $this->XT_Model->get_by_where(array('user_id' => $this->uid), 'acct_balance');
    		$this->load->model('Account_model');
    		$user_account = $this->Account_model->init_get($this->uid);
	        
	        output_data(array(
	            'order_ids'=>implode(',', $order_ids),
	            'pay_amount'=>$pay_amount,
	            'user_amount'=>$user_account['acct_balance'],
	            'paymethod'=>array(
	                array(
	                   'title'=>'余额',
	                    'code'=>C('PayMethodType.AllBalance')
	                ),
	                array(
	                   'title'=>'微信支付',
	                    'code'=>$agetn_type ? C('PayMethodType.WeixinPayApp') : C('PayMethodType.WeixinPayJs')
	                )
	            )
	        ));
	    }
	}
	
	
}