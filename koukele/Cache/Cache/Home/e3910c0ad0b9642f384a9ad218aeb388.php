<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
<meta charset="utf-8" />
<title></title>
<link href="__PUBLIC__/Html/css/style.css" rel="stylesheet"
	type="text/css" />
<meta name="viewport"
	content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
</head>

<body style="height: 100%; width: 100%;">
<div id="show" style="width: 100%;height: 100%;background-color: rgba(0,0,0,0.5);position:absolute;z-index: 999;display: none" onclick="hhide()">
    <img src="__PUBLIC__/Html/img/fx.png" style="float: right;width: 100%;height: 100%">
</div>
	<div class="index5-div-bg">
		<div class="index5-div1">
			<img src="__PUBLIC__/Upload/<?php echo ($one["img"]); ?>">
		</div>
		<div class="index5-div2">
			<form action="">
			<input type="hidden" name="prize_id" value="<?php echo ($one["id"]); ?>"/>
			<input name="name" type="text" class="index5-input1" /> 
			<input name="iphone" type="phone" class="index5-input2" />
			<input type="text" name="address" class="index5-input3" />
			</form>
		</div>
		<div class="index5-div3">
			<a href="javascript:sub()"><img
				src="__PUBLIC__/Html/img/61_09.png"></a>
		</div>
	</div>
	<div style="display: none;">
			<script src="http://s95.cnzz.com/z_stat.php?id=1257184940&web_id=1257184940" language="JavaScript"></script>
		</div>
</body>
<script type="text/javascript" src="__PUBLIC__/Html/js/jquery-1.8.3.min.js"></script>
<script>
    function sshow(){
        $("#show").show();
    }
    function hhide(){
        $("#show").hide();
    }
	$(function(){
		var temp="<?php echo ($user["openid"]); ?>";
		if(temp!="")
		{
			alert("亲！今天已参加过活动，请明天再来！");
			window.location.href="__URL__/f1";
		}
	})

	function sub() {
		if ($("input[name='name']").val() == "") {
			alert("请输入姓名");
			return false;
		}
		re = /^1\d{10}$/;
		if (re.test($("input[name='iphone']").val())) {

		} else {
			alert("请输入正确的电话号码");
			return false;
		}
		if ($("input[name='address']").val() == "") {
			alert("请输入地址");
			return false;
		}
		 var da=$("form").serialize();
		 $.ajax({
	            type: "POST",
	            url: "__URL__/update",
	            data: da,
	            success: function(msg){
	               if(msg==1)
	               {
	                   alert("此电话已参加过活动！");
	                   sshow();
	                   
	               }else if(msg==2)
	               {
	               		alert("亲！今天已参加过活动，请明天再来！");
	               		sshow();
	               }else if(msg==3)
	               {
	            	   alert("提交成功");
	            	   sshow();
	            	}
	            }
	        });

	}
</script>
</html>