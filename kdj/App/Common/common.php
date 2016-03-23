<?php 
//获取配置项
function get_config(){
	$list = M("Config")->select();
	$rst = array();
	foreach($list as $k=>$v){
		$rst[$v['key']] = $v['val'];
	}
	return $rst;
}
function get_rating($id)
{
	$temp=C("rating");
	return $temp[$id];
}

function get_flavor($id)
{
	$temp=C("flavor");
	return $temp[$id];
}
function get_condition($id)
{
	$temp=C("condition");
	return $temp[$id];
}

function get_state(){
	return func_get_arg(func_get_arg(0)+1);
}
/**
str:原字符串
type：类型，0为后补，1为前补
len：新字符串长度
msg：填补字符
 */

function dispRepair($str,$len,$msg,$type='1') {
    $length = $len - strlen($str);
    if($length<1)return $str;
    if ($type == 1) {
        $str = str_repeat($msg,$length).$str;
    } else {
        $str .= str_repeat($msg,$length);
    }
    return $str;
}

/**
 * 判断是否微信浏览器
 */
function is_weixin(){
	return strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false;
}

function write_log($str){
	$han = fopen("./Public/logs/log.html","w+");
	fwrite($han,$str."<br/>");
	fclose($han);
}

/**
 * flash('xx')
 * flash:sydney 最新存入
 * flash:hxtgirq 已存入且可用
 */
function flash($key='',$val=''){
	if(!empty($key) && !empty($val)){
		$_SESSION['flash:sydney'][$key] = $val; 
	}elseif(!empty($key) && $val===''){
		$fl = isset($_SESSION['flash:sydney']) ? $_SESSION['flash:sydney'] : array();
		$fl1 = isset($_SESSION['flash:hxtgirq']) ? $_SESSION['flash:hxtgirq'] : array();
		$flash = array_merge($fl1,$fl);
		return $flash[$key];
	}elseif(empty($key)){
		$_SESSION['flash:hxtgirq'] = $_SESSION['flash:sydney'];
		$_SESSION['flash:sydney'] = array(); 
	}
}

/**
	 +----------------------------------------------------------
	 * 剪切字符串函数
	 +-----------------------------------------------------------
	 * @return string
	 +-----------------------------------------------------------
	 */
	function cutstr ($data, $no, $le = '') {
		$data = strip_tags(htmlspecialchars_decode($data));
		$data = str_replace(array("\r\n", "\n\n", "\r\r", "\n", "\r"), '', $data);
		$datal = strlen($data);
		$str = msubstr710($data, 0, $no);
		$datae = strlen($str);
		if ($datal > $datae)
			$str .= $le;
		return $str."...";
	}

	function msubstr710($str, $start=0, $length, $charset="utf-8", $suffix=true){
		if(function_exists("mb_substr"))
			return mb_substr($str, $start, $length, $charset);
		elseif(function_exists('iconv_substr')) {
			return iconv_substr($str,$start,$length,$charset);
		}
		$re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		$re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		$re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
		preg_match_all($re[$charset], $str, $match);
		$slice = join("",array_slice($match[0], $start, $length));
		if($suffix) return $slice."…";
		return $slice;
	}

	/**
	 * 获取token
	 * 2013年9月28日10时更新,改用LeaWeiXinClient获取数据替换file_get_contents
	 */
	function get_access_token(){
		$config = get_config();
		$token_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$config['AppId']}&secret={$config['AppSecret']}";
		vendor('Wx.LeaWeiXinClient');
		$lea = new LeaWeiXinClient();
		$token_json = $lea->get($token_url,null);
		$token_json = $token_json['body'];
		$token_arr = json_decode($token_json,true);
		return $token_arr['access_token'];
	}

	function get_user_group(){
		$access_token = get_access_token();
		$url = "https://api.weixin.qq.com/cgi-bin/groups/get?access_token=".$access_token;
		vendor("wx.LeadWeiXinClient");
		$lea = new LeaWeiXinClient();
		$re = $lea->get($url,null);
		dump($re);
	}

/**
 * @Desc: 为URL添加GET参数
 * @User: Njs
 * @param String $url 将要添加参数的地址
 * @param Array $addQueryArr 要添加的参数数组
 * @return String $newUrl 返回添加参数后的地址
 */
function addQuery($url,$addQueryArr=array('openid'=>':openid:')){
    $info = parse_url($url);
    $qr = explode('&',$info['query']);
    $query = array();
    foreach($qr as $val){
        $tmp = explode('=',$val);
        $query[$tmp[0]] = $tmp[1];
    }
    $query = array_merge($query,$addQueryArr);
    $queryStr = '';
    foreach($query as $k=>$v){
        if(empty($k)) continue;
        $queryStr .= $k.'='.$v.'&';
    }
    $queryStr = $queryStr ? "?".rtrim($queryStr,'&') : '';
    $newUrl = ($info['scheme'] ? $info['scheme'].'://' : '').$info['host'].$info['path'].$queryStr;
    return $newUrl;
}

/**
 * @Desc: 为字符串中的URL地址添加GET参数
 * @User: Njs
 * @param String $str
 * @param Array $addQueryArr 参数数组
 * @return String $newStr 为字符串中地址添加了参数的数组
 */
function strAddQuery($str,$addQueryArr=array()){
    $preg = '~href=(?:[\'"])?(.*?)(?:[\'"])~i';
    preg_match_all($preg,$str,$rst);
    $urls = $rst[1];
    $rurl = array();
    foreach($urls as $url){
        if(empty($url)) {
            continue;
        }
        $rurl[] = addQuery($url,$addQueryArr);
    }
    $str = str_replace($urls,$rurl,$str);
    return $str;
}

/**
 * 发送HTTP请求方法，目前只支持CURL发送请求
 * @param  string $url    请求URL
 * @param  array  $params 请求参数
 * @param  string $method 请求方法GET/POST
 * @return array  $data   响应数据
 */
function http($url, $params, $method = 'GET', $header = array(), $multi = false){
    $opts = array(
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_HTTPHEADER     => $header
    );
    /* 根据请求类型设置特定参数 */
    switch(strtoupper($method)){
        case 'GET':
            $opts[CURLOPT_URL] = $url . '?' . str_replace("&amp;","&",http_build_query($params));
            break;
        case 'POST':
            //判断是否传输文件
            //$params = $multi ? $params : http_build_query($params);
            $opts[CURLOPT_URL] = $url;
            $opts[CURLOPT_POST] = 1;
            $opts[CURLOPT_POSTFIELDS] = $params;
            break;
        default:
            throw new Exception('不支持的请求方式！');
    }
    /* 初始化并执行curl请求 */
    $ch = curl_init();
    curl_setopt_array($ch, $opts);
    $data  = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);
    if($error) throw new Exception('请求发生错误：' . $error);
    return  $data;
}
function getstatus($id)
{
	$temp=C("status");
	return $temp[$id];
}

?>