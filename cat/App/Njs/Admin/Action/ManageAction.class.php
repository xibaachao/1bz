<?php

class ManageAction extends Action
{

    protected $actModel = MODULE_NAME;
    protected $selModel = MODULE_NAME;
    protected $orderBy = 'id desc';

    function _initialize()
    {
        if (method_exists($this, 'init')) $this->init();
        $allow_act = explode(",", "login,loginOn,loginOff");
        $cookie = cookie('login_user');
        if ($cookie)
            session('login_user', $cookie);
        if (!in_array(ACTION_NAME, $allow_act)) {
            $uname = session('login_user.name');
            if (empty($uname)) {
                exit('<script>window.top.location="' . U('Index/login') . '";</script>');
            }

        }
    }

    /**
     * @desc 设置查询条件(列表页)
     */
    function setFilter(&$where)
    {
        foreach ($_GET as $k => $v) {
            $this->assign('key_' . $k, $v);
        }
    }


    /**
     * @desc 列表页面
     */
    function index()
    {
        import("@.Util.Page");
        $db = D($this->selModel);
        $where = array();
        $this->setFilter($where);
        $count = $db->where($where)->count();
        $page = new Page($count, 15);
        $page->setConfig('theme', "%upPage% %linkPage% %downPage%");
        $list = $db->where($where)->limit($page->firstRow . ',' . $page->listRows)->order($this->orderBy)->select();
       // echo D()->getLastSql();
        $this->assign('page', $page);
        $this->assign('list', $list);
        $this->display('index');
    }

    /**
     * @desc 添加/发布数据
     */
    function add()
    {
        $plist = M('column')->select();
        $this->assign('plist', $plist);
        $this->display('add');
    }

    /**
     * @desc 编辑
     */
    function edit()
    {
        $id = (int)$_GET['id'];
        $sign = D($this->actModel)->where("id=" . $id)->find();
        $this->assign('sign', $sign);
        $this->display('add');

    }

    /**
     * @desc 修改/添加数据
     */
    function save()
    {
        $db = D($this->actModel);
        if ($db->create()) {
            if ($_POST['id'])
                $rst = $db->where("id=" . $_POST['id'])->save();
            else
                $rst = $db->add();
            if ($rst !== false)
                $this->ajaxReturn('success', '操作成功', 1);
            else
                $this->ajaxReturn('faild', $db->getLastSql(), 0);
        } else {
            $this->ajaxReturn('faild1', $db->getLastSql(), 0);
        }
    }

    /**
     * @desc 正常删除
     */
    function del()
    {
        $id = $_REQUEST['id'];
        $db = D($this->actModel);
        $rst = $db->where("id in($id)")->delete();
        if ($rst !== false) {
            $this->redirect(MODULE_NAME . '/index');
        } else {
            $this->error('删除失败', U(MODULE_NAME . '/index'), 2);
            //echo D()->getLastSql();
        }
    }

    /**
     * @desc ajax批量删除
     */
    function ajaxBatDel()
    {
        $id = $_REQUEST['ids'];
        $db = D($this->actModel);
        $rst = $db->where(array('id' => array('in', $id)))->delete();
        if ($rst !== false) {
            $this->ajaxReturn('', 'success', 1);
        } else {
            $this->ajaxReturn('', 'error', 0);
        }
    }

}

?>