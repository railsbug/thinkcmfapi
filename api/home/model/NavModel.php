<?php
// +----------------------------------------------------------------------
// | 文件说明：用户-导航
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: duan
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Date: 2017-11-15
// +----------------------------------------------------------------------

namespace api\home\model;

use api\portal\model\PortalPostModel;
use api\user\model\CommentModel;
use think\Model;
use tree\Tree;

class NavModel extends Model
{

    /**
     * [NavMenuModel 一对一关联模型 关联分类下的幻灯片]
     */
    protected function items()
    {
        return $this->hasMany('NavMenuModel')->order('list_order ASC');
    }

    /**
     * [NavList 导航获取]
     */
    public function NavList($map)
    {
        $data = $this->relation('items')->field(true)->where($map)->select();

        foreach ($data[0]['items'] as $key => $value) {
            if (strpos($value['href'], "{") === 0) {
                $value['action_type']=strpos(json_decode($value['href'],true)['action'],'Page')?'/portal/pages':'/portal/lists/getCategoryPostLists';
                $value['action_id']= json_decode($value['href'],true)['param']['id'];
                $value['has_action']=true;
            }else{
                $value['has_action']=false;
            }
        }
        $data[0]['items']=$this->getSubTree($data[0]['items'],"parent_id","id");
        return $data;
    }

    /**
     * @param $data array  数据
     * @param $parent  string 父级元素的名称 如 parent_id
     * @param $son     string 子级元素的名称 如 comm_id
     * @param $pid     int    父级元素的id 实际上传递元素的主键
     * @return array
     */
    function getSubTree($data , $parent , $son , $pid = 0) {
        $tmp = array();
        foreach ($data as $key => $value) {
            if($value[$parent] == $pid) {
                $value['child'] =  $this->getSubTree($data , $parent , $son , $value[$son]);
                $tmp[] = $value;
            }
        }
        return $tmp;
    }

}

