<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/3/19 0019
 * Time: 下午 5:48
 */
class IndexAction extends BaseAction {
	// 这个是显示的方法
	function index() {
		
		$this->display ();
	}
	//首页
	function f1(){
		
		$this->display();
	}
	//第二页
	function f2(){
		$this->checkwin();
		if($_GET["man"]!=null)
		{
			$_SESSION["man"]=$_GET["man"];
			$this->assign("man",$_GET["man"]);
		}else{
			$thsi->redirect("index");
		}
		$this->display();
	}

	//失败
	function f3(){
		$this->display();
	}
	
	//奖品一
	function f4(){
		$this->checkwin();
		$this->display();
	}
	//奖品二
	function f5(){
		$this->checkwin();
		$this->display();
	}
		//奖品二
	function f6(){
		$this->checkwin();
		$this->display();
	}
		//奖品二
	function f7(){
		$this->checkwin();
		$this->display();
	}
	//检查是否领过奖
	function checkwin(){
		$user = cookie('USER_INFO');
		$one=D("win")->where(array("openid"=>$user["openid"]))->find();
		if($one["time"]>0)
		{
			$this->redirect($one["prize"]."?type=no");
		}
	}
	
	
	
}