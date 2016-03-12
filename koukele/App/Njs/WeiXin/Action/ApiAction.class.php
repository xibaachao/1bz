<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-5-30
 * Time: 上午10:27
 */

class ApiAction extends Action{

    protected $wx = null;

    function _initialize(){
        $this->config = get_config();
    }

    /**
     * 微信入口
     * 修改记录:
     *  1.2013年9月28日11时添加判断
     */
    function index(){
        if(isset($_GET['echostr']) && !empty($_GET['echostr']))
            self::valid();
        else
            self::reply();
    }

    //回复用户消息
    public function reply()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $info = array();
            $info['from'] = (string)$postObj->FromUserName;      //用户ID
            $info['to'] = (string)$postObj->ToUserName;          //当前公众账号
            $info['key'] = trim($postObj->Content);      //用户发送的消息
            $info['mt'] = strtolower($postObj->MsgType); //消息类型
            $info['keyword'] = $info['key'];
            cookie('USER_INFO', array('openid' =>  $info['from']), 3600 * 521);
            if($info['mt'] == 'event'){
                $info['event'] = (string)$postObj->Event;
                $info['event_key'] = (string)$postObj->Event && (string)$postObj->Event !='CLICK' ? (string)$postObj->Event : (string)$postObj->EventKey;
                $info['keyword'] = $info['event_key'];
            }
            $info['create_time'] = (string)$postObj->CreateTime;
            $info['time'] = time();

