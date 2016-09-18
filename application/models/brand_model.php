<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand_model extends XT_Model {

	protected $mTable = 'prd_brand';

	protected $cachedData;

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
        $data = rkcache('prd_brand');
        if (!$data) {
            $data = array();
            $arrList = $this->get_list(array('status'=>1), '*', 'initial asc, parent_id asc, sort asc,id asc');
            foreach ($arrList as $v) {
                $id = $v['id'];
                $pid = $v['parent_id'];
                $data['data'][$id] = $v;
                $data['parent'][$id] = $pid;
                $data['children'][$pid][] = $id;
            }
            foreach ((array) $data['children'][0] as $id) {
                foreach ((array) $data['children'][$id] as $cid) {
                    foreach ((array) $data['children'][$cid] as $ccid) {
                        $data['children2'][$id][] = $ccid;
                    }
                }
            }
            wkcache('prd_brand', $data);
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
        foreach ((array) $data['children'][$pid] as $i) {
            if ($data['data'][$i]) {
                $ret[] = $data['data'][$i];
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
     * 从缓存获取全部分类
     */
    public function getList($category_id=0) {
        $data = $this->getCache();
        $arrResult = array_values((array) $data['data']);

        if(!empty($category_id))
        {
        	$arrRes = array();
        	foreach ($arrResult as $k => $v) {
        		if($v['category_id']==$category_id)
        			$arrRes[]=$v;
        	}

        	return $arrRes;
        }
        return $arrResult;
    }
	
	/**
     * 从缓存获取全部分类 分类id作为数组的键
     */
    public function getIndexedList() {
        $data = $this->getCache();
        return (array) $data['data'];
    }

}