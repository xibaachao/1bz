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
		.div2 img{width: 20%;float: right}
		#div2 {
			animate-duration: 2s;    //动画持续时间
			animate-delay: 2s;    //动画延迟时间
			animate-iteration-count: 1;    //动画执行次数
		}
		.div3{margin-top: 80%}
		.div3 img{width: 100%}
	</style>
</head>
<body >
	<div class="fi_bg">
		<div class="div1">
			<img src="../Public/images/1_01.png"/>
		</div>
		<div class="div2">
			<img id="div2" class="animated rotateIn" src="../Public/images/1_04.png"/>
		</div>
		<div class="div3">
			<a href="__URL__/f2"><img src="../Public/images/bu_02.png"/></a>
		</div>
	</div>
</body>
<script type="text/javascript" src="../Public/js/zepto.min.js"></script>

</html>