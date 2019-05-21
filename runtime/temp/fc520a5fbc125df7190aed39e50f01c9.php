<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:99:"/Applications/MAMP/htdocs/ldy_fastadmin/public/../application/admin/view/ldy_main/list_ldy_tpl.html";i:1558406912;s:82:"/Applications/MAMP/htdocs/ldy_fastadmin/application/admin/view/layout/default.html";i:1557794938;s:79:"/Applications/MAMP/htdocs/ldy_fastadmin/application/admin/view/common/meta.html";i:1557482264;s:81:"/Applications/MAMP/htdocs/ldy_fastadmin/application/admin/view/common/script.html";i:1557482264;}*/ ?>
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
                                <body>

<ul class="list">

<?php if(is_array($listLdyTpl) || $listLdyTpl instanceof \think\Collection || $listLdyTpl instanceof \think\Paginator): $i = 0; $__LIST__ = $listLdyTpl;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
            <li style="text-align: center">
                <img class="ldy_img" style="display: block; cursor:pointer" onmouseover="" onclick="add('<?php echo $v['id']; ?>','<?php echo $v['name']; ?>','<?php echo $v['tpl']; ?>')"
                     src="<?php echo $v['picture']; ?>" alt="点击以创建" title="立即使用">
                <span><?php echo $v['name']; ?></span>
                <!--<button onclick="dark(this)">立即使用</button>-->
            </li>
<?php endforeach; endif; else: echo "" ;endif; ?>

</ul>







<!--<div class="img_div">-->
    <!--<img src="/uploads/20190517/cbf327ca7c8062bd8770737431489fef.jpg"  width="200px" height="360px">-->

    <!--<a href="#">-->
        <!--<div class="mask">-->
            <!--<button onclick="alert('test')">使用该模板</button>-->
        <!--</div>-->
    <!--</a>-->
<!--</div>-->





<!--<ul class="list">-->
    <!--<li style="text-align: center">-->
        <!--<img style="display: block; cursor:pointer" onmouseover="dark(this)" onclick="alert('test')" src="/uploads/20190517/cbf327ca7c8062bd8770737431489fef.jpg" width="200px" height="360px">-->
        <!--<div>-->
            <!--<a href="#">-->
                <!--<div class="mask">-->
                    <!--<h3>A Picture of food</h3>-->
                <!--</div>-->
            <!--</a>-->
        <!--</div>-->

        <!--<span>落地页一</span>-->
    <!--</li>-->
    <!--<li style="text-align: center">-->
        <!--<img style="display: block" src="/uploads/20190517/cbf327ca7c8062bd8770737431489fef.jpg" width="200px" height="360px">-->
        <!--落地页二-->
    <!--</li>-->
    <!--<li style="text-align: center">-->
        <!--<img style="display: block" src="/uploads/20190517/cbf327ca7c8062bd8770737431489fef.jpg" width="200px" height="360px">-->
        <!--落地页三-->
    <!--</li>-->
    <!--<li style="text-align: center">-->
        <!--<img style="display: block" src="/uploads/20190517/cbf327ca7c8062bd8770737431489fef.jpg" width="200px" height="360px">-->
        <!--落地页四-->
    <!--</li>-->
    <!--<li style="text-align: center">-->
        <!--<img style="display: block" src="/uploads/20190517/cbf327ca7c8062bd8770737431489fef.jpg" width="200px" height="360px">-->
        <!--落地页五-->
    <!--</li>-->
    <!--<li style="text-align: center">-->
        <!--<img style="display: block" src="/uploads/20190517/cbf327ca7c8062bd8770737431489fef.jpg" width="200px" height="360px">-->
        <!--落地页六-->
    <!--</li>-->

   <!--</ul>-->
</body>
<script>

    function dark(x) {

        x.style.background="rgba(101, 101, 101, 0.6)";
    }

    function add(id,name,tpl) {

        Fast.api.open('/admin/ldy_main/add?id=' + id + '&name=' + name +'&tpl=' + tpl, "添加", {
            callback:function(value){
            }
        });
        // alert(data.innerHTML);

    }
    
    
</script>
<style>
    .list li{
        display:inline-block;
        margin: 30px;
    }
    .img_div {
        margin: 20px 400px 0 400px;
        position: relative;
        width: 200px;
        height: 360px;
    }
    .mask {
        position: absolute;
        top: 0;
        left: 0;
        width: 200px;
        height: 160px;
        background: rgba(101, 101, 101, 0.6);
        color: #ffffff;
        opacity: 0;
    }
    .mask h3 {
        text-align: center;
    }

    .img_div a:hover .mask {
        opacity: 1;
    }

    .ldy_img {
        width: 200px;
        height: 360px;
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