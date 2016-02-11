<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<!--[if IE 8]>
<html lang="zh_CN" class="ie8"> <![endif]-->

<!--[if IE 9]>
<html lang="zh_CN" class="ie9"> <![endif]-->

<!--[if !IE]><!-->
<html lang="zh_CN"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

    <meta charset="utf-8"/>

    <title>亿博智管理平台 | 登录</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>

    <meta content="" name="description"/>

    <meta content="" name="author"/>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->

    <link href="../Public/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <link href="../Public/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>

    <link href="../Public/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

    <link href="../Public/css/style-metro.css" rel="stylesheet" type="text/css"/>

    <link href="../Public/css/style.css" rel="stylesheet" type="text/css"/>

    <link href="../Public/css/style-responsive.css" rel="stylesheet" type="text/css"/>

    <link href="../Public/css/default.css" rel="stylesheet" type="text/css" id="style_color"/>

    <link href="../Public/css/uniform.default.css" rel="stylesheet" type="text/css"/>

    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL STYLES -->

    <link href="../Public/css/login.css" rel="stylesheet" type="text/css"/>

    <!-- END PAGE LEVEL STYLES -->

    <link rel="shortcut icon" href="../Public/image/favicon.ico"/>

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class="login">

<!-- BEGIN LOGO -->

<div class="logo">

    <img src="../Public/image/logo-big.png" alt=""/>

</div>

<!-- END LOGO -->

<!-- BEGIN LOGIN -->

<div class="content">

    <!-- BEGIN LOGIN FORM -->

    <form class="form-vertical login-form" method="post" action="<?php echo U('Index/loginOn');?>">

        <h3 class="form-title" style="text-align:center;">亿博智管理平台</h3>

        <div class="alert alert-error hide">

            <button class="close" data-dismiss="alert"></button>

            <span>请输入您的用户名及密码</span>

        </div>

        <div class="control-group">

            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->

            <label class="control-label visible-ie8 visible-ie9">Username</label>

            <div class="controls">

                <div class="input-icon left">

                    <i class="icon-user"></i>

                    <input class="m-wrap placeholder-no-fix" type="text" placeholder="Username" name="username"/>

                </div>

            </div>

        </div>

        <div class="control-group">

            <label class="control-label visible-ie8 visible-ie9">Password</label>

            <div class="controls">

                <div class="input-icon left">

                    <i class="icon-lock"></i>

                    <input class="m-wrap placeholder-no-fix" type="password" placeholder="Password" name="password"/>

                </div>

            </div>

        </div>

        <div class="form-actions">

            <label class="checkbox">

                <input type="checkbox" name="remember" value="1"/> 记住我

            </label>

            <button type="submit" class="btn green pull-right">

                登录 <i class="m-icon-swapright m-icon-white"></i>

            </button>

        </div>

    </form>

    <!-- END LOGIN FORM -->

</div>

<!-- END LOGIN -->

<!-- BEGIN COPYRIGHT -->

<div class="copyright">

    <?php echo date('Y');?> &copy; 成都亿博智科技有限公司

</div>

<!-- END COPYRIGHT -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

<!-- BEGIN CORE PLUGINS -->

<script src="../Public/js/jquery-1.10.1.min.js" type="text/javascript"></script>

<script src="../Public/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

<script src="../Public/js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>

<script src="../Public/js/bootstrap.min.js" type="text/javascript"></script>

<!--[if lt IE 9]>

<script src="../Public/js/excanvas.min.js"></script>

<script src="../Public/js/respond.min.js"></script>

<![endif]-->

<script src="../Public/js/jquery.slimscroll.min.js" type="text/javascript"></script>

<script src="../Public/js/jquery.blockui.min.js" type="text/javascript"></script>

<script src="../Public/js/jquery.cookie.min.js" type="text/javascript"></script>

<script src="../Public/js/jquery.uniform.min.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="../Public/js/jquery.validate.min.js" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../Public/js/app.js" type="text/javascript"></script>

<script src="../Public/js/login.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script>

    jQuery(document).ready(function () {

        App.init();

        Login.init();

    });

</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>