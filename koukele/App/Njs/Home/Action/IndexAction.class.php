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
	function f1() {
		$this->display ();
	}
	function f2() {
		$this->display ();
	}
	
	// 查询项目
	function f3() {
		$where =null;
		$id=$_GET["id"];
		$imgs = D ( "img" )->where ( array (
				"prize_id" => $id 
		) )->select ();
		
		$one = D ( "xm" )->where ( array (
				"id" => $id 
		) )->find ();
		$this->assign ( "one", $one );
		$this->assign ( "list", $imgs );
		$this->display ();
	}
	function f4() {
		$one = D ( "xm" )->where ( array (
				"id" => $_GET ["id"] 
		) )->find ();
		$one = D ( "xm" )->where ( array (
				"type" => $one ["type"] 
		) )->order ( "id asc" )->find ();
		$this->assign ( "one", $one );
		$this->assign ( "time", $_GET ["time"] );
		$this->display ();
	}
	// 抽奖
	function f5() {
		$openid = cookie ( "openid" );
		$year = date ( "Y" );
		$month = date ( "m" );
		$day = date ( "d" );
		$dayBegin = mktime ( 0, 0, 0, $month, $day, $year ); // 当天开始时间戳
		$dayEnd = mktime ( 23, 59, 59, $month, $day, $year ); // 当天结束时间戳
		$where ["time"] = array (
				'between',
				array (
						$dayBegin,
						$dayEnd 
				) 
		);
		$where ["openid"] = $openid;
		$user = D ( "win" )->where ( $where )->find ();
		$this->assign ( "user", $user );
		
		$prize_arr = D ( "prize" )->where ( "no>0" )->select ();
		foreach ( $prize_arr as $key => $val ) {
			$arr [$val ['id']] = $val ['jl'];
		}
		$id = $this->get_rand ( $arr );
		$id == "" ? 1:$id;
		if($id==1){
			$this->redirect("f7");
		}
		$this->assign ( "one", D ( "prize" )->where ( array (
				"id" => $id 
		) )->find () );
		$this->display ();
	}
	
	/**
	 * 保存信息
	 */
	function update() {
		$openid = cookie ( "openid" );
		$year = date ( "Y" );
		$month = date ( "m" );
		$day = date ( "d" );
		$dayBegin = mktime ( 0, 0, 0, $month, $day, $year ); // 当天开始时间戳
		$dayEnd = mktime ( 23, 59, 59, $month, $day, $year ); // 当天结束时间戳
		$iphone = D ( "win" )->where ( array (
				"iphone" => $_POST ["iphone"] 
		) )->find ();
		if ($iphone != null) {
			echo 1; // 手机重复
			exit ();
		}
		$where ["time"] = array (
				'between',
				array (
						$dayBegin,
						$dayEnd 
				) 
		);
		$where ["openid"] = $openid;
		$user = D ( "win" )->where ( $where )->find ();
		if ($user != null) {
			echo 2;
			exit ();
		}
		$_POST["time"]=time();
		$_POST["status"]=0;
		$_POST["openid"]=cookie("openid");
		if (D ( "win" )->where ( $where )->add ( $_POST )) {
			D("prize")->where(array("id"=>$_POST["prize_id"]))->setDec("no");			
			echo 3;
		}
	}
	
	/**
	 * 判断是否抽过
	 */
	function panduan() {
		$openid = cookie ( "openid" );
		$year = date ( "Y" );
		$month = date ( "m" );
		$day = date ( "d" );
		$dayBegin = mktime ( 0, 0, 0, $month, $day, $year ); // 当天开始时间戳
		$dayEnd = mktime ( 23, 59, 59, $month, $day, $year ); // 当天结束时间戳
		$iphone = D ( "win" )->where ( array (
				"iphone" => $_POST ["iphone"] 
		) )->find ();
		if ($iphone != null) {
			echo 1; // 手机重复
			exit ();
		}
		$where ["time"] = array (
				'between',
				array (
						$dayBegin,
						$dayEnd 
				) 
		);
		$user = D ( "win" )->where ( $where )->find ();
		if ($user != null) {
			echo 2;
			exit ();
		}
		echo 3;
	}
	
	/**
	 * **
	 * 计算几率
	 */
	function get_rand($proArr) {
		$result = '';
		// 概率数组的总概率精度
		$proSum = array_sum ( $proArr );
		// 概率数组循环
		foreach ( $proArr as $key => $proCur ) {
			$randNum = mt_rand ( 1, $proSum );
			if ($randNum <= $proCur) {
				$result = $key;
				break;
			} else {
				$proSum -= $proCur;
			}
		}
		unset ( $proArr );
		return $result;
	}
	function temp() {
		$one = D ( "xm" )->where ( array (
				"id" => $_GET ["id"] 
		) )->find ();
		if ($one ["id"] == 1) {
			$this->assign ( "temp", "33_03.png" );
		}
		if ($one ["id"] == 2) {
			$this->assign ( "temp", "43_03.png" );
		}
		if ($one ["id"] == 3) {
			$this->assign ( "temp", "53_03.png" );
		}
		
		$one = D ( "xm" )->where ( array (
				"type" => $one ["type"] 
		) )->order ( "id desc" )->find ();
		$this->assign ( "one", $one );
		$this->assign ( "time", $_GET ["time"] );
		
		$this->display ();
	}
	/**
	 * 抽不到将
	 */
	function f7(){
		$this->display();
	}
}