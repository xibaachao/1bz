<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/3/19 0019
 * Time: 下午 5:48
 */
class IndexAction extends BaseAction
{
    // 这个是显示的方法
    function index()
    {
       $openid = cookie("openid");
        $this->display();
    }

    function f1()
    {
    	$openid = cookie("openid");
        $temp = D("jp")->where(array("openid" => $openid))->find();
        if ($temp["id"] > 0) {
            $this->redirect("f7");
        }
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
        $openid = cookie("openid");
        $where["no"] = array('gt', 0);
        $where["type"] = $_SESSION["type"];
        $prize_arr = D("shop")->where($where)->select();
        foreach ($prize_arr as $key => $val) {
            $arr[$val['id']] = $val['jl'];
        }
        $id = $this->get_rand($arr);
        $this->assign("shop", D("shop")->where(array("id" => $id))->find());
        $data["shop_id"] = $id;
        $data["time"] = time();
        $data["openid"] = $openid;
        $temp = D("jp")->where(array("openid" => $openid))->find();
        if ($temp["shop_id"] != 19 && $temp["shop_id"] != 20 && $temp==null) {
            if ($temp["openid"] != null) {
               D("jp")->where(array("openid" => $openid))->save($data); 
            } else {
                D("jp")->add($data);
                D("shop")->where(array("id"=>$id))->setDec("no"); 
            }
        }else{
            $shop=D("jp")->where(array("openid" => $temp["openid"]))->find();
            $shop=D("shop")->where(array("id"=>$shop["shop_id"]))->find();
            $this->assign("shop",$shop);
        }
        $this->display();
    }

    //领取页面
    function f8()
    {
        $openid = cookie("openid");
        $temp = D("jp")->where(array("openid" => $openid))->find();
        if ($temp["shop_id"] != 19 && $temp["shop_id"] != 20 && $temp["name"] == "") {
            $this->assign("shopid", $_GET["id"]);
            $this->display(); 
        } else {
            $this->redirect("f7");
        }
    }

    //保存数据
    function sj()
    {
        $openid = cookie("openid");
        if (D("jp")->where(array("phone"=>$_POST["phone"]))->find()!=null) {
        	echo 2;
        	exit();
        }


        if (D("jp")->where(array("openid"=>$openid))->save($_POST) > 0) {
            echo 1;
        }
    } 
    /****
     * 计算几率
     */
    function get_rand($proArr)
    {
        $result = '';
        //概率数组的总概率精度
        $proSum = array_sum($proArr);
        //概率数组循环
        foreach ($proArr as $key => $proCur) {
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $proCur) {
                $result = $key;
                break;
            } else {
                $proSum -= $proCur;
            }
        }
        unset ($proArr);
        return $result;
    }



}