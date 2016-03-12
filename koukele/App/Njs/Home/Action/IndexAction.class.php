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
	   $this->display();
	}
	function f1(){
	    $this->display();
	}
	function f2(){
	    $this->display();
	}
	function f3(){
	    $this->display();
	}
	function ff()
	{
		$_SESSION["a"]=$_GET["aa"];
	    $this->display();
	}
	function f4(){
		$_SESSION["a"]=$_GET["aa"];
	    $this->display();
	}
	function f5(){
		$_SESSION["b"]=$_GET["aa"];
	    $this->display();
	}
	function f6(){
		$_SESSION["c"]=$_GET["aa"];
	    $this->display();
	}
	function music(){
	    $this->display();
	}
	function f7(){
		$_SESSION["d"]=$_GET["aa"];
		$rs=$_SESSION;

         foreach($rs as $v){  
	      if (isset($rs[$v])) {
	         $rs[$v]++;    
	      } else {
	         $rs[$v] = 1;
	      }
	  }
    	if ($rs[1]>=3) {
    		$this->f9();
    		exit();
    	}
    	if ($rs[2]>=3) {
    		$this->f8();
    		exit();
    	}
    	if($rs[3]>=3)
    	{
    		$this->display();
    		exit();
    	}
    	$xx= rand(1, 3);
    	switch ($xx) {
    		case 1:
    			$this->display();
    			break;
    		case 2:
    			$this->f8();
    			break;
    			case 3:
    			$this->f9();
    			break;
    		default:
    			# code...
    			break;
    	}
    	
		
	}
	function f8(){
		$this->display("f8");
	}
	function f9(){
		$this->display("f9");
	}
		
}