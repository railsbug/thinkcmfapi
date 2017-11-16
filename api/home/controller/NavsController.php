<?php
// +----------------------------------------------------------------------
// | 文件说明：导航
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: duan
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Date: 2017-11-15
// +----------------------------------------------------------------------
namespace api\home\controller;

use api\home\model\NavModel;
use cmf\controller\RestBaseController;

class NavsController extends RestBaseController
{
    /**
     * [获取导航]
     * @Author:   duan
     * @DateTime: 2017-11-15
     * @since:    1.0
     */
    public function read()
    {
        //nav为空或不存在抛出异常
        $id = $this->request->param('id', 0, 'intval');
        if (empty($id)) {
            $this->error('缺少ID参数');
        }

        $map['id'] = $id;
        $obj       = new NavModel();
        $data      = $obj->NavList($map);

//        剔除分类状态隐藏 剔除分类下显示数据为空
        if ($data->isEmpty() || empty($data->toArray()[0]['items'])) {
            $this->error('该组导航显示数据为空');
        }

        $this->success("该组导航获取成功!", $data);
    }

}
