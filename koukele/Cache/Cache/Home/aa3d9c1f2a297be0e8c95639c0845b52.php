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
	<div class="index3-div-bg">
		<div class="index4-div1">
			<span id="no">8</span><span>S</span>
		</div>
		<div class="votebox" style="margin: 0px auto 0 auto;margin-top: 2%">
			<dl class="barbox">
				<dd class="barline">
					<div w="100" style="width: 0px;" class="charts"></div>
				</dd>
			</dl>
		</div>
		<div class="index3-div1" id="goup1">
			<img src="__PUBLIC__/Html/img/a.png" class="aa"><img class="aa" src="__PUBLIC__/Html/img/a.png"><img class="aa" src="__PUBLIC__/Html/img/a.png"><img class="aa" src="__PUBLIC__/Html/img/a.png"><img  class="aa" src="__PUBLIC__/Html/img/a.png"><img class="aa" src="__PUBLIC__/Html/img/a.png">
		</div>
		<div class="index3-div2" id="goup2">
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><img src="__PUBLIC__/Upload/<?php echo ($vo["img"]); ?>" achao="<?php echo ($key); ?>" /><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>

	</div>
	<div style="display: none;">
			<script src="http://s95.cnzz.com/z_stat.php?id=1257184940&web_id=1257184940" language="JavaScript"></script>
		</div>
</body>
<script type="text/javascript"
	src="__PUBLIC__/Html/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Html/js/Sortable.js"></script>
<script>
	var foo = document.getElementById("goup1");
	new Sortable.create(foo, { group: "omega",
		onUpdate: function (evt/**Event*/){

 		 }

	 });
	var bar = document.getElementById("goup2");
	new Sortable(bar, {
		group : "omega",
		onUpdate : function(evt) {
				
		}
	});

	function animate() {
		$(".charts").each(function(i, item) {
			var a = parseInt($(item).attr("w"));
			$(item).animate({
				width : a + "%"
			},9000);
		});
	}
	animate();
	var t = setInterval("reduce()", 1000);
	var t1 = setInterval("ok()", 100);	
	function reduce() {
		var no = parseInt($("#no").text());
		if (no == 0) {
			clearTimeout(t1);
			clearTimeout(t);
			alert("时间到");
			window.location.href="__URL__/f1";			
		} else {
			$("#no").text(no - 1);
		}
	}
	$(function() {
		var obox = document.getElementById("goup2");
		var cloneBox = obox.cloneNode(true);
		var lis = [];
		for (var index = 0; index < cloneBox.children.length; index++) {
			lis.push((cloneBox.children)[index]);
		}

		var obt = document.getElementById("bt");
		function rnd(a, b) {
			return Math.random() > 0.5 ? -1 : 1;
		}
		obox.innerHTML = "";
		var newArray = lis.sort(rnd);
		for (var i = 0, l = newArray.length; i < l; i++) {
			obox.appendChild(newArray[i].cloneNode(true));
		}

	})
	//判断是否拼接成功
	function ok(){
		var temp=$("#goup1 img").length;
		if (temp>6) {

			$(".aa:last").remove();
		}
		
		$("#goup1 img").each(function(i){
			if(parseInt($(this).attr("achao"))==i)
			{	
				if(i==5)
				{
					clearTimeout(t1);
					window.location.href="__URL__/f4?time="+$("#no").text()+"&id=<?php echo ($one["id"]); ?>"; 
				}
			}else{
				return false;	
			}
		})
	}
</script>

</html>