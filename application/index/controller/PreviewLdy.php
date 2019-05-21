<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 2019/5/16
 * Time: 17:34
 */

namespace app\index\controller;


use app\common\controller\Frontend;

class PreviewLdy extends Frontend
{


    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';

    /**
     * 落地页预览
     * @return string
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {

        $params = $this->request->param();
        if (isset($params['ids'])) {
            $ldyId = $params['ids'];

            //1.落地页主要信息
            $ldyMain = db('ldy_main')->where('id', $ldyId)->select();
//            var_dump($ldyMain[0]['content']);exit();
            $category['id'] = $ldyId;
            $category['meta_title'] = $ldyMain[0]['meta_title'];
            $category['content'] = $ldyMain[0]['content'];

            $banners = array_filter(explode(",",$ldyMain[0]['banner']));//将banner转为数组
            $tpl = $ldyMain[0]['template_lists'];

            //2.落地页客服内容信息,可能有多个（二维数组）
            $ldyServers = db('ldy_server')->where('pid', $ldyId)->select();
            if (count($ldyServers)){
                $randNum = rand(0, count($ldyServers) - 1);

                $ldyServer['name'] = $ldyServers[$randNum]['nickname'];
                $ldyServer['tel'] = $ldyServers[$randNum]['phone'];
                $ldyServer['wximg'] = $ldyServers[$randNum]['photo'];
                $ldyServer['qita'] = 'Ta';
                $this->assign('kefu', $ldyServer);
            }else{
//                $ldyServer['name'] = "";
//                $ldyServer['tel'] = "";
//                $ldyServer['wximg'] = "";
                $this->error("请先添加客服！");
            }

            $this->assign('type', $category);
            $this->assign('banners', $banners);


            //todo 模板文件名读取
            return $this->view->fetch("$tpl");
        }
    }


}