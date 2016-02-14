<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>拼喵计划</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<link href="../Public/css/css.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="../Public/css/swiper.min.css">
	<script type="text/javascript" src="http://libs.useso.com/js/jquery/1.8.0/jquery-1.8.0.min.js"></script>
	<script src="../Public/js/swiper.min.js"></script>
</head>
<body>
    <span id="bb"></span>
    <div class="ww no" id="no">
        <img alt="" src="../Public/images/c_03.png">
    </div>
	<div class="jp no" id="jp" onclick="close_jp()">
		<img alt="" src="../Public/images/08_01_03.png" style="margin-top:30%">
		<a href="__URL__/baoming"></a> <a href="__URL__/index"></a>
	</div>
	<div class="ww no" id="ww" onclick="close_ww()">
		<img alt="" src="../Public/images/08_03.png" style="margin-top:30%">
		<a href="__URL__/baoming"></a> <a href="__URL__/index"></a>
	</div>
	<div class="vote_div1">
        <img src="../Public/images/08_01_0113_03.png" class="no">
	</div>
	<div class="vote_img">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php if(!empty($one["img1"])): ?><div class="swiper-slide" style="width:310px"><img src="<?php echo ($one["img1"]); ?>" width="100%"></div><?php endif; ?>
				<?php if(!empty($one["img2"])): ?><div class="swiper-slide" style="width:310px"><img src="<?php echo ($one["img2"]); ?>" width="100%"></div><?php endif; ?>
				<?php if(!empty($one["img3"])): ?><div class="swiper-slide" style="width:310px"><img src="<?php echo ($one["img3"]); ?>" width="100%"></div><?php endif; ?>
				<?php if(!empty($one["img4"])): ?><div class="swiper-slide" style="width:310px"><img src="<?php echo ($one["img4"]); ?>" width="100%"></div><?php endif; ?>
			</div>
			<h4><?php echo ($one["name"]); ?></h4>
			<h5>上传作者：<?php echo ($one["people"]); ?></h5>
            <p align="center" style="margin:15px;"><?php echo ($one["xy"]); ?></p>
			<p align="center" style="font-size:12px;color:#f3982a"><img src="../Public/images/07_04.gif" width="12px;">&nbsp;<?php echo ($one["vote"]); ?></p>
			<p align="center" onclick="getvote()"><img src="../Public/images/01_13.png"></p>
		</div>
	</div>

	<script>
		var swiper = new Swiper('.swiper-container');
	</script>
	<div class="footer">
	<a href="__URL__/index" class="lf"></a>
	<a href="__URL__/baoming" class="lr"></a>
</div>
</body>
</html>
	<script type="text/javascript">
		function getvote(){
			var cat_id="<?php echo ($one["id"]); ?>";
			$.ajax({
				type: "POST",
				url: "__URL__/vote",
				data: {cat_id:cat_id},
				success: function(msg){
					if(msg==0)
					{
						show_jp();
					}
					if(msg==2)
					{
						alert("发生错误!");
					}
					if (msg==1) {
						show_ww();
					}
                    if(msg==-1)
                    {
                        show_no();
                    }
				}
			});
		}
		function show_jp(){
            location.hash="#bb";
            $(".vote_div1 img").show();
            location.hash="#bb";
			$("#jp").show();            
            
		}
		function close_jp(){
            location.hash="#bb";
            $(".vote_div1 img").hide();
			$("#jp").hide();
		}
		function show_ww(){
            location.hash="#bb";
            $(".vote_div1 img").show();             
			$("#ww").show();
		}
		function close_ww(){
            window.location.reload();
			 $("#ww").hide();
             $(".vote_div1 img").hide();
			
		}
        function show_no(){
             $("#no").show();
             $(".vote_div1 img").hide();
        }


	</script>
	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script>
        wx.config({
            debug: false,
            appId: '<?php echo ($signPackage["appId"]); ?>',
            timestamp: "<?php echo ($signPackage["timestamp"]); ?>",
            nonceStr: '<?php echo ($signPackage["nonceStr"]); ?>',
            signature: '<?php echo ($signPackage["signature"]); ?>',
            jsApiList: [
                'checkJsApi',
                'onMenuShareTimeline',
                'onMenuShareAppMessage',
                'onMenuShareQQ',
                'onMenuShareWeibo',
                'hideMenuItems',
                'showMenuItems',
                'hideAllNonBaseMenuItem',
                'showAllNonBaseMenuItem',
                'translateVoice',
                'startRecord',
                'stopRecord',
                'onRecordEnd',
                'playVoice',
                'pauseVoice',
                'stopVoice',
                'uploadVoice',
                'downloadVoice',
                'chooseImage',
                'previewImage',
                'uploadImage',
                'downloadImage',
                'getNetworkType',
                'openLocation',
                'getLocation',
                'hideOptionMenu',
                'showOptionMenu',
                'closeWindow',
                'scanQRCode',
                'chooseWXPay',
                'openProductSpecificView',
                'addCard',
                'chooseCard',
                'openCard'
            ]
        });
        wx.ready(function () {
            var title="拼喵计划";
            var link="http://mjhd.1bz.cc/index.php/Index/getvote?id=<?php echo ($one["id"]); ?>";
            var imgUrl="http://mjhd.1bz.cc/<?php echo ($one["img1"]); ?>";
            var desc='"<?php echo ($one["people"]); ?>"家的"<?php echo ($one["name"]); ?>"赏了Ta一张靓照，喵了个咪的，让我看看';
            wx.onMenuShareTimeline({
                title: title, // 分享标题
                link: link, // 分享链接
                imgUrl: imgUrl, // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });
            wx.onMenuShareAppMessage({
                title: title, // 分享标题
                desc: desc, // 分享描述
                link: link, // 分享链接
                imgUrl: imgUrl, // 分享图标
                type: '', // 分享类型,music.video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () {
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });
            wx.onMenuShareQQ({
                title: title, // 分享标题
                desc: desc, // 分享描述
                link: link, // 分享链接
                imgUrl: imgUrl, // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });
            wx.onMenuShareWeibo({
                title: title, // 分享标题
                desc: desc, // 分享描述
                link: link, // 分享链接
                imgUrl: imgUrl, // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });



        });
    </script>