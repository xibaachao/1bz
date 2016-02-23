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
		#xz{
			-webkit-animation-duration: 3s;
			-webkit-animation-delay: 1s;
			-webkit-animation-iteration-count: 1;
		}
		#xx1{
			-webkit-animation-duration: 4s;
			-webkit-animation-delay: 2s;
			-webkit-animation-iteration-count: 1;
		}
		#xx2{
			-webkit-animation-duration: 4s;
			-webkit-animation-delay: 2s;
			-webkit-animation-iteration-count: 1;
		}
		#xx3{
			-webkit-animation-duration: 4s;
			-webkit-animation-delay: 2s;
			-webkit-animation-iteration-count: 1;
		}
		#xx4{
			-webkit-animation-duration: 4s;
			-webkit-animation-delay: 2s;
			-webkit-animation-iteration-count: 1;
		}
		#last{
			-webkit-animation-duration: 6s;
			-webkit-animation-delay: 1s;
			-webkit-animation-iteration-count: 1;
		}
		img{border: 0px;display:block;}
	</style>
</head>
<body>
	<div class="index_bg">
		<div style="width:100%" id="ee">
			<img src="../Public/images/index_logo_01.png" width="100%" class="animated bounceInUp">
		</div>
		<div style="width:50%; float:left;margin:0px; padding:0px;">	
			<img id="xx1" src="../Public/images/eleme-1_02_01.png" width="100%" style="margin:0px; padding:0px;" hspace="0" vspace="0" class="animated ">
		</div>
		<div style="width:50%;margin:0px; padding:0px;float:left;" >
			<img id="xx2" src="../Public/images/eleme-1_02_02.png" width="100%" style="margin:0px; padding:0px;" hspace="0" vspace="0" class="animated ">
		</div>
		<div style="width:50%; float:left">
			<img id="xx3" src="../Public/images/eleme-1_02_03.png" width="100%" style="margin:0px; padding:0px;" hspace="0" vspace="0" class="animated ">
		</div>
		<div style="width:50%;float:left;">
			<img id="xx4" src="../Public/images/eleme-1_02_04.png" width="100%" style="margin:0px; padding:0px;" hspace="0" vspace="0" class="animated ">
		</div>
		<div style="width:80%;margin:0px auto;margin-top:10px;">
			<a href="__URL__/f2"><img src="../Public/images/tj_06.png" width="100%" class="animated swing" id="xz" /></a>
		</div>
		<div style="width:80%;margin:0px auto;margin-top:10px;">
			<img src="../Public/images/bu_09.png" width="100%" class="animated fadeInUp" id="last" />
		</div>
	</div>
	<div style="display:none">
		<script src="http://s95.cnzz.com/z_stat.php?id=1257184940&web_id=1257184940" language="JavaScript"></script>
	</div>
</body>
<script type="text/javascript" src="../Public/js/zepto.min.js"></script>
<script type="text/javascript">
$(function(){
		var w=window.screen.width;
	    $(".index_bg").css("widht",w+"px");
		var h=window.screen.height;
		$(".index_bg").css("height",h+"px");
		$("#ee").css("widht",w+"px");
		aa();
	})
	function aa()
	{
		$("#xx1").addClass("fadeInDown");
		$("#xx2").addClass("fadeInRight");
		$("#xx3").addClass("fadeInLeft");
		$("#xx4").addClass("fadeInUp");
	}

</script>
</html>