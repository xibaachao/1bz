<?php

class MsgAction extends BaseAction
{

    //设置列表
    function index()
    {
        import("@.Util.Page");
        $count = M("Msg")->count();
        $page = new Page($count, 15);
        $page->setConfig('theme', "%upPage% %linkPage% %downPage%");
        $list = M("Msg")->order("sort desc,id asc")->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign('page', $page);
        $this->assign('list', $list);
        $this->display('index');
    }

    function edit()
    {
        $id = (int)$_GET['id'];
        $sign = M("Msg")->where("id=" . $id)->find();
        if ($sign['type'] == 2)
            $sign['reply'] = unserialize($sign['reply']);
        //dump($sign);
        $this->assign("sign", $sign);
        $this->display('keyMsg');
    }

    function save($where = "", $opt = array())
    {
        if (IS_POST) {
            $type = (int)$_POST['type'];
            $data = array();
            $data['type'] = $type;
            $data['code'] = '';
            $data['state'] = 1;
            $data['keyword'] = '';
            $data['remark'] = $_POST['remark'];
            if ($type == 1) { //文本信息
                $data['reply'] = htmlspecialchars($_POST['msg']);
            } elseif ($type == 2) { //图文消息
                $art = array();
                $img = $_POST['img'];
                $url = $_POST['url'];
                $desc = $_POST['desc'];
                $title = $_POST['title'];
                foreach ($img as $key => $val) {
                    if (empty($img[$key]) && empty($desc[$key]) && empty($url[$key])) {
                        continue;
                    } else {
                        $art[] = array(
                            'desc' => $desc[$key],
                            'url' => $url[$key],
                            'img' => $img[$key],
                            'title' => $title[$key],
                        );
                    }
                }
                $data['reply'] = serialize($art);
            }
            $data = array_merge($data, $opt);
            $sign = M("Msg")->where($where)->find();
            if ($sign) {
                $rst = M("Msg")->where($where)->save($data);
            } else {
                $rst = M("Msg")->add($data);
            }
            return $rst;
        }
        return false;
    }

    //关键字消息设置
    function keyMsg()
    {
        if (IS_POST) {
            $key = $_POST['key'];
            $id = $_POST['id'];
            $rst = self::save("`id`='$id'", array(
                'keyword' => $key,
                'code' => '',
            ));
            //$this->redirect("Msg/keyMsg",array('state'=>$rst!==false ? 1 : 0));
            $this->redirect("Msg/index");
        } else {
            $this->display('keyMsg');
        }

    }

    function del()
    {
        $id = $_GET['ids'];
        $rst = M("Msg")->where("id in ($id)")->delete();
        $this->redirect("Msg/index", array('state' => $rst !== false ? 1 : 0, 'msg' => $rst !== false ? '删除成功' : '删除失败'));
    }

}
