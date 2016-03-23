<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/3/19 0019
 * Time: 下午 5:48
 */
class IndexAction extends Action {
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
		if($_GET["man"]!=null)
		{
			$_SESSION["man"]=$_GET["man"];
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
		$this->display();
	}
	//奖品二
	function f5(){
		$this->display();
	}
}