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
				<a href="__URL__/f5"><img src="__PUBLIC__/Html/img/<?php echo ($temp); ?>"></a>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="__PUBLIC__/Html/js/jquery-1.8.3.min.js"></script>
	<script language="javascript">
		function animate(){			
			$(".charts").width("<?php echo ($time); ?>0%");
		}
		animate();
	</script>

</html>