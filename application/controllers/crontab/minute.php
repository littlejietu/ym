<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Minute extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->service('cron_service');
    }

    /**
     * 每分钟定时处理任务
     */
    public function index()
    {
        $this->push_message();
    }

    private function push_message()
    {
        $this->cron_service->push_message();
    }

    public function batch_send(){
        $this->cron_service->batch_send();
    }
}
?>