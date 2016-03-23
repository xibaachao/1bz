<?php
require("LeaWeiXinClient.php");

/**
 * 微信公共平台的私有接口
 * 思路: 模拟登录, 再去调用私有web api
 *
 * 功能: 发送信息, 批量发送(未测试), 得到用户信息, 得到最近信息, 解析用户信息(fakeId)
 *
 * @author life lifephp@gmail.com https://github.com/lealife/WeiXin-Private-API
 * 
 * 参考了gitHub微信的api: https://github.com/zscorpio/weChat, 在此基础上作了修改和完善
 * 	(该接口经测试不能用, 因为webToken的问题, 还有cookie生成的问题, 本接口已修复这些问题)
 */
class WeiXin
{
	private $token; // 公共平台申请时填写的token
	private $account;
	private $password;

	// 每次登录后将cookie, webToken缓存起来, 调用其它api时直接使用
	// 注: webToken与token不一样, webToken是指每次登录后动态生成的token, 供难证用户是否登录而用
	private $cookiePath; // 保存cookie的文件路径
	private $webTokenPath; // 保存webToken的文路径

	// 缓存的值
	public $webToken; // 登录后每个链接后都要加token
	private $cookie;

	private $lea;

	// 构造函数
	public function __construct($config) {
		if(!$config) {
			exit("error");
		}

		// 配置初始化
		$this->account = $config['account'];
		$this->password = $config['password'];
		$this->cookiePath = $config['cookiePath'];
		$this->webTokenPath = $config['webTokenPath'];

		$this->lea = new LeaWeiXinClient();

		// 读取cookie, webToken
		$this->getCookieAndWebToken();
	}

	// 登录, 并获取cookie, webToken

	/**
	 * 模拟登录获取cookie和webToken
	 */
	public function login() {
		$url = "https://mp.weixin.qq.com/cgi-bin/login?lang=zh_CN";
		$post["username"] = $this->account;
		$post["pwd"] = md5($this->password);
		$post["f"] = "json";
		$re = $this->lea->submit($url, $post);

		// 保存cookie
		$this->cookie = $re['cookie'];
		file_put_contents($this->cookiePath, $this->cookie);

		// 得到token
		$this->getWebToken($re['body']);

		return true;
	}

	/**
	 * 登录后从结果中解析出webToken
	 * @param  [String] $logonRet
	 * @return [Boolen]
	 */
	private function getWebToken($logonRet) {
		$logonRet = json_decode($logonRet, true);
		$msg = $logonRet["ErrMsg"]; // /cgi-bin/indexpage?t=wxm-index&lang=zh_CN&token=1455899896
		$msgArr = explode("&token=", $msg);
		if(count($msgArr) != 2) {
			return false;
		} else {
			$this->webToken = $msgArr[1];
			file_put_contents($this->webTokenPath, $this->webToken);
			return true;
		}
	}

	/**
	 * 从缓存中得到cookie和webToken
	 * @return [type]
	 */
	public function getCookieAndWebToken() {
		$this->cookie = file_get_contents($this->cookiePath);
		$this->webToken = file_get_contents($this->webTokenPath);

		// 如果有缓存信息, 则验证下有没有过时, 此时只需要访问一个api即可判断
		if($this->cookie && $this->webToken) {
			$re = $this->getUserInfo(1);
			if(is_array($re)) {
				return true;
			}
		} else {
			return $this->login();
		}
	}

	// 其它API, 发送, 获取用户信息

	/**
	 * 主动发消息
	 * @param  string $id      用户的fakeid
	 * @param  string $content 发送的内容
	 * @return [type]          [description]
	 */
	public function send($id, $content)
	{
		$post = array();
		$post['tofakeid'] = $id;
		$post['type'] = 1;
		$post['content'] = $content;
		$post['ajax'] = 1;
		$url = "https://mp.weixin.qq.com/cgi-bin/singlesend?t=ajax-response&token={$this->webToken}";
		$re = $this->lea->submit($url, $post, $this->cookie);
		return json_decode($re['body'],true);
	}

	/**
	 * 批量发送
	 * @param  [array] $ids     用户的fakeid集合
	 * @param  [type] $content [description]
	 * @return [type]          [description]
	 */
	public function batSend($ids, $content)
	{
		$result = array();
		foreach($ids as $id) {
			$result[$id] = $this->send($id, $content);
		}
		return $result;
	}	

	/**
	 * 发送图片
	 * @param  int $fakeId [description]
	 * @param  int $fileId 图片ID
	 * @return [type]         [description]
	 */
	public function sendImage($fakeId, $fileId) {
		$post = array();
		$post['tofakeid'] = $fakeId;
		$post['type'] = 2;
		$post['fid'] = $post['fileId'] = $fileId; // 图片ID
		$post['error'] = false;
		$post['ajax'] = 1;
		$post['token'] = $this->webToken;

		$url = "https://mp.weixin.qq.com/cgi-bin/singlesend?t=ajax-response&lang=zh_CN";
		$re = $this->lea->submit($url, $post, $this->cookie);

		return json_decode($re['body']);
	}

