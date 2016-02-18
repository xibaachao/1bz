<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/3/19 0019
 * Time: 下午 5:48
 */
class IndexAction extends Action
{
    // 这个是显示的方法
    function index()
    {
        $this->display();
    }

    function f1()
    {
        $this->display();
    }

    function f2()
    {
        $this->display();
    }

    function f3()
    {
        $_SESSION["type"] = $_GET["type"];
        $this->display();
    }

    //第一个宝箱
    function f4()
    {
        $this->display();
    }

    //第二个宝箱
    function f5()
    {
        $this->display();
    }

    //第三个宝箱
    function f6()
    {
        $this->display();
    }

    //获取商品 开始抽奖
    function f7()
    {
        $where["no"]=array('gt',0);
        $where["type"]=$_SESSION["type"];
        $all=D("shop")->where($where)->field("id,jl")->select();
        $temp="";
        for($i=0;$i<count($all);$i++)
        {
            $temp[$all[$i]["id"]]=$all[$i]["jl"];
        }
        $id= $this->proRand($temp);
        $this->assign("shop",D("shop")->where(array("id"=>$id))->find());
        $this->display();
    }

    //领取页面
    function f8()
    {
        $this->assign("shopid",$_GET["id"]);
        $this->display();
    }

    //保存数据
    function sj()
    {
        $_POST["time"] = time();
        if(D("jp")->add($_POST)>0){
            echo 1;
        }
    }

    //领取成功的页面
    function f9()
    {

    }

    /****
     * 计算几率
     */
    function proRand($pro)
    {
        $ret = '';
        $sum = array_sum($pro);
        foreach ($pro as $k => $v) {
            $r = mt_rand(1, $sum);
            if ($r <= $v) {
                $ret = $k;
                break;
            } else {
                $sum = max(0, $sum - $v);
            }
        }
        return $ret;
    }

}