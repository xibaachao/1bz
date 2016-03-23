<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/3/19 0019
 * Time: 下午 3:50
 */
class AccountAction extends ManageAction{
    function lq(){
        $this->config = get_config();
        $token_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->config['AppId']}&secret={$this->config['AppSecret']}";
        $token_body = file_get_contents($token_url);
        $token_json = json_decode($token_body, true);
        $info_url="https://api.weixin.qq.com/cgi-bin/user/get?access_token={$token_json['access_token']}";
        $info_body = file_get_contents($info_url);
        $info = json_decode($info_body, true);
        $next_openid=$info["next_openid"];
        $info=$info["data"]["openid"];
        if (count($info)>0) {
            for ($i=0; $i < count($info); $i++) { 
                   $data["openid"]=$info[$i];
                   D("Account")->add($data);
              }
        }
        $info_url="https://api.weixin.qq.com/cgi-bin/user/get?access_token={$token_json['access_token']}&next_openid=$next_openid";
        $info_body = file_get_contents($info_url);
        $info = json_decode($info_body, true);
        $next_openid=$info["next_openid"];
        $info=$info["data"]["openid"];
        if (count($info)>0) {
            for ($i=0; $i < count($info); $i++) { 
                   $data["openid"]=$info[$i];
                   D("Account")->add($data);
              }
        }
        $info_url="https://api.weixin.qq.com/cgi-bin/user/get?access_token={$token_json['access_token']}&next_openid=$next_openid";
        $info_body = file_get_contents($info_url);
        $info = json_decode($info_body, true);
        $next_openid=$info["next_openid"];
        $info=$info["data"]["openid"];
        if (count($info)>0) {
            for ($i=0; $i < count($info); $i++) { 
                   $data["openid"]=$info[$i];
                   D("Account")->add($data);
              }
        }
    }
}