            if($info['keyword']=='客服'){
                $this->assign('info',$info);
                $this->display('transfer');
                exit;
            }
            //file_put_contents('./info.html',dump($info,false));
            $sign = self::get_msg($info);
            //file_put_contents("./msg.html",dump($sign,false));
            $tpl = self::get_tpl($sign['type']);
            $info['msg'] = $sign['type']==1 ? $sign['reply'] : unserialize($sign['reply']);
            //file_put_contents("./log.html",dump($info,false));
            $this->assign('info',$info);
            $this->display($tpl);
            $content = $this->fetch($tpl);
            file_put_contents("./msg.xml",$content);
        }else {
            echo "<h1>非法访问!</h1>";
            exit;
        }
    }

    /**
     * 获取回复消息
     */
    public function get_msg($info){

        $key = $info['keyword'];
        switch($info['keyword']){
            case 'subscribe':
                //$sign = M("Msg")->where("keyword='{$info['keyword']}'")->find();
                $sign = M("Msg")->where("`keyword` REGEXP '^{$key}$|{$key},|,{$key},|,{$key}$'")->find();
                
                self::subscribe_handler($info);
                break;
            case 'unsubscribe':
                
                self::unsubscribe_handler($info);
                break;
            default:
                //判断刮刮卡
                $sign = self::card($info);
                if(!is_null($sign)) return $sign;

                //判断大转盘
                $sign = self::turn($info);
                if(!is_null($sign)) return $sign;

                //微调研
                $sign = self::survey($info);
                if(!is_null($sign)) return $sign;

                //优惠券
                $sign = self::coupon($info);
                if(!is_null($sign)) return $sign;

                $article_type = D("ArticleType")->where(array('name'=>$info['keyword']))->find();
                if($article_type){
                    $list = D("Article")->where(array('pid'=>$article_type['id'],'status'=>1,'is_show'=>1))->limit(8)->order('id desc')->select();
                    $items = array();
                    foreach($list as $val){
                        $items[] = array(
                            'title'=>$val['title'],
                            'img'=>$val['cover'],
                            'desc'=>cutstr($val['content'],30),
                            'url'=>DOMAIN.__ROOT__.'/index.php/Mobile/Article/detail.html?id='.$val['id']
                        );
                    }
                    $sign = array(
                        'type'=>2,
                        'reply'=>serialize($items)
                    );
                    return $sign;
                }
                //关键字回复
                //TODO::多关键字匹配
                // $sign = M("Msg")->where("keyword='{$info['keyword']}'")->find();
                $sign = M("Msg")->where("`keyword` REGEXP '^{$key}$|^{$key},|,{$key},|,{$key}$'")->find();
                break;
        }

        if(strstr($info["keyword"],"投")!="" && strstr($info["keyword"],"投")!=null)
        {        
            $info["keyword"]=mb_substr($info["keyword"],1,4,'utf-8');            
            if(is_numeric($info["keyword"]))
            {
                $temp=D("baby")->where(array("no"=>$info["keyword"]))->find();
                $where["openid"]=$info["from"];                
                $where["type"]=1;
                $where["time"]=array('between',date("Y-m-d").",".date("Y-m-d H:i:s",time()));
                $one=D("vote")->where($where)->find();   
                       
                if($one!=null)
                {
                    $sign=D("Msg")->find(21);
                }else{
                    
                    if($temp!=null)
                    {
                        D("vote")->add(array("user_id"=>-1,"time"=>date("Y-m-d H:i:m",time()),"baby_id"=>$temp["id"],"type"=>1,"openid"=>$info["from"]));
                        D("baby")->where(array("id"=>$temp["id"]))->setInc("allvote");                 
                        $sign=D("Msg")->find(20);
                    }else{
                        $sign=D("Msg")->find(22);
                    }
                }
            }
        }
        if(is_null($sign)){
            $sign = M("Msg")->where("keyword='default'")->find();
        }

        return $sign;
    }

    /**
     * 刮刮卡消息
     */
    function card($info){
        $card = M("ScratchCard")->where("`key`='{$info['keyword']}'")->order("id desc")->find();
        if($card){
            $arr = array();
            $time = time();
            if($time>=$card['start_time'] && $time<$card['end_time']){//刮刮卡活动进行时
                $arr['title'] = $card['start_title'];
                $arr['img'] = $card['start_new_img'];
                $arr['desc'] = $card['explanation'];
                $arr['url'] = DOMAIN.__ROOT__.'/index.php/Game/ScratchCard/index.html?openid=:openid:&status=0&id='.$card['id'];
            }elseif($time>=$card['end_time']){//刮刮卡活动结束
                $arr['title'] = $card['end_title'];
                $arr['img'] = $card['end_new_img'];
                $arr['desc'] = $card['end_explanation'];
                $arr['url'] = DOMAIN.__ROOT__.'/index.php/Game/ScratchCard/index.html?openid=:openid:&status=1&id='.$card['id'];
            }
            return array(
                'type'=>2,
                'reply'=>serialize(array($arr)),
            );
        }else{
            return null;
        }
    }

    /**
     * 大转盘
     */
    function turn($info){
        $turn = M("Turn")->where("`key`='{$info['keyword']}'")->order("id desc")->find();
        if($turn){
            $arr = array();
            $time = time();
            if($time>=$turn['start_time'] && $time<$turn['end_time']){//大转盘活动进行时
                $arr['title'] = $turn['start_title'];
                $arr['img'] = $turn['start_new_img'];
                $arr['desc'] = $turn['explanation'];
                $arr['url'] = DOMAIN.__ROOT__.'/index.php/Game/Turn/index.html?status=0&id='.$turn['id'];
            }elseif($time>=$turn['end_time']){//大转盘活动结束
                $arr['title'] = $turn['end_title'];
                $arr['img'] = $turn['end_new_img'];
                $arr['desc'] = $turn['end_explanation'];
                $arr['url'] = DOMAIN.__ROOT__.'/index.php/Game/Turn/index.html?status=1&id='.$turn['id'];
            }
            return array(
                'type'=>2,
                'reply'=>serialize(array($arr)),
            );
        }else{
            return null;
        }
    }

    /**
     *微调研
     */
    function survey($info){
        $survey = M("Survey")->where("`key`='{$info['keyword']}'")->order("id desc")->find();
        if($survey){
            $arr = array();
            $time = time();
            if($time>$survey['start_time'] && $time<$survey['end_time']){
                $arr['title'] = $survey['title'];
                $arr['img'] = $survey['new_img'];
                $arr['desc'] = $survey['start_description'];
                $arr['url'] = DOMAIN.__ROOT__.'/index.php/Home/Game/survey_guide?openid=:openid:&status=0&survey_id='.$survey['id'];
            }else{
                $arr['title'] = $survey['title'];
                $arr['img'] = $survey['new_img'];
                $arr['desc'] = $survey['end_description'];
                $arr['url'] = DOMAIN.__ROOT__.'/index.php/Home/Game/survey_guide?openid=:openid:&status=1&survey_id='.$survey['id'];
            }
            return array(
                'type'=>2,
                'reply'=>serialize(array($arr)),
            );
        }else{
            return null;
        }
    }

    /**
     *优惠券
     */
    function coupon($info){
        if($info['keyword']!=='优惠券'){
            return null;
        }
        $coupon = M("Coupon")->where(array())->order("id desc")->find();
        if($coupon){
            $arr = array();
            $time = time();
            if($time>$coupon['start_time'] && $time<$coupon['end_time']){
                $arr['title'] = $coupon['title'];
                $arr['img'] = $coupon['new_img'];
                $arr['desc'] = $coupon['start_description'];
                $arr['url'] = DOMAIN.__ROOT__.'/index.php/Home/Game/coupon?openid=:openid:&status=0&coupon_id='.$coupon['id'];
            }else{
                $arr['title'] = $coupon['title'];
                $arr['img'] = $coupon['new_img'];
                $arr['desc'] = $coupon['end_description'];
                $arr['url'] = DOMAIN.__ROOT__.'/index.php/Home/Game/coupon?openid=:openid:&status=1&coupon_id='.$coupon['id'];
            }
            return array(
                'type'=>2,
                'reply'=>serialize(array($arr)),
            );
        }else{
            return null;
        }
    }

    /**
     * 关注
     * @access public
     * @param array $info 用户信息
     * @return void
     */
    function subscribe_handler($info){
        $access_token = get_access_token();
        $openid = (string)$info['from'];
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$access_token}&openid={$openid}";
        $data = json_decode(file_get_contents($url),true);
        $count = D("Account")->where("openid='{$openid}'")->count();
        $xx=D("yh")->where(array("openid"=>$openid))->count();
        if($xx>=1)
        {

        }else{
            D("yh")->add(array("openid"=>$openid));
        }
       
        if($count>=1) {
           
        }else{
            D("Account")->add(array(
                'openid'=>$openid                
            ));
           
        }
    }

    /**
     * 取消关注
     * @access public
     * @param array $info 用户信息
     * @return void
     */
    function unsubscribe_handler($info){
         $openid = (string)$info['from'];
        D("Account")->where(array('openid'=>$openid))->delete();
        D("yh")->where(array("openid"=>$openid))->delete();
    }

    /**
     * 获取fakeid
     */
    function get_fakeid($info){

        $openid = $info['from'];
        $sign = M("Wxwxinfo")->where("openid='$openid'")->find();
        if(!empty($sign['fakeid'])) return;
        $obj = $this->wx->getLatestMsgByCreateTimeAndContent($info['create_time'],$info['key']);
        $fakeid = $obj['fakeid'];
        D("Wxinfo")->where("openid='$openid'")->save(array('fakeid'=>$fakeid));
    }

    //获取模板
    public function get_tpl($type){
        $tpl = 'text';
        switch($type){
            case 1:
                $tpl = 'text';
                break;
            case 2:
                $tpl = 'news';
                break;
            case 3:
                $tpl = 'transfer';
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
        if($this->checkSignature()){
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
        $token = $config['TOKEN'];// TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr,SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    function test(){
        header("Content-Type:text/html;charset=utf-8");
        dump($_SERVER);
    }
}