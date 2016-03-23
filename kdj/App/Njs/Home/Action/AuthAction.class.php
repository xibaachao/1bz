<?php



/**

 * Created by PhpStorm.

 * User: Administrator

 * Date: 14-7-11

 * Time: 下午3:21

 * Desc: AuthAction

 */

class AuthAction extends Action

{



    function _initialize()

    {

        $this->config = get_config();

    }



    function clear()

    {
 
       // cookie('USER_INFO', array('openid' => 'o1cC5jpuWKIYb9pEKv1C1MbGZ9T0'), 3600 * 521);

        cookie('USER_INFO', null);

        echo "清空Cookie成功";

    }



    /**

     * @desc 授权跳转

     */

    function oauth()

    {

        $config = get_config();

        $param = array();

        if (isset($_GET['opid'])) {

            $param['opid'] = $_GET['opid'];

        }

        $redirect = urlencode(U("Auth/applyAuth", $param, true, false, true));

        $auth_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$config['AppId']}&redirect_uri={$redirect}&response_type=code&scope=snsapi_base&state=123#wechat_redirect";

        header("Location:" . $auth_url);

        exit;

    }



    /**

     * @desc 授权后续操作

     */

    function applyAuth()

    {

        $code = isset($_REQUEST['code']) ? $_REQUEST['code'] : null;

        $token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->config['AppId']}&secret={$this->config['AppSecret']}&code={$code}&grant_type=authorization_code";

        $token_body = file_get_contents($token_url);

        $token_json = json_decode($token_body, true);

        cookie("openid",$token_json["openid"]);
       
        $this->redirect("Index/index");
        exit();

        $info_url = "https://api.weixin.qq.com/sns/userinfo?access_token={$token_json['access_token']}&openid={$token_json['openid']}";

        $info_body = file_get_contents($info_url);

        $info = json_decode($info_body, true);

        cookie('USER_INFO', $info, 3600 * 24 * 365);

        $opid = $_REQUEST['opid'];

        $db = D("score")->select();

        D("userinfo")->where(array('openid' => $opid))->setInc('score', $db[0]['score']);

      // $this->redirect("Index/index");

    }

}