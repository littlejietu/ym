<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deliver extends MY_Admin_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('Deliver_user_model');
        $this->load->model('Shop_model');
        $this->load->model('Deliver_user_pwd_model'); //派送员密码表
    }

    /**
     * 列表
     */
    public function index() {

        $this->lang->load('admin_first');

        $place_id = $this->input->post_get('place_id');
        $txtKey = $this->input->post_get('txtKey');

        $page     = _get_page();
        $pagesize = 10;
        $arrParam = array();
        $arrWhere = array();

        if(!empty($place_id) && !empty($txtKey)){
            $arrWhere[$place_id.' like'] ='"%'.$txtKey.'%"';
            $arrParam['place_id'] = $place_id;
            $arrParam['txtKey'] = $txtKey;
        }
        $list     = $this->Deliver_user_model->fetch_page($page, $pagesize, $arrWhere,'*');
        $pagecfg  = array();
        $pagecfg['base_url']     = _create_url(ADMIN_SITE_URL.'/deliver/index', $arrParam);
        $pagecfg['total_rows']   = $list['count'];
        $pagecfg['cur_page']     = $page;
        $pagecfg['per_page']     = $pagesize;

        $this->pagination->initialize($pagecfg);
        $list['pages'] = $this->pagination->create_links();

        foreach( $list['rows'] as $k => $v){
            $userInfo = $this->Deliver_user_pwd_model->get_by_id($v['user_id']);
            $list['rows'][$k]['status'] = $userInfo['status'];
        }

        $data = array(
            'list'      => $list,
            'place_id'  => $place_id,
            'txtKey'    => $txtKey,
        );

        $this->load->view('admin/deliver/index',$data);

    }

    /**
     * 编辑
     */
    public function save(){

        $this->lang->load('admin_first');

       $id =  $this->input->post_get('id');

        if($this->input->is_post()){

              $inDataTwo  = array(
                'user_name'     => $this->input->post('user_name'),
                'status'        => $this->input->post('status'),
                'token'         => md5(time().mt_rand(0,1000)),
            );
 
            $inData  = array(
                'user_name'         => $this->input->post('user_name'),
                'name'              => $this->input->post('name'),
                'id_card'           => $this->input->post('id_card'),
                'mobile'            => $this->input->post('mobile'),
                'id_card_a'         => $this->input->post('img_1'),
                'id_card_b'         => $this->input->post('img_2'),
                'logo'              => $this->input->post('img_3'),
                'mobile_verify'     => $this->input->post('mobile_verify'),
                'update_time'       => time(),
               
            );
            if(!empty($this->input->post('shop_id'))){

                   $inData['shop_id'] = implode(',',$this->input->post('shop_id'));
            }
            if(!empty($id)){
                    $inData['user_id'] = $id;
                    $inDataTwo['id']  = $id;
                    $this->Deliver_user_pwd_model->insert($inDataTwo);
              }else{

                   $id = $this->Deliver_user_pwd_model->insert_string($inDataTwo);
                   $inData['reg_time'] = time();
                   $inData['user_id'] = $id;
              }

            $this->Deliver_user_model->insert($inData);
            //echo $this->Deliver_user_model->db->last_query();die;
          
        }

        $where ='a.id = '.$id;
        $fields ='*';
        $tb ='x_deliver_user_pwd a RIGHT JOIN x_deliver_user b on(b.user_id = a.id)';
        $dataInfo = $this->Deliver_user_model->get_by_where($where,$fields,$tb);
       //echo $this->Deliver_user_model->db->last_query();die;
        //读取商铺信息
        $shopList = $this->Shop_model->get_list(array('status' => 1));


        $data = array(
            'id'            => $id,
            'dataInfo'      => $dataInfo,
            'shopList'      => $shopList,
        );
//print_r($dataInfo);die;
        $this->load->view('admin/deliver/deliver_svae',$data);
    }

    /**
     * 删除
     */
    public function del(){

        $id = $this->input->post_get('del_id');
        $data['status'] = -1;
        $where['id'] = $id;
       $this->Deliver_user_pwd_model->update_by_where($where,$data);

        redirect(ADMIN_SITE_URL.'/deliver/index');

    }
}
