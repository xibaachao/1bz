<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
		<link href="__PUBLIC__/Html/css/style.css" rel="stylesheet" type="text/css" />
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />		
	</head>

	<body style="height: 100%; width: 100%;">
	<div id="show" style="width: 100%;height: 100%;background-color: rgba(0,0,0,0.5);position:absolute;z-index: 999;display: none" onclick="hhide()">
    <img src="__PUBLIC__/Html/img/fx.png" style="float: right;width: 100%;height: 100%">
</div>
		<div class="index-div-bgg">
			<a href="javascript:sshow()"></a>
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
    </script>
</html>