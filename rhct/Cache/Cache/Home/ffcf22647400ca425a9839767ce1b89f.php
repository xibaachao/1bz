<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>标题</title>
    <meta name="keywords" content=""/>
    <meta name="description" content=''/>
    <link rel="stylesheet" type="text/css" href="../Public/css/style.css">
    <link rel="stylesheet" type="text/css" href="../Public/css/animate.min.css">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
</head>
<style>
    .temp{margin-top: 107%; height: 10%; width: 100%;}
    .temp a{display: block;width: 50%; height: 100%;float: left}
</style>
<body style="width: 100%;height: 100%;">
<div id="show" style="width: 100%;height: 100%;background-color: rgba(0,0,0,0.5);position:absolute;z-index: 999;display: none" onclick="hhide()">
    <img src="../Public/images/8_02.png" style="float: right">
</div>
<div class="f7">
    <div style="margin-top: 38%;width: 100%">
        <img src="__PUBLIC__/upload/<?php echo ($shop["img"]); ?>" width="100%"/>
    </div>
    <div style="margin-top: 0%;width: 100%;background: url('../Public/images/7_03.png') no-repeat; background-size: 100% 100%;height: 15%">
        <a href="javascript:sshow()" style="display: block;width: 50%; height: 100%;float: left"></a>
        <a href="__URL__/f8?id=<?php echo ($shop["id"]); ?>" style="display: block;width: 50%; height: 100%;float: left"></a>
    </div>
</div>
</body>
<script type="text/javascript" src="../Public/js/zepto.min.js"></script>
<script>
    function sshow(){
        $("#show").show();
    }
    function hhide(){
        $("#show").hide();
    }

</script>
</html>