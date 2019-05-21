<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\App;
use think\Db;
use think\Env;
use think\Exception;
use think\exception\PDOException;
use think\exception\ValidateException;
use think\View;

/**
 * 落地页管理
 *
 * @icon fa fa-circle-o
 */
class LdyMain extends Backend
{
    
    /**
     * LdyMain模型对象
     * @var \app\admin\model\LdyMain
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\LdyMain;

    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */


    /**
     * 落地页添加客服
     * @param $ids
     * @return mixed
     */
    public function addServer($ids = null){

        if ($this->request->param('ids')){
            $ldyId = $this->request->param('ids');
            $ldyTitle = \db('ldy_main')->where('id',$ldyId)->value('title');

            $this->redirect("ldy_server/add",['ldy_id' => $ldyId, 'ldy_title'=>$ldyTitle]);

        }

         return $this->error('cannot get ldy_id');

    }

    /**
     * 落地页查看客服列表
     * @param $ids
     * @return mixed
     */
    public function listLdyServer($ids = null){

        if ($this->request->param('ids')){
            $ldyId = $this->request->param('ids');
            $this->redirect("ldy_server/index",['ldy_id' => $ldyId]);
        }

        return $this->error('cannot get ldy_id');

    }


    /**
     * 落地页模板-图片排版
     * @return string
     * @throws \think\Exception
     */
    public function listLdyTpl(){

        $listLdyTpl = db('ldy_picture')->select();

        $this->view->assign('listLdyTpl',$listLdyTpl);

        return $this->view->fetch();

    }


    /**
     * 文章列表
     * @param $ids 落地页id
     *
     */
    public function docList(){
        if ($this->request->param('ids')){
            $ldyId = $this->request->param('ids');
            $this->redirect("ldy_doc/index",['ldy_id' => $ldyId]);
        }
        return $this->error('cannot get ldy_id');

    }

    /**
     * 添加文章
     * @param $ids 落地页id
     *
     */
    public function addDoc(){
        if ($this->request->param('ids')){
            $ldyId = $this->request->param('ids');
            $this->redirect("ldy_doc/add",['ldy_id' => $ldyId]);
        }
        return $this->error('cannot get ldy_id');

    }


   public function add()
   {
       //从模板图片选择添加落地页
       $tpl = '';
       if ($params = $this->request->param()){
           if (isset($params['tpl'])){
               $tpl = $params['tpl'];
           }
       }
       $this->view->assign('tpl',$tpl);



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
     * 复制落地页功能（包括落地页信息、客服、文章、问答）
     * @param $ldyId 落地页id
     *
     */
    /** ---------复制落地页功能 Start----------**/
    public function ldyCopy($ldyId = null){
        if ($this->request->param('ids')){
            $ldyId = $this->request->param('ids');

//            var_dump($this->request->isPost());
            if ($this->request->isPost()){
                $ldyId = $this->request->post('ldy_id');

                //获取落地页信息
                $ldyMainList = \db('ldy_main')->where('id',$ldyId)->select();
                //获取落地页信息
                $ldyServerList = \db('ldy_server')->where('pid',$ldyId)->select();
                //获取文章信息
                $ldyDocList = \db('ldy_doc')->where('ldy_id',$ldyId)->select();

                $ldyMainData = [
                    'title' => $ldyMainList[0]['title'] . '-副本',
                    'sort' => $ldyMainList[0]['sort'],
                    'meta_title' => $ldyMainList[0]['meta_title'],
                    'keywords' => $ldyMainList[0]['keywords'],
                    'description' => $ldyMainList[0]['description'],
                    'template_lists' => $ldyMainList[0]['template_lists'],
                    'banner'=>$ldyMainList[0]['banner'],
                    'content' => $ldyMainList[0]['content'],
                ];


                //开启事务
                Db::startTrans();
                try{
                    //获取新增复制好的落地页的主键
                    $ldyId = Db::name('ldy_main')->insertGetId($ldyMainData);

                    //根据落地页id新增客服
                    $ldyServerData = $this->getLdyServerData($ldyId,$ldyServerList);
                    Db::name('ldy_server')->insertAll($ldyServerData);

                    //根据落地页id新增文章
                    $ldyDocData = $this->getLdyDocData($ldyId,$ldyDocList);
                    foreach ($ldyDocData as $ldyDocItem){
                        $data['nickname'] = $ldyDocItem['nickname'];
                        $data['ldy_id'] = $ldyId;
                        $data['description'] = $ldyDocItem['description'];
                        $data['photo'] = $ldyDocItem['photo'];

                        $oldDocId = $ldyDocItem['id'];
                        $newDocId = Db::name('ldy_doc')->insertGetId($data);

                        //根据doc_id新增文章详情
                        $ldyDocDetailData = $this->getLdyDocDetailData($newDocId,$oldDocId);
                        Db::name('ldy_doc_detail')->insertAll($ldyDocDetailData);

                        //根据doc_id新增问答(批量)
                        $ldyDocReplyData = $this->getLdyReplyData($newDocId,$oldDocId);
                        Db::name('ldy_doc_reply')->insertAll($ldyDocReplyData);
                    }

                    Db::commit();
                    $this->redirect("ldy_main/index");
                }catch (Exception $e){
                    //回滚
                    Db::rollback();
                    return json($e->getMessage());
                }
            }

            $this->view->assign('ldy_id',$ldyId);

            return $this->view->fetch();
        }
    }

    //需要创建的客服字段赋值
    public function getLdyServerData($ldyId,$ldyServerList){
        $ldyServerData = [];
        foreach ($ldyServerList as $ldyServer){
            $ldyServerData[] = [
                'pid' => $ldyId,
                'nickname' => $ldyServer['nickname'],
                'phone' => $ldyServer['phone'],
                'photo' => $ldyServer['photo'],
            ];
        }
        return $ldyServerData;
    }

    //需要创建的文章字段赋值
    public function getLdyDocData($ldyId,$ldyDocList){
        $ldyDocData = [];
        foreach ($ldyDocList as $ldyDoc){
            $ldyDocData[] = [
                'id' => $ldyDoc['id'],
                'nickname' => $ldyDoc['nickname'],
                'ldy_id' => $ldyId,
                'description' => $ldyDoc['description'],
                'photo' => $ldyDoc['photo'],
            ];
        }
        return $ldyDocData;
    }

    //需要创建的文章详细内容字段赋值
    public function getLdyDocDetailData($newDocId,$oldDocId){
        $detailList = \db('ldy_doc_detail')->where('doc_id',$oldDocId)->select();
        $ldyDocDetailData = [];
        foreach ($detailList as $detail){
            $ldyDocDetailData[] = [
                'doc_id' => $newDocId,
                'content' => $detail['content'],
            ];
        }
        return $ldyDocDetailData;
    }

    //需要创建的问答字段赋值
    public function getLdyReplyData($newDocId,$oldDocId){
        $replyList = \db('ldy_doc_reply')->where('doc_id',$oldDocId)->select();
        $ldyDocReplyData = [];
        foreach ($replyList as $Reply){
            $ldyDocReplyData[] = [
                'doc_id' => $newDocId,
                'a_nickname' => $Reply['a_nickname'],
                'photo' => $Reply['photo'],
                'q_nickname' => $Reply['q_nickname'],
                'content' => $Reply['content'],
            ];
        }
        return $ldyDocReplyData;
    }
    /** ---------复制落地页功能 End----------**/



}
