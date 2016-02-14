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
        $url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        if($_GET!=null)
        {
            $info["openid"]=$_GET["openid"];
            cookie('USER_INFO',$info, 3600 * 24 * 365);
        }
        $time=date("Y-m-d");
        if(D("time")->where(array("time"=>$time))->find()!=null)
        {
          D("time")->where(array("time"=>$time))->setInc("no");
        }else{
          D("time")->add(array("time"=>$time,"no"=>1));
        }
        $temp=get_config();
        $this->assign("con",$temp);
       // cookie('USER_INFO', array('openid' => 'ooJsMuBae9b3XHJVptSqp1Jr9Tw4'), 3600 * 521);
        $user = cookie('USER_INFO');		
        $openid = $user['openid'];
        vendor('Wx.Jssdk');
        $jssdk = new JSSDK($temp["AppId"], $temp["AppSecret"]);
        $signPackage = $jssdk->GetSignPackage();
        $this->assign("signPackage",$signPackage);
        $one=D("Account")->where(array("openid"=>$openid))->find();
        if ($one["nickname"]=="" || $one["nickname"]!=null) {
          D("Account")->where(array("openid"=>$openid))->save(array("nickname"=>$user["nickname"]));
        }
         if(empty($openid)){
          //$this->redirect("Auth/oauth");
             header("Location:" . 'http://mt.magicgell.com/user/openid?redirect='.$url);
        }else{
          
		  }

    }

}