<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Db;
use think\Request;

/**
 * 客服信息管理
 *
 * @icon fa fa-circle-o
 */
class LdyServer extends Backend
{
    
    /**
     * LdyServer模型对象
     * @var \app\admin\model\LdyServer
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\LdyServer;

    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */



    /**
     * @return string|void
     * @throws \think\Exception
     */
    public function add()
    {

        $request = Request::instance();
        $param = $request->param();
//        var_dump($param);exit();

        $this->assign('ldy_id',$param['ldy_id']);
        $this->assign('ldy_title',$param['ldy_title']);

        if ($request->isPost()){

            $params = $this->request->post("row/a");
            if ($params['pid'] && $params['nickname'] && $params['phone'] &&$params['photo']){
//
//                var_dump($params);exit();
//                $data = [
//                    'pid' => $params['pid'],
//                    'nickname' => $params['nickname'],
//                    'phone' => $params['phone'],
//                    'photo' => $params['photo'],
//                ];
//                Db::table('ldy_server')->insert($data);

                parent::add();
                return $this->success();
            }else{
                return $this->error('添加客服失败');
            }
        }

        return $this->view->fetch();
    }



    public function index()
    {
        //设置过滤方法,添加$mywhere
        $request = Request::instance();
        $param = $request->param();

        //设置where
        $mywhere = [];
        if(isset($param['ldy_id'])){
            $mywhere["pid"] = $param['ldy_id'];
        }

        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                ->where($where)
                ->where($mywhere)
                ->order($sort, $order)
                ->count();

            $list = $this->model
                ->where($where)
                ->where($mywhere)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();

            $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);
            return json($result);
        }
        return $this->view->fetch();

    }


}
