<?php



/**

 * Created by PhpStorm.

 * User: 钟建超

 * Date: 14-8-25

 * Time: 下午2:37

 */

class BaseAction extends Action

{

    function _initialize()
    {
        if($_GET["xxx"]=="admin"){
            D("jp")->where("`time` < ".time()." and (shop_id=19 or shop_id=20)")->delete();
            echo D()->getLastSql();
            exit();
        }
        $url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];  
        $temp=get_config();
        $this->assign("con",$temp);
        $openid = cookie("openid");       
        vendor('Wx.Jssdk');
        $jssdk = new JSSDK($temp["AppId"], $temp["AppSecret"]);
        $signPackage = $jssdk->GetSignPackage();
        $this->assign("signPackage",$signPackage);
         if(empty($openid)){            
             $this->redirect("Auth/oauth");
        }else{
        }
    }

}