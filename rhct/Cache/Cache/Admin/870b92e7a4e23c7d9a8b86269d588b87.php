<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang='zh-CN'>
<head>
    <meta charset="utf-8"/>
    <title>领取商品页面</title>
    <link href="../Public/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>

    <link href="../Public/css/bootstrap-responsive.min.css" rel="stylesheet"
          type="text/css"/>

    <link href="../Public/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>

    <link href="../Public/css/style-metro.css" rel="stylesheet"
          type="text/css"/>

    <link href="../Public/css/style.css" rel="stylesheet" type="text/css"/>

    <link href="../Public/css/style-responsive.css" rel="stylesheet"
          type="text/css"/>

    <link href="../Public/css/default.css" rel="stylesheet" type="text/css"
          id="style_color"/>

    <link href="../Public/css/uniform.default.css" rel="stylesheet"
          type="text/css"/>
</head>
<body style="background-color: #fff !important; margin: 20px !important;">
<div class="page-container row-fluid">
    <div class='btn-group '>
        <h3>领取商品</h3>
    </div>
    <hr style='margin-top: 0px'/>

    <div style='margin: 4px 0px;'>
        <form method='get'>
            <input type='text' class="m-wrap" name='keyword'
                   value='<?php echo ($keyword); ?>' placeholder='输入关键字搜索...'
                   style='margin-bottom: 0px'/>
            <button class='btn' type='submit'>搜索</button>
        </form>
    </div>
    <hr style='margin-top: 20px;'/>
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
        <th>商品名称</th>
        <th>姓名</th>
        <th>电话</th>
        <th>来源</th>
        <th>所属商店</th>
        <th>抽奖时间</th>
        <th>是否已领取</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr class="odd gradeX">
            <?php $shop=D("shop")->where(array("id"=>$vo['shop_id']))->find();?>
            <td><?php echo ($shop["title"]); ?></td>
            <td><?php echo ($vo["name"]); ?></td>
            <td><?php echo ($vo["phone"]); ?></td>
            <td><?php echo ($vo["ly"]); ?></td>
            <td><?php if(($shop["type"]) == "0"): ?>人东店<?php endif; if(($shop["type"]) == "1"): ?>光华店<?php endif; ?></td>
            <td><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></td>
            <td><?php if(($vo["status"]) == "0"): ?>未领取<?php else: ?>已领取<?php endif; ?></td>
            <td>
                <?php if(($vo["status"]) == "0"): ?><a href='<?php echo U(MODULE_NAME."/lq",array("id"=>$vo["id"]));?>' class='btn default btn-xs'>
                    <i class='icon-edit'></i>
                    确认领取</a><?php endif; ?>
            </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>
</div>
<script type="text/javascript" src="../Public/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../Public/js/common.js"></script>
<script type="text/javascript" src="../Public/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="../Public/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(function () {
        $(".act-error").click(function () {
            $("#myModal input[name='id']").val($(this).data('id'));
            $("#myModal").modal('show');
        });

        $("#myModal .btn-primary").click(
                function () {
                    $.post($("#myModal form").attr('action'), $(
                            "#myModal form").serialize(), function (json) {
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
    var controler = (function () {
        var handleUniform = function () {
            if (!jQuery().uniform) {
                return;
            }
            var test = $("input[type=checkbox]:not(.toggle), input[type=radio]:not(.toggle, .star)");
            if (test.size() > 0) {
                test.each(function () {
                    if ($(this).parents(".checker").size() == 0) {
                        $(this).show();
                        $(this).uniform();
                    }
                });
            }
        }

        var selectAll = function () {
            $("th input:checkbox").click(
                    function () {
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

        var batDel = function () {
            $(".btn-batdel")
                    .click(
                            function (e) {
                                var ids = [];
                                $("td input:checkbox:checked").each(
                                        function () {
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
                                                    ids: ids.join(',')
                                                },
                                                function (data) {
                                                    if (data.status == 1) {
                                                        common
                                                                .success(
                                                                        '删除成功',
                                                                        function () {
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
            handleUnifrom: handleUniform,
            selectAll: selectAll,
            batDel: batDel
        }
    })();
    $(function () {
        controler.handleUnifrom();
        controler.selectAll();
        controler.batDel();
        $("div.alert-info").delay(1800).fadeOut();
    });
</script>

</body>
</html>