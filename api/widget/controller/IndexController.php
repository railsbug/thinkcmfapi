<?php

namespace api\widget\controller;

use api\widget\model\ThemeFileModel;
use think\Db;
use cmf\controller\RestBaseController;

class IndexController extends RestBaseController
{
    protected $themeFileModel;

    public function __construct(ThemeFileModel $themeFileModel)
    {
        parent::__construct();
        $this->themeFileModel = $themeFileModel;
    }


    // api 首页
    public function index()
    {
        $params = $this->request->get();
        $params['field'] = 'more';
        $data   = $this->themeFileModel->getDatas($params);
        $data[0]['more'] =  json_decode($data[0]['more'],true);
        $this->success('请求成功!', $data);
    }


}
