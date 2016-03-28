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
    $temp=get_config();
    cookie('USER_INFO', array('openid' => 'ooJsMuBae9b3XHJVptSqp1Jr9Tw4'), 3600 * 521);
    $user = cookie('USER_INFO');	
    $openid = $user['openid'];
    vendor('Wx.Jssdk');
    $jssdk = new JSSDK($temp["AppId"], $temp["AppSecret"]);
    $signPackage = $jssdk->GetSignPackage();
    $this->assign("signPackage",$signPackage);    

    //	$this->createj($signPackage,$temp);
    
    $one=D("Account")->where(array("openid"=>$openid))->find();
    if ($one["nickname"]=="" || $one["nickname"]!=null) {
      D("Account")->where(array("openid"=>$openid))->save(array("nickname"=>$user["nickname"]));
    }
    if(empty($openid)){
      $this->redirect("Auth/oauth");
    }

  }
  //签名生成
  function getCardSign($card){
    sort($card,SORT_STRING);
    $sign = sha1(implode($card));
    if (!$sign)
      return false;
    return $sign;
  }
  
  //生成优惠券的方法
  function createj($signPackage,$temp){
  	$data = json_decode(file_get_contents("cardapi_ticket.json"));
  	$api_ticket;
  	if ($data->expire_time < time()) {//判断card_ticket过期
  		$APPID=$temp["AppId"];
  		$APPSECRET=$temp["AppSecret"];
  		$u="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$APPID&secret=$APPSECRET";
  		$token_body = file_get_contents($u);
  		$token_json = json_decode($token_body, true);  		
  		$access_token=$token_json["access_token"];  		
  		$ur="https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$access_token."&type=wx_card";
  		$data = file_get_contents($ur);  		
  		$data = json_decode($data, true);
  		
  		$api_ticket=$data["ticket"];
  		var_dump($api_ticket);	
  		if ($api_ticket) {
  			$data->expires_in = time() + 7000;
  			$data->ticket = $ticket;
  			$fp = fopen("cardapi_ticket.json", "w");
  			fwrite($fp, json_encode($data));
  			fclose($fp);
  		}
  	}else{
  		$ticket = $data->ticket;
  	}
  	
  	
  	//echo $api_ticket;
  	$timestamp=$signPackage["timestamp"];
  	$nonce_str=$signPackage["nonceStr"];
  	//  $string = "$api_ticket"."pCE2wv5zx_lrHDHnaJM0sCcipy-o".$timestamp;
  	$string[0]=$ticket;
  	$string[1]="pCE2wv5zx_lrHDHnaJM0sCcipy-o";
  	$string[2]=$timestamp;
  	$string[3]=$nonce_str;
  	$xxxxx=$this->getCardSign($string);
  	$this->assign("cardSign",$xxxxx);
  	
  	
  }
  
  
}