<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<title></title>
		<link href="__PUBLIC__/Html/css/style.css" rel="stylesheet" type="text/css" />
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
	</head>

	<body style="height: 100%; width: 100%;">
		<div class="index4-div-bg">
			<div class="index4-div1">
				<span id="no"><?php echo ($time); ?></span><span>S</span>
			</div>
			<div class="votebox" style="margin:0px auto 0 auto">
				<dl class="barbox">
					<dd class="barline">
						<div w="100" style="width:0px;" class="charts"></div>
					</dd>
				</dl>
			</div>
			<div class="index4-div2">
				<img src="__PUBLIC__/Upload/<?php echo ($one["img"]); ?>">
			</div>
			<div class="index4-div3">
				<a href="javascript:go()"><img src="__PUBLIC__/Html/img/32_07.png"></a>
			</div>
		</div>
		<div style="display: none;">
			<script src="http://s95.cnzz.com/z_stat.php?id=1257184940&web_id=1257184940" language="JavaScript"></script>
		</div>
	</body>
	<script type="text/javascript" src="__PUBLIC__/Html/js/jquery-1.8.3.min.js"></script>
	<script language="javascript">
		function animate(){			
			$(".charts").width("<?php echo ($time); ?>0%");
		}
		animate();
		function go(){
			window.location.href="__URL__/temp?time=<?php echo ($time); ?>&id=<?php echo ($one["id"]); ?>"; 
		}
	</script>

</html>