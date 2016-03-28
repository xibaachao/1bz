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
			<a href="javascript:void" onclick="chaoren()"><img src="__PUBLIC__/Html/img/c.png" width="100%" class="kdj_index1_bg_i1 kdj_index1_bg_hide" /></a>
			<a href="javascript:void" onclick="bianfuxia()"><img src="__PUBLIC__/Html/img/b.png" width="100%" class="kdj_index1_bg_i2 kdj_index1_bg_show" /></a>
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
	//选择超人
	function chaoren(){
		var temp = $("#d img");
		$(temp[0]).removeClass("kdj_index1_bg_hide");
		$(temp[0]).addClass("kdj_index1_bg_show");
		$(temp[1]).removeClass("kdj_index1_bg_show");
		man=1;
		clearTimeout(t);
	}
	//选着蝙蝠侠
	function bianfuxia(){
		var temp = $("#d img");
		$(temp[1]).removeClass("kdj_index1_bg_hide");
		$(temp[1]).addClass("kdj_index1_bg_show");
		$(temp[0]).removeClass("kdj_index1_bg_show");
		man=2;
		clearTimeout(t);
	}

	
	function ch_show() {
		var temp = $("#d img");
		if ($(temp[0]).hasClass("kdj_index1_bg_hide")) {
			$(temp[0]).removeClass("kdj_index1_bg_hide");
			$(temp[0]).addClass("kdj_index1_bg_show");
			
		} else {
			$(temp[0]).removeClass("kdj_index1_bg_show");
			$(temp[0]).addClass("kdj_index1_bg_hide");
		}
		if ($(temp[1]).hasClass("kdj_index1_bg_hide")) {
			$(temp[1]).removeClass("kdj_index1_bg_hide");
			$(temp[1]).addClass("kdj_index1_bg_show");
			
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
		if(man==0)
		{
			alert("请选择人物");
			
		}else{
			window.location.href="__URL__/f2?man="+man;
		}
	}
</script>

<script src="https://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>
<script>
	wx.config({
		debug: true,
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
		var title="可口可乐相约为蓝生活";
		var link="http://z-jc.cn";
		var imgUrl="http://z-jc.cn/share.jpg";
		var desc="除雾霾，洁大海，造绿地，我和可口可乐一起保卫地球。";
		wx.onMenuShareTimeline({
                title: "除雾霾，洁大海，造绿地，我和可口可乐一起保卫地球。", // 分享标题
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
            // wx.chooseCard({
            //   timestamp: "<?php echo ($signPackage["timestamp"]); ?>", // 卡券签名时间戳
            //     nonceStr: '<?php echo ($signPackage["nonceStr"]); ?>', // 卡券签名随机串
            //     cardSign: '<?php echo ($cardSign); ?>', // 卡券签名
            //   success: function (res) {
            //     res.cardList = JSON.parse(res.cardList);
            //     encrypt_code = res.cardList[0]['encrypt_code'];
            //     alert('已选择卡券：' + JSON.stringify(res.cardList));
            //     decryptCode(encrypt_code, function (code) {
            //       codes.push(code);
            //     });
            //   }
            // });
            var timestamp="<?php echo ($signPackage["timestamp"]); ?>";
            var cardSign="<?php echo ($cardSign); ?>";
            wx.addCard({
            	cardList: [
            	{
            		cardId: 'pCE2wv5zx_lrHDHnaJM0sCcipy-o',
            		cardExt: '{"code": "", "openid": "", '+'"timestamp": "'+timestamp+'", "signature":"'+cardSign+'"}'
            	}
            	],
            	success: function (res) {
            		alert('已添加卡券：' + JSON.stringify(res.cardList));
            	}
            });









            

        });


    </script>
    </html>