	/**
	 * 获取图文素材列表
	 * @param int $pageSize 每页显示数
	 * @param int $pageidx 当前页码
	 * @return array 
	 */
	public function get_new_list($pageSize=10,$pageidx=0){

	}

	/**
	 * 删除图文素材 
	 * @param int $app_msg_id 消息ID
	 * @return array $rst 
	 */
	public function delmsg($app_msg_id){
		$url = "https://mp.weixin.qq.com/cgi-bin/operate_appmsg?sub=del&t=ajax-response";
		$data = array();
		$data['AppMsgId'] = $app_msg_id;
		$data['token'] = $this->webToken;
		$data['ajax'] = 1;
		$re = $this->lea->submit($url,$data,$this->cookie);
		return json_decode($re['body'],true);
	}

	public function upload_media($file,$type='image'){
		$url = "http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token={$this->getWebToken}&type={$type}";
		$data['media']['filename']=realpath($file);
		$data['media']['filelength'] = filesize($file);
		$data['media']['content-type'] = filetype($file);
		$this->lea->upload($url,$data,$this->cookie);
		return $re;
	}

	/**
	 * 上传素材图片
	 */
	public function addimg($file_path){
		$url = "https://mp.weixin.qq.com/cgi-bin/uploadmaterial?cgi=uploadmaterial&type=2&token={$this->webToken}&t=iframe-uploadfile&lang=zh_CN&formId=1";
		$data['uploadfile'] = '@'.$file_path;
		$data['formId'] = '1';
		$re = $this->lea->upload($url,$data,$this->cookie);
		return $re;
	}

	/**
	 * 获取用户的信息
	 * @param  string $fakeId 用户的fakeId
	 * @return [type]     [description]
	 */
	public function getUserInfo($fakeId)
	{
		$url = "https://mp.weixin.qq.com/cgi-bin/getcontactinfo?t=ajax-getcontactinfo&lang=zh_CN&token={$this->webToken}&fakeid=$fakeId";
		$re = $this->lea->submit($url, array(), $this->cookie);
		$result = json_decode($re['body'], 1);
		if(!$result) {
			$this->login();
		}
		return $result;
	}

	/**
	 * 获取用户组
	 * @return array $group
	 * @author Sydney
	 */
	public function getFriendGroup(){
		$url = "https://mp.weixin.qq.com/cgi-bin/contactmanage?t=user/index&pagesize=1&pageidx=0&type=0&groupid=0&token={$this->webToken}&lang=zh_CN";
		$re = $this->lea->get($url,$this->cookie);
		if(!$re['body'])
			$this->login();
		$preg = '/<script type="text\/javascript">.*(\{"groups".*\]\}).*\s*,\s*friendsList.*<\/script>/Us';
		preg_match_all($preg,$re['body'],$result);
		$group = json_decode($result[1][0],true);
		return $group['groups'];
	}

	public function moveToGroup($fakeId,$groupId){
		$url = 'https://mp.weixin.qq.com/cgi-bin/modifycontacts';
		$data = array();
		$data['contacttype'] = $groupId;
		$data['tofakeidlist'] = $fakeId;
		$data['token'] = $this->webToken;
		$data['lang'] = 'zh_CN';
		$data['action'] = 'modifycontacts';
		$data['t'] = 'ajax-putinto-group';
		$re = $this->lea->submit($url,$data,$this->cookie);
		$result = json_decode($re['boty'],true);
		return $result;
	}

	/**
	 * 添加用户组
	 * @param string $groupName
	 * @return json 
	 */
	public function addGroup($groupName){
		$url = "https://mp.weixin.qq.com/cgi-bin/modifygroup";
		$data = array();
		$data['func'] = 'add';
		$data['name'] = $groupName;
		$data['token'] = $this->webToken;
		$data['lang'] = 'zh_CN';
		$data['t'] = 'ajax-friend-group';
		$re = $this->lea->submit($url,$data,$this->cookie);
		$json = json_decode($re['body'],true);
		return $json;
	}

	/**
	 * 删除分组
	 *	@param int $groupId
	 *	@author Sydney
	 */
	public function delGroup($groupId){
		$url = 'https://mp.weixin.qq.com/cgi-bin/modifygroup';
		$data = array();
		$data['func'] = 'del';
		$data['id'] = $groupId;
		$data['token'] = $this->webToken;
		$data['lang'] = 'zh_CN';
		$data['t'] = 'ajax-friend-group';
		$re = $this->lea->submit($url,$data,$this->cookie);
		$json = json_decode($re['body'],true);
		return $json;
	}

	/**
	 * 修改分组名称
	 * @param int $groupId
	 * @param string $groupName
	 * @author Sydney
	 */
	public function renameGroup($groupId,$groupName){
		$url = 'https://mp.weixin.qq.com/cgi-bin/modifygroup';
		$data = array();
		$data['func'] = 'rename';
		$data['id'] = $groupId;
		$data['name'] = $groupName;
		$data['token'] = $this->webToken;
		$data['lang'] = 'zh_CN';
		$data['t'] = 'ajax-friend-group';
		$re = $this->lea->submit($url,$data,$this->cookie);
		$json = json_decode($re['body'],true);
		return $json;
	}

