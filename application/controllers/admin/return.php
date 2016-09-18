<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Returns extends MY_Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function return_manage(){
        $type = $this->input->post_get('type');

        $dataList = array();

        $data = array(
            'type'     => $type,
            'dataList' => $dataList,
        );
        $this->load->view('admin/return_manage_list',$data);
    }
}
