<?php

namespace app\admin\model;

use think\Model;


class LdyPicture extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $name = 'ldy_picture';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'uploadtime_text'
    ];
    

    



    public function getUploadtimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['uploadtime']) ? $data['uploadtime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }

    protected function setUploadtimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


}
