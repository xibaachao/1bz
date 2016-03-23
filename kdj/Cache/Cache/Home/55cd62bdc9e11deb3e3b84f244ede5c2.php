<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title></title>
	<link href="__PUBLIC__/Html/css/style.css" rel="stylesheet" type="text/css" />
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
</head>
<body>
	<div class="kdj_index2_div1">
		<img src="__PUBLIC__/Html/img/P2_01.png"/>
	</div>
	<div class="kdj_index2_div2">
		<div class="nl">
			<span id="nl">0</span>
		</div>
		<div class="miao">
			<span id="miao">10</span>
		</div>
		<div class="dj1" id="temp">
			
		</div>
		<div class="dj"></div>
	</div>
</body>
<script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript">
	var t;
	var no=parseInt($("#miao").text());
	$(function(){
	// 游戏开始
	$(".dj").on("click",function(){
		$(".dj1").on("click",function(){
			dj();
		})
		t=setInterval("pandu()", 1000);
	})	
})

	function dj(){
		$("#temp").append('<img src="__PUBLIC__/Html/img/dj.png" class="img">');
		temp=parseInt($("#nl").text());		
		if(no>0)
		{	temp=temp+1;	
			$("#nl").text(temp);
			if($(".kdj_index2_div1 img").attr("src")=='__PUBLIC__/Html/img/P3_01.png')
			{
				$(".kdj_index2_div1 img").attr("src","__PUBLIC__/Html/img/P4_01.png")
			}else{
				$(".kdj_index2_div1 img").attr("src","__PUBLIC__/Html/img/P3_01.png")
			}
		}else{
			if(temp>35)
			{
				$(".kdj_index2_div1 img").attr("src","__PUBLIC__/Html/img/P5_01.png")
				setTimeout('ok()',2000); 
			}else{
				$(".kdj_index2_div1 img").attr("src","__PUBLIC__/Html/img/P5_01.png")
				setTimeout('nono()',2000); 
			}
		}
}
//判断时间
function pandu(){
	
	if (no==0) {
		clearInterval(t);
		temp=parseInt($("#nl").text());	
		if(temp>35)
			{
				$(".kdj_index2_div1 img").attr("src","__PUBLIC__/Html/img/P5_01.png")
				setTimeout('ok()',2000); 
			}else{
				$(".kdj_index2_div1 img").attr("src","__PUBLIC__/Html/img/P5_01.png")
				setTimeout('nono()',2000); 
			}	
	}else{
		no=no-1;
	}
	$("#miao").text(no);
}

function ok(){
	window.location.href="__URL__/f4";
}

function nono(){
	window.location.href="__URL__/f3";
}
</script>
</html>