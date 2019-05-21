<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:91:"/Applications/MAMP/htdocs/ldy_fastadmin/public/../application/admin/view/ldy_main/edit.html";i:1558342558;s:82:"/Applications/MAMP/htdocs/ldy_fastadmin/application/admin/view/layout/default.html";i:1557794938;s:79:"/Applications/MAMP/htdocs/ldy_fastadmin/application/admin/view/common/meta.html";i:1557482264;s:81:"/Applications/MAMP/htdocs/ldy_fastadmin/application/admin/view/common/script.html";i:1557482264;}*/ ?>
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
                                <form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">


    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Title'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-title" data-rule="required" class="form-control" name="row[title]" type="text" value="<?php echo htmlentities($row['title']); ?>">
        </div>
    </div>
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('Pid'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-pid" data-rule="required" class="form-control" name="row[pid]" type="number" value="<?php echo htmlentities($row['pid']); ?>">-->
        <!--</div>-->
    <!--</div>-->
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Sort'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-sort" data-rule="required" class="form-control" name="row[sort]" type="number" value="<?php echo htmlentities($row['sort']); ?>">
        </div>
    </div>
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('List_row'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-list_row" data-rule="required" class="form-control" name="row[list_row]" type="text" value="<?php echo htmlentities($row['list_row']); ?>">-->
        <!--</div>-->
    <!--</div>-->
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Meta_title'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-meta_title" data-rule="required" class="form-control" name="row[meta_title]" type="text" value="<?php echo htmlentities($row['meta_title']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Keywords'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-keywords" data-rule="required" class="form-control" name="row[keywords]" type="text" value="<?php echo htmlentities($row['keywords']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Description'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-description" data-rule="required" class="form-control" name="row[description]" type="text" value="<?php echo htmlentities($row['description']); ?>">
        </div>
    </div>
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('Thumb_size'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-thumb_size" class="form-control" name="row[thumb_size]" type="text" value="<?php echo htmlentities($row['thumb_size']); ?>">-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('Template_index'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-template_index" data-rule="required" class="form-control" name="row[template_index]" type="text" value="<?php echo htmlentities($row['template_index']); ?>">-->
        <!--</div>-->
    <!--</div>-->
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Template_lists'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-template_lists" data-rule="required" data-source="LdyPicture/index" class="form-control selectpage"
                   name="row[template_lists]" type="text" value="<?php echo $row['template_lists']; ?>" data-field="tpl" data-primary-key="tpl">
        </div>
    </div>
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('Template_detail'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-template_detail" data-rule="required" class="form-control" name="row[template_detail]" type="text" value="<?php echo htmlentities($row['template_detail']); ?>">-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('Template_edit'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-template_edit" data-rule="required" class="form-control" name="row[template_edit]" type="text" value="<?php echo htmlentities($row['template_edit']); ?>">-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('Model'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-model" data-rule="required" class="form-control" name="row[model]" type="text" value="<?php echo htmlentities($row['model']); ?>">-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('Type'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-type" data-rule="required" class="form-control" name="row[type]" type="text" value="<?php echo htmlentities($row['type']); ?>">-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('Link'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-link" data-rule="required" class="form-control" name="row[link]" type="text" value="<?php echo htmlentities($row['link']); ?>">-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('Allow_publish'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-allow_publish" data-rule="required" class="form-control" name="row[allow_publish]" type="number" value="<?php echo htmlentities($row['allow_publish']); ?>">-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('Display'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-display" data-rule="required" class="form-control" name="row[display]" type="number" value="<?php echo htmlentities($row['display']); ?>">-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('Reply'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-reply" data-rule="required" class="form-control" name="row[reply]" type="number" value="<?php echo htmlentities($row['reply']); ?>">-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('Check'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-check" data-rule="required" class="form-control" name="row[check]" type="number" value="<?php echo htmlentities($row['check']); ?>">-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('Reply_model'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-reply_model" data-rule="required" class="form-control" name="row[reply_model]" type="text" value="<?php echo htmlentities($row['reply_model']); ?>">-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('Extend'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<textarea id="c-extend" class="form-control " rows="5" name="row[extend]" cols="50"><?php echo htmlentities($row['extend']); ?></textarea>-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('Create_time'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-create_time" data-rule="required" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[create_time]" type="text" value="<?php echo $row['create_time']?datetime($row['create_time']):''; ?>">-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('Update_time'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-update_time" data-rule="required" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[update_time]" type="text" value="<?php echo $row['update_time']?datetime($row['update_time']):''; ?>">-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('View'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-view" class="form-control" name="row[view]" type="number" value="<?php echo htmlentities($row['view']); ?>">-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('Status'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-status" data-rule="required" class="form-control" name="row[status]" type="number" value="<?php echo htmlentities($row['status']); ?>">-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('Icon'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-icon" data-rule="required" class="form-control" name="row[icon]" type="text" value="<?php echo htmlentities($row['icon']); ?>">-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('Is_inherit'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-is_inherit" class="form-control" name="row[is_inherit]" type="number" value="<?php echo htmlentities($row['is_inherit']); ?>">-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('Groups'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-groups" data-rule="required" class="form-control" name="row[groups]" type="text" value="<?php echo htmlentities($row['groups']); ?>">-->
        <!--</div>-->
    <!--</div>-->
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Banner'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-banner" data-rule="required" class="form-control" size="50" name="row[banner]" type="text" value="<?php echo htmlentities($row['banner']); ?>">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-banner" class="btn btn-danger plupload" data-input-id="c-banner" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="true" data-preview-id="p-banner"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-banner" class="btn btn-primary fachoose" data-input-id="c-banner" data-mimetype="image/*" data-multiple="true"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-banner"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-banner"></ul>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Content'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-content" class="editor" rows="5" name="row[content]" cols="50"><?php echo htmlentities($row['content']); ?></textarea>
        </div>
    </div>
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('Water_enable'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-water_enable" class="form-control" name="row[water_enable]" type="number" value="<?php echo htmlentities($row['water_enable']); ?>">-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('Water_path'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-water_path" class="form-control" name="row[water_path]" type="number" value="<?php echo htmlentities($row['water_path']); ?>">-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('Water_position'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-water_position" class="form-control" name="row[water_position]" type="number" value="<?php echo htmlentities($row['water_position']); ?>">-->
        <!--</div>-->
    <!--</div>-->
    <!--<div class="form-group">-->
        <!--<label class="control-label col-xs-12 col-sm-2"><?php echo __('New_win'); ?>:</label>-->
        <!--<div class="col-xs-12 col-sm-8">-->
            <!--<input id="c-new_win" class="form-control" name="row[new_win]" type="number" value="<?php echo htmlentities($row['new_win']); ?>">-->
        <!--</div>-->
    <!--</div>-->
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>