	/**
	 * 获取用户组下用户
	 * @param int $groupid 分组ID
	 * @param int $pageSize 每页显示数
	 * @param int $pageidx 当前页数
	 * @return array $list 用户数组
	 * @author Sydney
	 */
	public function getFriendList($groupid=0,$pageSize=15,$pageidx=0){
		$url = "https://mp.weixin.qq.com/cgi-bin/contactmanage?t=user/index&pagesize={$pageSize}&pageidx={$pageidx}&type=0&groupid={$groupid}&token={$this->webToken}&lang=zh_CN";
		$re = $this->lea->get($url,$this->cookie);
		if(!$re['body'])
			$this->login();
		$preg = '/<script type="text\/javascript">.*(\{"contacts".*\]\}).*\s*,\s*currentGroupId.*<\/script>/Us';
		preg_match_all($preg,$re['body'],$result);
		$list = json_decode($result[1][0],true);
		return $list['contacts'];
	}

	/**
	 * 获取用户消息
	 * @param int $fakeid  微信ID
	 * @param int $count 信息条数
	 * @return array $msgs
	 * @author Sydney
	 */
	public function getFriendMsg($fakeid,$count=20){
		$url = "https://mp.weixin.qq.com/cgi-bin/singlemsgpage?msgid=&source=&count={$count}&t=wxm-singlechat&fromfakeid={$fakeid}&token={$this->webToken}&lang=zh_CN";
		echo $url;
		$re = $this->lea->get($url,$this->cookie);
		return $re;
	}

	/**
	 *	修改备注
	 *	@param string $remark
	 *	@param int $fakeid
	 */
	public function setRemark($remark,$fakeid){
		$url = "https://mp.weixin.qq.com/cgi-bin/modifycontacts";
		$data = array();
		$data['remark'] = $remark;
		$data['tofakeuin'] = $fakeid;
		$data['token'] = $this->webToken;
		$data['lang'] = 'zh_CN';
		$data['t'] = 'ajax-response';
		$data['action'] = 'setremark';
		$re = $this->lea->submit($url,$data,$this->cookie);
		$json = json_decode($re['body'],true);
		return $json['ret'] == 0;
	}

	/*
	 得到最近发来的信息
    [0] => Array
        (
            [id] => 189
            [type] => 1
            [fileId] => 0
            [hasReply] => 0
            [fakeId] => 1477341521
            [nickName] => lealife
            [remarkName] => 
            [dateTime] => 1374253963
        )
        [ok]
	 */
	public function getLatestMsgs($page = 0) {
		// frommsgid是最新一条的msgid
		$frommsgid = 100000;
		$offset = 50 * $page;
		// $url = "https://mp.weixin.qq.com/cgi-bin/getmessage?t=ajax-message&lang=zh_CN&count=50&timeline=&day=&star=&frommsgid=$frommsgid&cgi=getmessage&offset=$offset";
		$url = "https://mp.weixin.qq.com/cgi-bin/message?t=message/list&count=999999&day=7&offset={$offset}&token={$this->webToken}&lang=zh_CN";
		$re = $this->lea->get($url, $this->cookie);
		// print_r($re['body']);

		// 解析得到数据
		// list : ({"msg_item":[{"id":}, {}]})
		$match = array();
		preg_match('/["\' ]msg_item["\' ]:\[{(.+?)}\]/', $re['body'], $match);
		if(count($match) != 2) {
			return "";
		}

		$match[1] = "[{". $match[1]. "}]";

		return json_decode($match[1], 1);
	}

	// 解析用户信息
	// 当有用户发送信息后, 如何得到用户的fakeId?
	// 1. 从web上得到最近发送的信息
	// 2. 将用户发送的信息与web上发送的信息进行对比, 如果内容和时间都正确, 那肯定是该用户
	// 		实践发现, 时间可能会不对, 相隔1-2s或10多秒也有可能, 此时如果内容相同就断定是该用户
	// 		如果用户在时间相隔很短的情况况下输入同样的内容很可能会出错, 此时可以这样解决: 提示用户输入一些随机数.
	
	/**
	 * 通过时间 和 内容 双重判断用户
	 * @param  [type] $createTime
	 * @param  [type] $content
	 * @return [type]
	 */
	public function getLatestMsgByCreateTimeAndContent($createTime, $content) {
		$lMsgs = $this->getLatestMsgs(0);

		// 最先的数据在前面

		$contentMatchedMsg = array();
		foreach($lMsgs as $msg) {
			// 仅仅时间符合
			if($msg['dateTime'] == $createTime) {
				// 内容+时间都符合
				if($msg['content'] == $content) { 
					return $msg;
				}

			// 仅仅是内容符合
			} else if($msg['content'] == $content) {
				$contentMatchedMsg[] = $msg;
			}
		}

		// 最后, 没有匹配到的数据, 内容符合, 而时间不符
		// 返回最新的一条
		if($contentMatchedMsg) {
			//return $lMsgs;
			return $contentMatchedMsg[0];
		}

		return false;
	}
}
