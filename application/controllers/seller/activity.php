<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activity extends BaseSellerController {

	function __construct()
	{
		parent::__construct();

		$this->load->model('pmt/Activity_model'); 
	}

    public function index() {
        $this->load->model('oil/Site_model'); 

        $page     = _get_page();
        $pagesize = 5;
        $arrParam = array();
        $arrWhere = array('status<>'=>-1);
        $list = $this->Activity_model->fetch_page($page, $pagesize, $arrWhere,'*');
        foreach ($list['rows'] as $k => $v) {
            $v['user_level_name'] = '所有会员';
            $v['period_time'] = '任意时段';
            if($v['is_period']==1){
                $strWeek = '';
                $strTime = '';
                if(!empty($v['weekdays'])){
                    $arrWeek = array(1=>'周一',2=>'周二',3=>'周三',4=>'周四',5=>'周五',6=>'周六',7=>'周日');
                    $arrTmp = explode(',', $v['weekdays']);
                    $arrTmpWeek = array();
                    foreach ($arrTmp as $vv) {
                        $arrTmpWeek[] = $arrWeek[$vv];
                    }
                    $strWeek = implode(',', $arrTmpWeek);
                    $strTime1 = zerofill(intval($v['time1']/60)).':'.zerofill($v['time1']%60);
                    $strTime2 = zerofill(intval($v['time2']/60)).':'.zerofill($v['time2']%60);
                    $strTime = $strTime1.' - '.$strTime2;
                }
                $v['period_time'] = $strWeek.' '.$strTime;
            }
            $v['site_names'] = '所有加油站';
            if(!empty($v['site_ids']))
                $v['site_names'] = $this->Site_model->get_by_where('id in('.$v['site_ids'].')');
            $list['rows'][$k] = $v;
        }

        //分页
        $pagecfg = array();
        $pagecfg['base_url']     = _create_url(SELLER_SITE_URL.'/activity', $arrParam);
        $pagecfg['total_rows']   = $list['count'];
        $pagecfg['cur_page'] = $page;
        $pagecfg['per_page'] = $pagesize;
        
        $this->pagination->initialize($pagecfg);
        $list['pages'] = $this->pagination->create_links();
        
        $result = array(
            'list' =>$list,
        );

        $this->load->view('seller/pmt/activity',$result);
    }
    
    //新增
    public function add()
    {
        $id = $this->input->get('id');

        $this->load->model('pmt/Discount_step_model');
        $info = array();
        $discount_list = array();
        if(!empty($id)){
            $info = $this->Activity_model->get_by_id($id);
            if(!empty($info))
                $discount_list = $this->Discount_step_model->get_list(array('act_id'=>$id,'discount_type'=>$info['type'],'status'=>1));
        }

        $result = array(
            'discount_list' => $discount_list,
            'info' => $info,
        );
        
        $this->load->view('seller/pmt/activity_add',$result);
    }
    
    public function save()
    {

        $this->load->model('pmt/Discount_step_model'); 

        if ($this->input->is_post())
        {
            $config = array(
                array(
                    'field'   => 'title',
                    'label'   => '名称',
                    'rules'   => 'trim|required'
                ),
                array(
                    'field'   => 'intro',
                    'label'   => '说明',
                    'rules'   => 'trim|required'
                ),
            );
            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() === TRUE)
            {
                $id = $this->input->post('id');
                $step = $this->input->post('step');
                $start_time = $this->input->post('start_time');
                $start_time = !empty($start_time)?strtotime($start_time.':00'):0;
                $end_time = $this->input->post('end_time');
                $end_time = !empty($end_time)?strtotime($end_time.':00'):0;
                $time1 = $this->input->post('time1');
                $minute1 =  substr($time1, 0, strpos($time1,':'))*60 + substr($time1, strpos($time1,':')+1);
                $time2 = $this->input->post('time2');
                $minute2 =  substr($time2, 0, strpos($time2,':'))*60 + substr($time2, strpos($time2,':')+1);
                $discount_type = $this->input->post('discount_type');

                $data = array(
                    'title' => $this->input->post('title'),
                    'type' => $discount_type,    //1:满就送 2:限时打折
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'is_period' => $this->input->post('is_period'),
                    'weekdays' => $this->input->post('weekdays'),
                    'time1' => $minute1,
                    'time2' => $minute2,
                    'intro' => $this->input->post('intro'),
                    'is_limit_site' => $this->input->post('is_limit_site'),
                    'site_ids' => $this->input->post('site_ids'),
                    'user_level' => $this->input->post('user_level'),
                    'is_limit_total_num' => $this->input->post('is_limit_total_num'),
                    'limit_total_num' => $this->input->post('limit_total_num'),
                    'is_limit_per_total_num' => $this->input->post('is_limit_per_total_num'),
                    'limit_per_total_num' => $this->input->post('limit_per_total_num'),
                    'is_limit_per_day_num' => $this->input->post('is_limit_per_day_num'),
                    'limit_per_day_num' => $this->input->post('limit_per_day_num'),
                    'discount_top_amount' => $this->input->post('discount_top_amount'),
                    'memo' => $this->input->post('memo'),
                    'status' => $this->input->post('status'),
                );

                if(empty($id))
                    $id = $this->Activity_model->insert($data);
                else
                    $this->Activity_model->update_by_id($id, $data);

                foreach ($step as $k_id => $v) {
                    if($v['type']==$discount_type){
                        $data_step = array('act_id' => $id, 
                            'order_amount' => $v['order_amount'],
                            'discount_type' => $discount_type,
                            'status' => 1,
                        );

                        if($discount_type == 1)
                            $data_step['discount_amount'] = $v['discount_amount'];
                        else
                            $data_step['discount_percent'] = $v['discount_percent']/100;

                        if($k_id<0)
                            $this->Discount_step_model->insert($data_step);
                        else
                            $this->Discount_step_model->update_by_id($k_id, $data_step);

                    }
                }

                redirect(SELLER_SITE_URL.'/activity');
            }
        }
    }
    
  
    
    //删除操作
    public function del()
    {
        if ($this->input->is_post())
        {
            $id = $this->input->post('del_id');
        }
        else
        {
            $id = $this->input->get('id');
        }
        $where = array('id'=>$id);
        $data = array('status'=>-1);
        $this->Activity_model->update_by_where($where,$data);
        redirect( SELLER_SITE_URL.'/activity' );
    }

    public function ajax_step_del(){
        $step_id = $this->input->post('step_id');
        $act_id = $this->input->post('act_id');

        $this->load->model('pmt/Discount_step_model');
        $where = array('id'=>$step_id, 'act_id'=>$act_id);
        $data = array('status'=>-1);
        $this->Discount_step_model->update_by_where($where, $data);
        echo 'true';exit;
    }
}
