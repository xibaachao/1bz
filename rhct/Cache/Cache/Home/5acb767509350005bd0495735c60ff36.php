<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>标题</title>
    <meta name="keywords" content=""/>
    <meta name="description" content=''/>
    <link rel="stylesheet" type="text/css" href="../Public/css/style.css">
    <link rel="stylesheet" type="text/css" href="../Public/css/style2.css">
    <link rel="stylesheet" type="text/css" href="../Public/css/animate.min.css">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
</head>
<style>
    .temp{margin-top: 155%; height: 10%; width: 100%;}
    .temp a{display: block;width: 100%; height: 100%;float: left}
    .input{background-color:Transparent;width:50%;position: absolute;left: 26%;top: 20%;color: #fff;border: 0px;font-size: 16px;}
    .input1{background-color:Transparent;width:50%;position: absolute;left: 26%;top:27%;color: #fff;border: 0px;font-size: 16px;}
    .regular-radio + label{position: absolute}
    .l1{left: 20%;top: 41%;}
    .l2{left: 42%;top: 41%;}
    .l3{left: 65%;top: 41%;}

</style>
<body >
<div class="f8">
        <form>
            <input type="text" name="name" class="input">
            <input type="text" name="phone" class="input1">
            <input type="radio" id="radio-1-4" name="ly" class="regular-radio">
            <label class="l1" for="radio-1-4"></label>
            <input type="radio" id="radio-1-5" name="ly" class="regular-radio">
            <label class="l2" for="radio-1-5"></label>
            <input type="radio" id="radio-1-6" name="ly" class="regular-radio">
            <label class="l3" for="radio-1-6"></label>
            <div class="temp"><a href="javascript:xxx()"></a></div>
        </form>
</div>
</body>
<script type="text/javascript" src="../Public/js/zepto.min.js"></script>
<script>
    function xxx(){
        var da=$("form").serialise();
        $.ajax({
            type: "POST",
            url: "__URL__/sj",
            data: da,
            success: function(msg){
               if(msg==1)
               {
                   alert("保存成功！");
               }
            }
        });
    }
</script>
</html>