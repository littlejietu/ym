<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends XT_Model {

	protected $mTable = 'prd_category';

	protected $cachedData;
	protected $gcForCacheModel;

	/**
     * 获取缓存数据
     *
     * @return array
     * array(
     *   'data' => array(
     *     // Id => 记录
     *   ),
     *   'parent' => array(
     *     // 子Id => 父Id
     *   ),
     *   'children' => array(
     *     // 父Id => 子Id数组
     *   ),
     *   'children2' => array(
     *     // 1级Id => 3级Id数组
     *   ),
     * )
     */
    public function getCache() {
        if ($this->cachedData) {
            return $this->cachedData;
        }
        $data = rkcache('prd_category');
        if (!$data) {
            $data = array();
            $arrList = $this->get_list(array(), '*', 'parent_id asc,sort desc,id asc');
            
            foreach ($arrList as $v) {
                $id = $v['id'];
                $pid = $v['parent_id'];
                $data['data'][$id] = $v;
                $data['parent'][$id] = $pid;
                $data['children'][$pid][] = $id;
            }
            if(!empty($data['children'][0])){
                foreach ((array) $data['children'][0] as $id) {
                    if(!empty($data['children'][$id])){
                        foreach ((array) $data['children'][$id] as $cid) {
                            if(!empty($data['children'][$cid])){
                                foreach ((array) $data['children'][$cid] as $ccid) {
                                    $data['children2'][$id][] = $ccid;
                                }
                            }
                        }
                    }
                }
            }
            wkcache('prd_category', $data);
        }

        return $this->cachedData = $data;
    }


	/**
     * 从缓存获取分类 通过上级分类id
     *
     * @param int $pid 上级分类id 若传0则返回1级分类
     */
    public function getListByParentId($pid) {
        $data = $this->getCache();
        $ret = array();
        if (isset($data['children'][$pid]))
        {
            foreach ((array) $data['children'][$pid] as $i) {
                if ($data['data'][$i]) {
                    $ret[] = $data['data'][$i];
                }
            }
        }
        return $ret;
    }

    /**
     * 从缓存获取分类 通过分类id
     *
     * @param int $id 分类id
     */
    public function getInfoById($id) {
        $data = $this->getCache();
        return $data['data'][$id];
    }

	/**
     * 取得店铺绑定的分类
     *
     * @param   number  $shop_id   店铺id
     * @param   number  $pid        父级分类id
     * @param   number  $deep       深度
     * @return  array   二维数组
     */
    public function getShopList($shop_id=0, $pid = 0, $deep = 1) {
        // 读取商品分类 批量添加分类修改
        $gc_list_o = $gc_list = $this->getListByParentId($pid);
        // 如果不是自营店铺或者自营店铺未绑定全部商品类目，读取绑定分类
        // if (!checkPlatformShopBindingAllCategory()) {
        //     //todo:读取店铺绑定分类
        // 	return array();
        // }
        return $gc_list;
    }



    /**
     * 取指定分类ID的所有父级分类
     *
     * @param int $id 父类ID/子类ID
     * @return array $nav_link 返回数组形式类别导航连接
     */
    public function getLine($id = 0) {
        $gc_line = array();
        if (intval($id)> 0) {
            /**
             * 取当前类别信息
             */
            $class = $this->getInfoById(intval($id));
            $gc_line['id'] = $class['id'];
            /**
             * 是否是子类
             */
            if ($class['parent_id'] != 0) {
                $parent_1 = $this->getInfoById($class['parent_id']);
                if ($parent_1['parent_id'] != 0) {
                    $parent_2 = $this->getInfoById($parent_1['parent_id']);
                    $gc_line['id_1'] = $parent_2['id'];
                    $gc_line['line_cate_name'] = trim($parent_2['name']) . ' >';
                }
                if (!isset($gc_line['id_1'])) {
                    $gc_line['id_1'] = $parent_1['id'];
                } else {
                    $gc_line['id_2'] = $parent_1['id'];
                }
                $gc_line['line_cate_name'] .= trim($parent_1['name']) . ' >';
            }
            if (!isset($gc_line['id_1'])) {
                $gc_line['id_1'] = $class['id'];
            } else if (!isset($gc_line['id_2'])) {
                $gc_line['id_2'] = $class['id'];
            } else {
                $gc_line['id_3'] = $class['id'];
            }
            $gc_line['line_cate_name'] .= trim($class['name']) . ' >';

            $gc_line['line_cate_name'] = trim($gc_line['line_cate_name'], ' >');
        }
        
        return $gc_line;
    }

    public function make_js_file()
    {
        $result = $this->get_list(array(), '*', 'parent_id asc,sort asc,id asc');
        $data = array();
        foreach ($result as $key => $a) {
            $data[$a['id']] = array('name'=>$a['name'],'value'=>$a['id'],'pid'=>$a['parent_id']);
        }

        $fileData = 'var A_version='.date('Ymd',time()).';var top_id=0;var dataMultiArea={};';
        $fileData = $fileData.'var dataAllArea='.json_encode($data).';';
        file_put_contents(BASE_ROOT_PATH.'/res/front/js/category.js',$fileData);
    }
    
    
    public function insert_string($data)
    {
        if (parent::insert_string($data))
        {
            dkcache('prd_category');
            unset($this->cachedData);
        }
    }
    
    public function update_by_id($id,$data)
    {
        if (parent::update_by_id($id,$data))
        {
            dkcache('prd_category');
            unset($this->cachedData);
        }
    }
    
    public function delete_by_id($id)
    {
        if (parent::delete_by_id($id))
        {
            dkcache('prd_category');
            unset($this->cachedData);
        }
    }
}