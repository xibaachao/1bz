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
		#t{
			-webkit-animation-duration: 6s;
			-webkit-animation-delay: 1s;
			-webkit-animation-iteration-count: infinite;
		}
		#t1{
			-webkit-animation-duration: 2s;
			-webkit-animation-delay: 1s;
			-webkit-animation-iteration-count: 1;
		}
		#t2{
			-webkit-animation-duration: 2s;
			-webkit-animation-delay: 0s;
			-webkit-animation-iteration-count: 1;
		}
	</style>
</head>
<body>
	<div class="index_bg">
		<div style="position: absolute;top:0px;width:100%;left:-1000px;" id="tt">
			<img src="../Public/images/eleme-2_01.png" width="100%"  id="t">
		</div>
		<div style="position: absolute;top:0px;width:100%">
			<img src="../Public/images/1.png" style="float:right" width="40%" class="animated fadeInUp" id="t1">
		</div>
		<div style="position: absolute;top:30%;">
			<img src="../Public/images/eleme-2_02.png" width="100%" class="animated slideInLeft" id="t2"><!--pulse-->
		</div>
		<div style="position: absolute;bottom:0px;">
			<img src="../Public/images/eleme-2_03.png" width="100%">
			<a href="__URL__/f3?aa=1" style="display:block;width:33%; height:100%;position: absolute;top:0px;"></a>
			<a href="__URL__/f3?aa=2" style="display:block;width:33%; height:100%;position: absolute;top:0px;left:33%"></a>
			<a href="__URL__/f3?aa=3" style="display:block;width:33%; height:100%;position: absolute;top:0px;left:66%"></a>
		</div>
	</div>
		<div style="display:none">
		<script src="http://s95.cnzz.com/z_stat.php?id=1257184940&web_id=1257184940" language="JavaScript"></script>
	</div>
</body>
<script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript">
	$(function(){
		$("#tt").animate({
			left:"0px",
		  },2000);
		$("#tt img").addClass("shake");
		

	})
	var myVar=setTimeout(function(){
	$("#t2").removeClass("slideInLeft");
			$("#t2").addClass("pulse");
		},2600);
</script>
</html>