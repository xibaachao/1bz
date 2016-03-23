<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title></title>
	<link href="__PUBLIC__/Html/css/style.css" rel="stylesheet" type="text/css" />
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />

</head>

<body>
	<div class="kdj_index1_bg">
		<div id="d">
			<img src="__PUBLIC__/Html/img/c.png" width="100%" class="kdj_index1_bg_i1 kdj_index1_bg_hide" />
			<img src="__PUBLIC__/Html/img/b.png" width="100%" class="kdj_index1_bg_i2 kdj_index1_bg_show" />
		</div>
		<div class="kdj_index1_div2">
			<a href="javascript:go()"><img src="__PUBLIC__/Html/img/kz.png" class="kdj_index1_bg_i3"></a>
		</div>
		<div class="kdj_index1_div1">
			<a href="javascript:showw(1)"></a>
			<a href="javascript:showw(2)"></a>
		</div>
		<div class="kdj_show_div1" id="d1">
			<img src="__PUBLIC__/Html/img/gz1.png">
		</div>
		<div class="kdj_show_div1" id="d2">
			<img src="__PUBLIC__/Html/img/jp.png">
		</div>
	</div>
</body>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js">
</script>
<script>
	var t = setInterval("ch_show()", 1000);
	var man=0;
	function ch_show() {
		var temp = $("#d img");
		if ($(temp[0]).hasClass("kdj_index1_bg_hide")) {
			$(temp[0]).removeClass("kdj_index1_bg_hide");
			$(temp[0]).addClass("kdj_index1_bg_show");
			man=1;
		} else {
			$(temp[0]).removeClass("kdj_index1_bg_show");
			$(temp[0]).addClass("kdj_index1_bg_hide");
		}
		if ($(temp[1]).hasClass("kdj_index1_bg_hide")) {
			$(temp[1]).removeClass("kdj_index1_bg_hide");
			$(temp[1]).addClass("kdj_index1_bg_show");
			man=2;
		} else {
			$(temp[1]).removeClass("kdj_index1_bg_show");
			$(temp[1]).addClass("kdj_index1_bg_hide");
		}
	}

	function showw(a) {
		if (a == 1) {
			$("#d1").show();
		}
		if (a == 2) {
			$("#d2").show();
		}
	}
	$(".kdj_show_div1 img").on("click", function() {
		$(this).parent("div").hide();
	})
	function go(){
		window.location.href="__URL__/f2?man="+man;
	}
</script>

</html>