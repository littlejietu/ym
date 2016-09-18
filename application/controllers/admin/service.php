<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/11 0011
 * Time: 10:00
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends MY_Admin_Controller {

    public function __construct() {
        parent::__construct();

    }

    public function index() {

        $this->load->view('admin/service/index.html');

    }
}

