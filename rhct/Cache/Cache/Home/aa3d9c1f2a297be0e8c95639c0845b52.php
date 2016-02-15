<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>标题</title>
	<meta name="keywords" content=""/>
	<meta name="description" content=''/>
	<link rel="stylesheet" type="text/css" href="../Public/css/style.css">
	<link rel="stylesheet" type="text/css" href="../Public/css/animate.min.css">
	<link rel="stylesheet" type="text/css" href="../Public/css/swiper.min.css">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<style type="text/css">
		.div1 img{width: 100%;}
		#div1 {
			animate-duration: 2s;    //动画持续时间
		animate-delay: 2s;    //动画延迟时间
		animate-iteration-count: 1;    //动画执行次数
		}
		.swiper-container{width: 90%; height: 65%}
		.swiper-wrapper{width: 100%;}
		.swiper-slide{width: 100%; text-align: center;}
		.swiper-slide img{width: 50%; margin-top: 50%;}
		.logo{width: 100%; text-align: center}
		.logo img{width: 15%}
	</style>
</head>
<body >
	<div class="f3_bg">
		<div class="div1">
			<img id="div1" src="../Public/images/3_01.png" class="animated rotateIn">
		</div>
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<div class="swiper-slide"><img src="../Public/images/3_03.png"> </div>
				<div class="swiper-slide"><img src="../Public/images/3_03.png"></div>
				<div class="swiper-slide"><img src="../Public/images/3_03.png"></div>
			</div>
			<!-- Add Pagination -->
			<div class="swiper-pagination"></div>
			<!-- Add Arrows -->
			<div class="swiper-button-next" style="background-image:url('../Public/images/3_09.png');background-size:100% 100%;width: 44px;height: 44px;"></div>
			<div class="swiper-button-prev" style="background-image:url('../Public/images/3_06.png');background-size:100% 100%;width: 44px;height: 44px;"></div>
		</div>
		<div class="logo">
			<img src="../Public/images/3_07.png">
		</div>
	</div>
</body>
<script type="text/javascript" src="../Public/js/zepto.min.js"></script>
<script type="text/javascript" src="../Public/js/swiper.min.js"></script>
<script>
	var swiper = new Swiper('.swiper-container', {
		pagination: '.swiper-pagination',
		paginationClickable: '.swiper-pagination',
		nextButton: '.swiper-button-next',
		prevButton: '.swiper-button-prev',
		spaceBetween: 30
	});
</script>
</html>