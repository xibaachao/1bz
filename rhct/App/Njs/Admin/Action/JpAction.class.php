<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/19
 * Time: 5:07
 */
class JpAction extends Action{
    public function index(){
        $where["phone"]=array("like","%".$_GET["key"]."%");
        $where['_logic'] = 'OR';
        $list=D("jp")->where($where)->select();
        $this->assign("list",$list);
        $this->display();
    }
    public function abc(){
        $where["id"]=$_GET["id"];
        if(D("jp")->where($where)->save(array("status"=>1))){
            $this->success("领取成功");
        }else{
            $this->error("领取失败");
        }
    }
}