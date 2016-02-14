<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang='zh-CN'>
<head>
<meta charset="utf-8" />
<title>投票记录</title>
<link href="../Public/css/bootstrap.min.css" rel="stylesheet"
	type="text/css" />

<link href="../Public/css/bootstrap-responsive.min.css" rel="stylesheet"
	type="text/css" />

<link href="../Public/css/font-awesome.min.css" rel="stylesheet"
	type="text/css" />

<link href="../Public/css/style-metro.css" rel="stylesheet"
	type="text/css" />

<link href="../Public/css/style.css" rel="stylesheet" type="text/css" />

<link href="../Public/css/style-responsive.css" rel="stylesheet"
	type="text/css" />

<link href="../Public/css/default.css" rel="stylesheet" type="text/css"
	id="style_color" />

<link href="../Public/css/uniform.default.css" rel="stylesheet"
	type="text/css" />
</head>
<body
	style="background-color: #fff !important; margin: 20px !important;">
	<div class="page-container row-fluid">
		<div class='btn-group '>
			<h3>投票记录</h3>
		</div>
		<hr style='margin-top: 0px' />

		<div style='margin: 4px 0px;'>
			<form method='get'>
				<input type='text' class="m-wrap" name='keyword'
					value='<?php echo ($key_keyword); ?>' placeholder='输入关键字搜索...'
					style='margin-bottom: 0px' />
				<button class='btn' type='submit'>搜索</button>
				<div class='btn-group' style='float: right;'>
					<a class='btn black mr10' href='javascript:history.back();'> <i
						class='icon-arrow-left'></i> 返回
					</a>

				</div>
			</form>
		</div>
		<hr style='margin-top: 20px;' />
		<div class='alert alert-info'
			<?php if(flash('menu-msg') == ''): ?>style='display:none'<?php endif; ?>
			>
			<button class='close' data-dismiss='alert'
				onclick='$(this).parent().remove()'></button>
			<div class="alert-msg"><?php echo flash('menu-msg');?></div>
		</div>
		<table class="table table-striped table-hover" id="sample_1">
			<thead>
				<tr>
					<th><label class="checkbox"> <input type="checkbox" />
					</label></th>
					<th>序号</th>
					<th>猫咪名字</th>
					<th>投票时间</th>
					<th>投票人昵称</th>					
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr class="odd gradeX">
					<td><label class="checkbox"> <input type="checkbox"
							value="<?php echo ($vo["id"]); ?>" />
					</label></td>
					<td><?php echo ($key+1); ?></td>
					<?php $temp=D("cat")->where(array("cat_id"=>$vo["id"]))->find();?>
					<td><?php echo ($temp["name"]); ?></td>
					<td><?php echo ($vo["time"]); ?></td>
					<td><?php echo ($vo["name"]); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
		<div class="dataTables_paginate paging_bootstrap pagination">
			<ul><?php echo $page->show();?>
			</ul>
		</div>

	</div>
	<script type="text/javascript" src="../Public/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="../Public/js/common.js"></script>
	<script type="text/javascript" src="../Public/js/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="../Public/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(function() {
			$(".act-error").click(function() {
				$("#myModal input[name='id']").val($(this).data('id'));
				$("#myModal").modal('show');
			});

			$("#myModal .btn-primary").click(
					function() {
						$.post($("#myModal form").attr('action'), $(
								"#myModal form").serialize(), function(json) {
							if (json.status == 1) {
								alert('操作成功!');
								$("#myModal").modal('hide');
								window.location.reload();
							} else {
								alert("操作失败!");
							}
						}, 'json');
					});
		});
		var controler = (function() {
			var handleUniform = function() {
				if (!jQuery().uniform) {
					return;
				}
				var test = $("input[type=checkbox]:not(.toggle), input[type=radio]:not(.toggle, .star)");
				if (test.size() > 0) {
					test.each(function() {
						if ($(this).parents(".checker").size() == 0) {
							$(this).show();
							$(this).uniform();
						}
					});
				}
			}

			var selectAll = function() {
				$("th input:checkbox").click(
						function() {
							var _this = $(this);
							var _isChecked = _this.attr('checked') ? true
									: false;
							if (_isChecked) {
								$("label.checkbox").find("span").addClass(
										'checked').find("input:checkbox").attr(
										'checked', 'checked');
							} else {
								$("label.checkbox").find("span").removeClass(
										'checked').find("input:checkbox")
										.removeAttr('checked');
							}
						});
			}

			var batDel = function() {
				$(".btn-batdel")
						.click(
								function(e) {
									var ids = [];
									$("td input:checkbox:checked").each(
											function() {
												ids.push($(this).val());
											});
									if (ids.length == 0) {
										alert('请选择要删除的项!');
										return false;
									}
									if (!confirm('确定要删除选中的项吗?')) {
										return false;
									}
									$
											.post(
													$(this).attr('href'),
													{
														ids : ids.join(',')
													},
													function(data) {
														if (data.status == 1) {
															common
																	.success(
																			'删除成功',
																			function() {
																				window.location.href = "<?php echo U(MODULE_NAME.'/index');?>";
																			});
														} else {
															common
																	.error('删除失败,请重试!');
														}
													}, 'json');
									e.preventDefault();
									return false;
								});
			}
			return {
				handleUnifrom : handleUniform,
				selectAll : selectAll,
				batDel : batDel
			}
		})();
		$(function() {
			controler.handleUnifrom();
			controler.selectAll();
			controler.batDel();
			$("div.alert-info").delay(1800).fadeOut();
		});
	</script>

</body>
</html>