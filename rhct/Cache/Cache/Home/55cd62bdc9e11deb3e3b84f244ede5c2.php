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
	<style type="text/css">
		.div1 img{width: 100%;}
		#div1 {
			animate-duration: 2s;    //动画持续时间
		animate-delay: 2s;    //动画延迟时间
		animate-iteration-count: 1;    //动画执行次数
		}
	</style>
</head>
<body >
	<div class="f2_bg">
		<div class="div1">
			<img id="div1" class="animated rotateIn" src="../Public/images/2_01.png">
		</div>
		<div class="div1" style="text-align: center">
			<img src="../Public/images/2_031.png" style="width: 30%"/>
		</div>
		<div class="div1">
			<a href="__URL__/f3"><img src="../Public/images/2_02.png"></a>
		</div>
		<div class="div1">
			<a href="__URL__/f3"><img src="../Public/images/2_03.png"></a>
		</div>
		<div class="div1">
			<a href="__URL__/f3"><img src="../Public/images/2_06.png"></a>
		</div>
	</div>
</body>
<script type="text/javascript" src="../Public/js/zepto.min.js"></script>

</html>