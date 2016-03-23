/**
 * Created by Administrator on 14-7-23.
 * Common.js 公用js
 */

var common = (function(){
    function success(msg,callback){
        msg = msg || '操作成功';
        show(msg,1,1200,callback);
    }

    function error(msg,callback){
        msg = msg || '操作失败';
        show(msg,0,-1,callback);
    }

    function info(msg,sleep,callback){
        show(msg,-1,sleep,callback);
    }

    function show(msg,type,sleep,callback){
        var box = $(".alert");
        switch(type){
            case 1:
                box.removeClass('alert-info alert-error').addClass('alert-success')
                    .find(".alert-msg").html(msg);
                break;
            case 0:
                box.removeClass('alert-info alert-success').addClass('alert-error')
                    .find('.alert-msg').html(msg);
                break;
            case -1:
                box.removeClass('alert-success alert-error').addClass('alert-success')
                    .find('.alert-msg').html(msg);
                break;
        }
        callback = callback || function(){};
        if(sleep!=-1){
            box.stop(true).show().delay(sleep).fadeOut(function () {
                callback();
            });
        }else{
            box.stop(true).show();
            callback();
        }

        /*box.show();
        if(sleep!=-1){
            setTimeout(function(){
                box.fadeOut();
                callback();
            },1000);
        }*/
    }

    return {
        success:success,
        error:error,
        show:show,
        info:info
    }
})();

$(function(){
    if($(".editor").length>0){
        $(".editor").xheditor({
            width:'85%',
            height:'400px',
            upImgUrl:_upImgUrl
        });
    }

    /**
     * @desc 简单ajax默认操作
     */
    $("a[data-ajax='default']").click(function(e){
        var confirm_msg = $(this).data('confirm');
        if(confirm_msg && !confirm(confirm_msg)){
            return false;
        }
        $.get($(this).attr('href'),function(json){
            if(json.status==1){
                common.success(json.info,function(){
                    window.location.reload();
                });
            }else{
                common.error(json.info);
            }
        });
        e.preventDefault();
        return false;
    });

    if($(".datetime").length>0){
        $(".datetime").datetimepicker({
            format: "yyyy-mm-dd hh:ii:ss",
            autoclose:true,
            todayBtn:true,
            pickerPosition: "bottom-right",
            startDate:"2008-08-08 08:00",
            language:'zh'
        });
    }

});
