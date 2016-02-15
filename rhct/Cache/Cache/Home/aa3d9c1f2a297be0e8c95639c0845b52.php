<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Swiper demo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

	<!-- Link Swiper's CSS -->
	<link rel="stylesheet" href="../Public/css/swiper.min.css">

	<!-- Demo styles -->
	<style>
		html, body {
			position: relative;
			height: 100%;
		}
		body {
			background: #eee;
			font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
			font-size: 14px;
			color:#000;
			margin: 0;
			padding: 0;
		}
		.swiper-container {
			width: 100%;
			height: 100%;
		}
		.swiper-slide {
			text-align: center;
			font-size: 18px;
			background: #fff;

			/* Center slide text vertically */
			display: -webkit-box;
			display: -ms-flexbox;
			display: -webkit-flex;
			display: flex;
			-webkit-box-pack: center;
			-ms-flex-pack: center;
			-webkit-justify-content: center;
			justify-content: center;
			-webkit-box-align: center;
			-ms-flex-align: center;
			-webkit-align-items: center;
			align-items: center;
		}
		.swiper-slide a{display: block;width: 50%; height: 30%;}
	</style>
</head>
<body>
<!-- Swiper -->
<div class="swiper-container">
	<div class="swiper-wrapper">
		<div class="swiper-slide" style="background: url('../Public/images/3.gif');background-size: 100% 100%">
			<a href="__URL__/f4"></a>
		</div>
		<div class="swiper-slide" style="background: url('../Public/images/4.gif');background-size: 100% 100%">
			<a href="__URL__/f5"></a>
		</div>
		<div class="swiper-slide" style="background: url('../Public/images/5.gif');background-size: 100% 100%">
			<a href="__URL__/f6"></a>
		</div>
	</div>
	<!-- Add Pagination -->
	<div class="swiper-pagination"></div>
</div>

<!-- Swiper JS -->
<script src="../Public/js/swiper.min.js"></script>

<!-- Initialize Swiper -->
<script>
	var swiper = new Swiper('.swiper-container', {
		pagination: '.swiper-pagination',
		paginationClickable: true
	});
</script>
</body>
</html>