<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use think\Config;

class Index extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';

    public function index()
    {
        return $this->view->fetch();
    }

    public function news()
    {
        $newslist = [];
        return jsonp(['newslist' => $newslist, 'new' => count($newslist), 'url' => 'https://www.fastadmin.net?ref=news']);
    }



    public function testJson(){
        $data = [
            'sean' => 'BMW',
            'edc' => 'Bens',
            'MC Hotdog' => 'cadillac'
        ];

        $result = toJson(200,'success', $data);

        return $result;
    }


    /**
     * 百度小程序数据接口test
     * @return string
     */
    public function baiduJson(){
        $data = db('wechat_demo')
            ->limit(10)
            ->order('updatetime', 'desc')
            ->select();

        foreach ($data as &$item){
            $item['image'] = Config::get('root_address') . $item['image'];
        }

        $result = toJson(200,'success', $data);

        return $result;
    }





}
