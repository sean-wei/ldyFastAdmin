<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Db;
use think\Exception;
use think\exception\PDOException;
use think\exception\ValidateException;
use think\Request;

/**
 * 文档模型基础管理
 *
 * @icon fa fa-circle-o
 */
class LdyDoc extends Backend
{
    
    /**
     * LdyDoc模型对象
     * @var \app\admin\model\LdyDoc
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\LdyDoc;

    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */

    public function index()
    {
        //从落地页进入：设置过滤方法,添加$mywhere
        $request = Request::instance();
        $param = $request->param();

        //设置where
        $mywhere = [];
        if(isset($param['ldy_id'])) {
            $mywhere["ldy_id"] = $param['ldy_id'];

            //设置过滤方法
            $this->request->filter(['strip_tags']);
            if ($this->request->isAjax()) {
                //如果发送的来源是Selectpage，则转发到Selectpage
                if ($this->request->request('keyField')) {
                    return $this->selectpage();
                }
                list($where, $sort, $order, $offset, $limit) = $this->buildparams();
                $total = $this->model
                    ->alias('ld')
                    ->field('ld.id, ld.nickname, ld.photo, lm.title')
                    ->where($where)
                    ->where($mywhere)
                    ->join('ldy_main lm','ld.ldy_id = lm.id','RIGHT')
                    ->order('ld.id', $order)
                    ->count();

                $list = $this->model
                    ->alias('ld')
                    ->field('ld.id, ld.nickname, ld.photo, lm.title')
                    ->where($where)
                    ->where($mywhere)
                    ->join('ldy_main lm','ld.ldy_id = lm.id','RIGHT')
                    ->order('ld.id', $order)
                    ->limit($offset, $limit)
                    ->select();

                $list = collection($list)->toArray();
                $result = array("total" => $total, "rows" => $list);
                return json($result);
            }
            return $this->view->fetch();
        }

        return parent::index();

    }


    /**
     * 重写edit逻辑，为了存储detail
     * @param null $ids
     * @return string
     * @throws Exception
     * @throws \think\exception\DbException
     */
    public function edit($ids = null)
    {
        $row = $this->model->get($ids);

        //获取详细内容
        $detail = \db('ldy_doc_detail')->where('doc_id',$ids)->value('content');

        if (!$row) {
            $this->error(__('No Results were found'));
        }
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds)) {
            if (!in_array($row[$this->dataLimitField], $adminIds)) {
                $this->error(__('You have no permission'));
            }
        }
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);
                $result = false;
                Db::startTrans();
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.edit' : $name) : $this->modelValidate;
                        $row->validateFailException(true)->validate($validate);
                    }
                    $result = $row->allowField(true)->save($params);

                    //保存detail
                    $resultUpdate = \db('ldy_doc_detail')
                        ->where('doc_id',$ids)
                        ->update(['content' => $params['detail']]);
                    if ($resultUpdate == false){
                        //创建
                        $data = ['doc_id' => $ids, 'content' => $params['detail']];
                        \db('ldy_doc_detail')->insert($data);
                    }

                    Db::commit();
                } catch (ValidateException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (PDOException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (Exception $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                }
                if ($result !== false) {
                    $this->success();
                } else {
                    $this->error(__('No rows were updated'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $this->view->assign('detail', $detail);
        $this->view->assign("row", $row);
        return $this->view->fetch();

    }


    public function add()
    {
        $request = Request::instance();
        $param = $request->param();

        $this->assign('ldy_id',$param['ldy_id']);

        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);

                if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                    $params[$this->dataLimitField] = $this->auth->id;
                }
                $result = false;
                Db::startTrans();
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.add' : $name) : $this->modelValidate;
                        $this->model->validateFailException(true)->validate($validate);
                    }
                    $result = $this->model->allowField(true)->save($params);

                    Db::commit();

                    //添加detail
//                    $ldyDocId = Db::name('ldy_doc')->getLastInsID();
//                    $data = ['id' => $ldyDocId, 'content' => $params['detail']];
//                    \db('ldy_doc_detail')->insert($data);
                } catch (ValidateException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (PDOException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (Exception $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                }
                if ($result !== false) {
                    $this->success();
                } else {
                    $this->error(__('No rows were inserted'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }

        return $this->view->fetch();
    }


    /**
     * 文章列表添加问答
     * @param $ids
     * @return mixed
     */
    public function addDocReply($ids = null){
        if ($this->request->param('ids')){
            $ldyDocId = $this->request->param('ids');
            $this->redirect("ldy_doc_reply/add",['ldy_doc_id' => $ldyDocId]);
        }
        return $this->error('cannot get ldy_id');
    }

    /**
     * 文章列表查看问答列表
     * @param $ids
     * @return mixed
     */
    public function ListDocReply($ids = null){

        if ($this->request->param('ids')){
            $ldyDocId = $this->request->param('ids');
            $this->redirect("ldy_doc_reply/index",['ldy_doc_id' => $ldyDocId]);
        }

        return $this->error('cannot get ldy_id');

    }



}
