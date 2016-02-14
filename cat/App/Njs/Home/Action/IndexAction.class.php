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
		if($_GET["zr"]!=null)
		{
			$this->assign("list",D("cat")->order("vote desc")->select());
			$this->assign("zr",1);
		}else
		{
			$this->assign("list",D("cat")->order("id desc")->select());
		}
		$this->display ( "index" );
	}
	// 这个是报名的页面
	function baoming() {
		$user = cookie ( 'USER_INFO' );

		$one=D("cat")->where(array("openid"=>$user["openid"]))->find();
		if($one["id"]!=null || $one["id"]>0)
		{
			//$this->redirect("getvote?id=".$one["id"]);
		}
		$this->display ();
	}
	// 这个是报名的方法
	function savebao() {
		$user = cookie ( 'USER_INFO' );
		$_POST ["openid"] = $user ["openid"];
		$_POST["time"]=date("Y-m-d H:i:s");
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 31457280 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  './Public/yt/';// 设置附件上传目录
		if(!$upload->upload()) {// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		 }else{// 上传成功 获取上传文件信息
		 	$info =  $upload->getUploadFileInfo();
		 }

		 if($info[0]["savename"]!=null && $info[0]["savename"]!="")
		 {
			$im=imagecreatefromjpeg("./Public/yt/".$info[0]['savename']);//参数是图片的存方路径
			$maxwidth="310";//设置图片的最大宽度
			$maxheight="700";//设置图片的最大高度
			$name="./Public/upload/".$info[0]['savename'];//图片的名称，随便取吧
			$this->resizeImage($im,$maxwidth,$maxheight,$name);//调用上面的函数
			$this->resizeImage($im,$maxwidth,$maxheight,$name);//调用上面的函数
			$this->resizeImage($im,$maxwidth,$maxheight,$name);//调用上面的函数
		 	$_POST["img1"]=__PUBLIC__.'/Upload/'.$info[0]['savename'];
		 	
		 }
		 if($info[1]["savename"]!=null && $info[1]["savename"]!="")
		 {
		 	$im=imagecreatefromjpeg("./Public/yt/".$info[1]['savename']);//参数是图片的存方路径
			$maxwidth="310";//设置图片的最大宽度
			$maxheight="700";//设置图片的最大高度
			$name="./Public/upload/".$info[1]['savename'];//图片的名称，随便取吧
			$this->resizeImage($im,$maxwidth,$maxheight,$name);//调用上面的函数
			$this->resizeImage($im,$maxwidth,$maxheight,$name);//调用上面的函数
			$this->resizeImage($im,$maxwidth,$maxheight,$name);//调用上面的函数
		 	$_POST["img2"]=__PUBLIC__.'/Upload/'.$info[1]['savename'];
		 }
		 if($info[2]["savename"]!=null && $info[2]["savename"]!="")
		 {
		 	$im=imagecreatefromjpeg("./Public/yt/".$info[2]['savename']);//参数是图片的存方路径
			$maxwidth="310";//设置图片的最大宽度
			$maxheight="700";//设置图片的最大高度
			$name="./Public/upload/".$info[2]['savename'];//图片的名称，随便取吧
			$this->resizeImage($im,$maxwidth,$maxheight,$name);//调用上面的函数
			$this->resizeImage($im,$maxwidth,$maxheight,$name);//调用上面的函数
			$this->resizeImage($im,$maxwidth,$maxheight,$name);//调用上面的函数
		 	$_POST["img3"]=__PUBLIC__.'/Upload/'.$info[2]['savename'];
		 }
		 if($info[3]["savename"]!=null && $info[3]["savename"]!="")
		 {
		 	$im=imagecreatefromjpeg("./Public/yt/".$info[3]['savename']);//参数是图片的存方路径
			$maxwidth="310";//设置图片的最大宽度
			$maxheight="700";//设置图片的最大高度
			$name="./Public/upload/".$info[3]['savename'];//图片的名称，随便取吧
			$this->resizeImage($im,$maxwidth,$maxheight,$name);//调用上面的函数
			$this->resizeImage($im,$maxwidth,$maxheight,$name);//调用上面的函数
			$this->resizeImage($im,$maxwidth,$maxheight,$name);//调用上面的函数
		 	$_POST["img4"]=__PUBLIC__.'/Upload/'.$info[3]['savename'];
		 }
		 $one=D("Cat")->add($_POST);
		 if($one){
		 	$this->assign("one",$one);
		 	$this->display("baosuccess");
		 }else{
		 	$this->display("baoerro");
		 }
		}
	// 这个是投票的页面
		function getvote() {
			$one = D ("cat" )->where ( array (
				"id" => $_GET ["id"],
				"is_show" => 1 
				) )->find ();
			$this->assign("one",$one);
			$this->display();
		}
	//这个是投票的方法
		function vote(){
			$user = cookie ( 'USER_INFO' );
		 $one=D("yh")->where(array("openid"=>$user["openid"]))->find();
          if ($one!=null) {            
          }else{
            echo "-1";
            exit();
          }


		
// 		判断是否投过了
		$begin_day = date("Y-m-d 00:00:00");//开始时间
		$end_day = date("Y-m-d H:i:s");//现在的时间
		$where["openid"]=$user["openid"];
		$where["time"]=array('between',array($begin_day,$end_day));
		$where["cat_id"]=$_POST["cat_id"];
		$one=D("vote")->where($where)->find();
		if($one!=null)
		{
// 			表示投票过了的
			echo 0;
		}else{
			$_POST["name"]=$user["nickname"];
			$_POST["openid"]=$user["openid"];
			$_POST["time"]=date("Y-m-d H:i:s");
			$temp=D("vote")->add($_POST);
			D("cat")->where(array("id"=>$_POST["cat_id"]))->setInc("vote");
			
			if(!$temp)
			{
// 				表示投票失败
				echo D()->getLastSql();
			}
			echo 1;
		}
	}
	function resizeImage($im,$maxwidth,$maxheight,$name)
	{
		$pic_width = imagesx($im);
		$pic_height = imagesy($im);

		if(($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight))
		{
			if($maxwidth && $pic_width>$maxwidth)
			{
				$widthratio = $maxwidth/$pic_width;
				$resizewidth_tag = true;
			}

			if($maxheight && $pic_height>$maxheight)
			{
				$heightratio = $maxheight/$pic_height;
				$resizeheight_tag = true;
			}

			if($resizewidth_tag && $resizeheight_tag)
			{
				if($widthratio<$heightratio)
					$ratio = $widthratio;
				else
					$ratio = $heightratio;
			}

			if($resizewidth_tag && !$resizeheight_tag)
				$ratio = $widthratio;
			if($resizeheight_tag && !$resizewidth_tag)
				$ratio = $heightratio;

			$newwidth = $pic_width * $ratio;
			$newheight = $pic_height * $ratio;

			if(function_exists("imagecopyresampled"))
			{
    $newim = imagecreatetruecolor($newwidth,$newheight);//PHP系统函数
      imagecopyresampled($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);//PHP系统函数
  }
  else
  {
  	$newim = imagecreate($newwidth,$newheight);
  	imagecopyresized($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
  }

  imagejpeg($newim,$name);
  imagedestroy($newim);
  
}
else
{
	imagejpeg($im,$name);
}
}
}