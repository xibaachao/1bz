<?php



class IndexAction extends BaseAction

{

    function index()

    {

        $this->assign('grouplist', $this->grouplist);

        $this->webToken = $this->wx->webToken;

        $this->display();

    }



    function home()

    {

        $this->display();

    }



    /**

     * 基本功能

     */

    function basic()

    {

        $this->display('basic');

    }



    /**

     *    登录

     */

    function loginOn()

    {

        $name = $this->_post('username');

        $pwd = md5($this->_post('password'));

        $sign = M("User")->where("name='{$name}'")->find();

        //echo M("User")->getLastSql();

        if (!$sign)

            $this->error('账号不存在,请重试');

        if ($sign['pwd'] != $pwd)

            $this->error('登录密码不正确!');

        session('login_user', $sign);

        if (isset($_POST['remember']) && (int)$_POST['remember'] == 1) { //记住我

            cookie('login_user', $sign);

        }

        $this->redirect('Index/index');

    }



    /**

     * 注销

     */

    function loginOff()

    {

        session('login_user', null);

        unset($_SESSION['login_user']);

        cookie('login_user', null);

        $this->redirect('Index/login');

    }



    /**

     *微信账号信息设置

     */

    function set()

    {

        //var_dump($_POST);

        if (IS_AJAX) {

            unset($_POST['submit']);

            $err = 0;

            foreach ($_POST as $key => $val) {

                $sign = M("Config")->where("`key`='{$key}'")->find();

                //echo  M("Config")->getLastSql();

                if ($sign) {

                    $rst = M("Config")->where("`key`='{$key}'")->save(array('val' => $val));

                } else {

                    $rst = M("Config")->add(array('key' => $key, 'val' => $val));

                }

                $err += $rst !== false ? 0 : 1;

            }

            echo json_encode(array(

                'msg' => $err > 0 ? '系统设置保存失败' . $err . '条' : '系统设置保存成功',

            ));

        } else {

            $config = get_config();

            $this->assign('sign', $config);

            $this->display();

        }

    }

}



?>

