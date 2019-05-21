<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:93:"/Applications/MAMP/htdocs/ldy_fastadmin/public/../application/admin/view/ldy_picture/add.html";i:1558443592;s:82:"/Applications/MAMP/htdocs/ldy_fastadmin/application/admin/view/layout/default.html";i:1557794938;s:79:"/Applications/MAMP/htdocs/ldy_fastadmin/application/admin/view/common/meta.html";i:1557482264;s:81:"/Applications/MAMP/htdocs/ldy_fastadmin/application/admin/view/common/script.html";i:1557482264;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>
    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !$config['fastadmin']['multiplenav']): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <form id="add-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <!--<input type="hidden" id="c-picture" name="row[picture]" value=""/>-->
    <!--<div class="form-group">-->
        <!--<div class="ldypicture-avatar-container">-->
            <!--<span style="text-align: center">&#45;&#45;添加模板图片&#45;&#45;</span>-->
            <!--<img class="ldypicture-picture-img img-responsive img-circle plupload" src="" alt="">-->
            <!--<div class="ldypicture-avatar-text img-thumbnail">添加模板图片</div>-->
            <!--<button id="plupload-ldy-picture" class="plupload" data-input-id="c-picture"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button>-->
        <!--</div>-->
    <!--</div>-->

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2">模板图片:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-picture" data-rule="required" class="form-control" size="50" name="row[picture]" type="text" value="">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-picture" class="btn btn-danger plupload" data-input-id="c-picture" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="false" data-preview-id="p-picture"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-picture" class="btn btn-primary fachoose" data-input-id="c-picture" data-mimetype="image/*" data-multiple="false"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-picture"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-picture"></ul>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Name'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-name" data-rule="required" class="form-control" name="row[name]" type="text" value="">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Tpl'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-tpl" data-rule="required" class="form-control" name="row[tpl]" type="text" value="">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Uploadtime'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-uploadtime" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[uploadtime]" type="text" value="<?php echo date('Y-m-d H:i:s'); ?>">
        </div>
    </div>
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2">编辑器上传模板图片: </label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-picture" data-rule="required" class="editor" name="row[picture]" type="text" value="">-->
        <!--</div>-->
    <!--</div>-->
    <!---->
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
</form>


<style>
    .ldypicture-avatar-container {
        position: relative;
        width: 100px;
        margin: 0 auto;
    }

    .ldypicture-avatar-container .ldypicture-picture-img {
        width: 100px;
        height: 100px;
    }

    .ldypicture-avatar-container .ldypicture-avatar-text {
        display: none;
    }

    .ldypicture-avatar-container:hover .ldypicture-avatar-text {
        display: block;
        position: absolute;
        height: 100px;
        width: 100px;
        background: #444;
        opacity: .6;
        color: #fff;
        top: 0;
        left: 0;
        line-height: 100px;
        text-align: center;
    }

    .ldypicture-avatar-container button {
        position: absolute;
        top: 0;
        left: 0;
        width: 100px;
        height: 100px;
        opacity: 0;
    }
</style>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>