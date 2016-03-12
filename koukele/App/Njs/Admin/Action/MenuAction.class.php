<?php

//微信公众平台自定义菜单
class MenuAction extends BaseAction
{
    function index()
    {
        $list = M("Menu")->order("sort desc,id asc")->select();
        vendor("Tree.Tree");
        $tree = new Tree();
        $tree->Tree($list, 'pid');
        $list = $tree->getArray();
        foreach ($list as $key => $val) {
            $list[$key]['count'] = M("Menu")->where("pid=" . $val['id'])->count();
        }
        $this->assign('list', $list);
        $this->display('index');
    }

    function add()
    {
        $list = M("Menu")->order("sort desc,id asc")->where("pid=0")->select();
        foreach ($list as $k => $v) {
            $list[$k]['count'] = M("Menu")->where("pid=" . $v['id'])->count(); //子菜单个数
        }
        $this->assign('top_size', count($list)); //顶级菜单个数
        $this->assign('plist', $list);
        $this->display('add');
    }

    function edit()
    {
        $id = (int)$_GET['id'];
        $sign = M("Menu")->where("id=" . $id)->find();
        $list = M("Menu")->order("sort desc,id asc")->where("pid=0")->select();
        $this->assign('plist', $list);
        $this->assign('sign', $sign);
        $this->display('add');
    }

    function save()
    {
        if (IS_POST) {
            $db = M("Menu");
            $db->create();
            if (isset($_POST['id']) && (int)$_POST['id'] > 0) {
                $db->where("id=" . (int)$_POST['id'])->save();
            } else {
                $db->add();
            }
            flash('menu-msg', '菜单操作成功');
            $this->redirect('Menu/index', array('state' => 1));
        } else {
            $this->error('非法访问');
        }
    }

    public function get_menu()
    {
        $list = M("Menu")->where("pid=0")->order("sort desc")->select();
        $json_arr = array();
        foreach ($list as $key => $val) {
            $item = array();
            $sub = M("Menu")->where("pid=" . $val['id'])->order("sort desc,id asc")->select();
            if (count($sub) == 0) {
                $item = array(
                    'type' => $val['type'],
                    'name' => $val['name'],
                );
                if ($val['type'] == 'click') {
                    $item['key'] = $val['key'];
                } elseif ($val['type'] == 'view') {
                    $item['url'] = $val['url'];
                }
            } else {
                $item['name'] = $val['name'];
                foreach ($sub as $v) {
                    $sub_item = array();
                    $sub_item['type'] = $v['type'];
                    $sub_item['name'] = $v['name'];
                    if ($v['type'] == 'click') {
                        $sub_item['key'] = $v['key'];
                    } elseif ($v['type'] == 'view') {
                        $sub_item['url'] = $v['url'];
                    }
                    $item['sub_button'][] = $sub_item;
                }
            }
            $json_arr['button'][] = $item;
        }
        return $json_arr;
    }

    /**
     * 获取token
     * 2013年9月28日10时更新,改用LeaWeiXinClient获取数据替换file_get_contents
     */
    function get_access_token()
    {
        $config = get_config();
        $token_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$config['AppId']}&secret={$config['AppSecret']}";
        //$token_json = file_get_contents($token_url);
        vendor('Wx.LeaWeiXinClient');
        $lea = new LeaWeiXinClient();
        $token_json = $lea->get($token_url, null);
        $token_json = $token_json['body'];
        $token_arr = json_decode($token_json, true);
        return $token_arr['access_token'];
    }

    function del()
    {
        $id = (int)$_GET['id'];
        M("Menu")->where("id=" . $id)->delete();
        $this->redirect("Menu/index");
    }

    //应用设置
    function apply()
    {
        $token_str = self::get_access_token();
        $del_url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token={$token_str}";
        file_get_contents($del_url);
        $apply_url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$token_str}";
        $data = self::JSON(self::get_menu());
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apply_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        //return $tmpInfo;
        $result = json_decode($result, true);
        //dump($result);
        //exit;
        flash('menu-msg', $result['errcode'] == 0 ? '操作成功' : '操作失败');
        $this->redirect("Menu/index", array(
            'state' => $result['errcode'] == 0 ? 0 : 1
        ));
    }
    //这个是拉取用的方法
    function lq(){
        $token_str = self::get_access_token();
        $url="https://api.weixin.qq.com/cgi-bin/user/get?access_token=$token_str";
         $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $result = json_decode($result, true);
        for($i=0;$i<count($result["data"]["openid"]);$i++)
        {
            $aa["openid"]=$result["data"]["openid"][$i];
            D("yh")->add($aa);
        }
        var_dump($result);
    }



    /**************************************************************
     *
     *    使用特定function对数组中所有元素做处理
     * @param    string &$array 要处理的字符串
     * @param    string $function 要执行的函数
     * @return boolean    $apply_to_keys_also        是否也应用到key上
     * @access public
     *
     *************************************************************/
    function arrayRecursive(&$array, $function, $apply_to_keys_also = false)
    {
        static $recursive_counter = 0;
        if (++$recursive_counter > 1000) {
            die('possible deep recursion attack');
        }
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                self::arrayRecursive($array[$key], $function, $apply_to_keys_also);
            } else {
                $array[$key] = $function($value);
            }

            if ($apply_to_keys_also && is_string($key)) {
                $new_key = $function($key);
                if ($new_key != $key) {
                    $array[$new_key] = $array[$key];
                    unset($array[$key]);
                }
            }
        }
        $recursive_counter--;
    }

    /**************************************************************
     *
     *    将数组转换为JSON字符串（兼容中文）
     * @param    array $array 要转换的数组
     * @return string        转换得到的json字符串
     * @access public
     *
     *************************************************************/
    function JSON($array)
    {
        self::arrayRecursive($array, 'urlencode', true);
        $json = json_encode($array);
        return urldecode($json);
    }

}

?>
