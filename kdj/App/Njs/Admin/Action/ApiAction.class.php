<?php

//微信公众平台Api
class ApiAction extends Action
{

    protected $wx = null;

    function _initialize()
    {
        vendor("Wx.WeiXin");
        $this->config = get_config();
        $data = array();
        $data['account'] = $this->config['account'];
        $data['password'] = $this->config['pwd'];
        $data['cookiePath'] = './Public/tmp/cookie';
        $data['webTokenPath'] = './Public/tmp/token';
        $this->wx = new WeiXin($data);
    }

    /**
     * 微信入口
     * 修改记录:
     *  1.2013年9月28日11时添加判断
     */
    function index()
    {
        if (isset($_GET['echostr']) && !empty($_GET['echostr']))
            self::valid();
        else
            self::reply();
    }

    //回复用户消息
    public function reply()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)) {
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $info = array();
            $info['from'] = (string)$postObj->FromUserName; //用户ID
            $info['to'] = (string)$postObj->ToUserName; //当前公众账号
            $info['key'] = trim($postObj->Content); //用户发送的消息
            $info['mt'] = strtolower($postObj->MsgType); //消息类型
            $info['keyword'] = $info['key'];
            if ($info['mt'] == 'event') {
                $info['event'] = (string)$postObj->Event;
                $info['event_key'] = (string)$postObj->Event && (string)$postObj->Event != 'CLICK' ? (string)$postObj->Event : (string)$postObj->EventKey;
                //$info['event_key'] = (string)$postObj->EventKey; //事件Key
                $info['keyword'] = $info['event_key'];
            }
            $info['create_time'] = (string)$postObj->CreateTime;
            $info['time'] = time();
            $sign = self::get_msg($info);
            $tpl = self::get_tpl($sign['type']);
            $info['msg'] = $sign['type'] == 1 ? $sign['reply'] : unserialize($sign['reply']);
            session('openid', $info['from']);
            $this->assign('info', $info);
            $this->display($tpl);
        } else {
            echo "<h1>非法访问!</h1>";
            exit;
        }
    }

    /**
     * 获取回复消息
     */
    public function get_msg($info)
    {

        switch ($info['keyword']) {
            case 'subscribe':
                $sign = M("Msg")->where("keyword='subscribe'")->find();
                //self::subscribe_handler($info);
                break;
            case 'unsubscribe':
                //取消关注
                $sign = M("Msg")->where("keyword='unsubscribe'")->find();
                //self::unsubscribe_handler($info);
                break;
            default:

                $sign = self::turn($info);
                if (!is_null($sign)) return $sign;

                //关键字回复
                $sign = M("Msg")->where("code='{$info['keyword']}'")->find();
                if (is_null($sign))
                    $sign = M("Msg")->where("`keyword`='{$info['keyword']}'")->find();
                break;
        }
        if (is_null($sign))
            $sign = M("Msg")->where("code='QiJia_Default_Reply'")->find();

        return $sign;
    }

    /**
     * 刮刮卡消息
     */
    function card($info)
    {
        $card = M("ScratchCard")->where("`key`='{$info['keyword']}'")->order("id desc")->find();
        if ($card) {
            $arr = array();
            $time = time();
            if ($time >= $card['start_time'] && $time < $card['end_time']) { //刮刮卡活动进行时
                $arr['title'] = $card['start_title'];
                $arr['img'] = $card['start_new_img'];
                $arr['desc'] = $card['explanation'];
                $arr['url'] = DOMAIN . __ROOT__ . '/index.php/Home/Game/scratch.html?openid=:openid:&status=0&id=' . $card['id'];
            } elseif ($time >= $card['end_time']) { //刮刮卡活动结束
                $arr['title'] = $card['end_title'];
                $arr['img'] = $card['end_new_img'];
                $arr['desc'] = $card['end_explanation'];
                $arr['url'] = DOMAIN . __ROOT__ . '/index.php/Home/Game/scratch.html?openid=:openid:&status=1&id=' . $card['id'];
            }
            return array(
                'type' => 2,
                'reply' => serialize(array($arr)),
            );
        } else {
            return null;
        }
    }

    /**
     * 大转盘
     */
    function turn($info)
    {
        $turn = M("Turn")->where("`key`='{$info['keyword']}'")->order("id desc")->find();
        if ($turn) {
            $arr = array();
            $time = time();
            if ($time >= $turn['start_time'] && $time < $turn['end_time']) { //大转盘活动进行时
                $arr['title'] = $turn['start_title'];
                $arr['img'] = $turn['start_new_img'];
                $arr['desc'] = $turn['explanation'];
                $arr['url'] = DOMAIN . __ROOT__ . '/index.php/Game/Turn/index.html?status=0&id=' . $turn['id'];
            } elseif ($time >= $turn['end_time']) { //大转盘活动结束
                $arr['title'] = $turn['end_title'];
                $arr['img'] = $turn['end_new_img'];
                $arr['desc'] = $turn['end_explanation'];
                $arr['url'] = DOMAIN . __ROOT__ . '/index.php/Game/Turn/index.html?status=1&id=' . $turn['id'];
            }
            return array(
                'type' => 2,
                'reply' => serialize(array($arr)),
            );
        } else {
            return null;
        }
    }

    /**
     *微调研
     */
    function survey($info)
    {
        $survey = M("Survey")->where("`key`='{$info['keyword']}'")->order("id desc")->find();
        if ($survey) {
            $arr = array();
            $time = time();
            if ($time > $survey['start_time'] && $time < $survey['end_time']) {
                $arr['title'] = $survey['title'];
                $arr['img'] = $survey['new_img'];
                $arr['desc'] = $survey['start_description'];
                $arr['url'] = DOMAIN . __ROOT__ . '/index.php/Home/Game/survey_guide?openid=:openid:&status=0&survey_id=' . $survey['id'];
            } else {
                $arr['title'] = $survey['title'];
                $arr['img'] = $survey['new_img'];
                $arr['desc'] = $survey['end_description'];
                $arr['url'] = DOMAIN . __ROOT__ . '/index.php/Home/Game/survey_guide?openid=:openid:&status=1&survey_id=' . $survey['id'];
            }
            return array(
                'type' => 2,
                'reply' => serialize(array($arr)),
            );
        } else {
            return null;
        }
    }

    /**
     *优惠券
     */
    function coupon($info)
    {
        if ($info['keyword'] !== '优惠券') {
            return null;
        }
        $coupon = M("Coupon")->where()->order("id desc")->find();
        if ($coupon) {
            $arr = array();
            $time = time();
            if ($time > $coupon['start_time'] && $time < $coupon['end_time']) {
                $arr['title'] = $coupon['title'];
                $arr['img'] = $coupon['new_img'];
                $arr['desc'] = $coupon['start_description'];
                $arr['url'] = DOMAIN . __ROOT__ . '/index.php/Home/Game/coupon?openid=:openid:&status=0&coupon_id=' . $coupon['id'];
            } else {
                $arr['title'] = $coupon['title'];
                $arr['img'] = $coupon['new_img'];
                $arr['desc'] = $coupon['end_description'];
                $arr['url'] = DOMAIN . __ROOT__ . '/index.php/Home/Game/coupon?openid=:openid:&status=1&coupon_id=' . $coupon['id'];
            }
            return array(
                'type' => 2,
                'reply' => serialize(array($arr)),
            );
        } else {
            return null;
        }
    }

    /**
     * 关注
     * @access public
     * @param array $info 用户信息
     * @return void
     */
    function subscribe_handler($info)
    {
        $access_token = get_access_token();
        $openid = (string)$info['from'];
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$access_token}&openid={$openid}";
        $data = json_decode(file_get_contents($url), true);
        $count = D("Account")->where("openid='{$openid}'")->count();
        if ($count >= 1) return false;
        $data['time'] = time();
        $data['openid'] = $openid;
        $data['no'] = '61308818' . date('YmdHis') . rand(0, 9);
        $data['sum'] = $data['fill'] = $data['handsel'] = 0;
        $uid = D("Account")->add($data);
        import("ORG.Net.Http");
        $qrcode = qrcode(U("Admin/Account/show", array("id" => $uid), true, false, true));
        file_put_contents("./Public/qrcode/" . $data['no'] . '.jpg', Http::fsockopenDownload($qrcode));
        //Http::curlDownload($qrcode, './Public/qrcode/'.$data['no'].'.jpg');
    }

    /**
     * 取消关注
     * @access public
     * @param array $info 用户信息
     * @return void
     */
    function unsubscribe_handler($info)
    {
        D("Account")->where("openid='{$info['from']}'")->delete();
    }

    /**
     * 获取fakeid
     */
    function get_fakeid($info)
    {

        $openid = $info['from'];
        $sign = M("Wxwxinfo")->where("openid='$openid'")->find();
        if (!empty($sign['fakeid'])) return;
        $obj = $this->wx->getLatestMsgByCreateTimeAndContent($info['create_time'], $info['key']);
        $fakeid = $obj['fakeid'];
        D("Wxinfo")->where("openid='$openid'")->save(array('fakeid' => $fakeid));
    }

    //获取模板
    public function get_tpl($type)
    {
        $tpl = 'text';
        switch ($type) {
            case 1:
                $tpl = 'text';
                break;
            case 2:
                $tpl = 'news';
                break;
            default:
                $tpl = 'text';
                break;
        }
        return $tpl;
    }

    //验证
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        if ($this->checkSignature()) {
            echo $echoStr;
            exit;
        }
    }

    private function checkSignature()
    {
        $config = get_config();
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = $config['TOKEN']; // TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

    function test()
    {
        echo __FILE__;
        echo __ROOT__;
        dump($_SERVER);
        dump($_COOKIE);
    }
}

?>
