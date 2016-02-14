<?php
class CatAction extends ManageAction{
	public function show_ok(){
		if(D("Cat")->where(array("id"=>$_GET["id"]))->save(array("is_show"=>1))){
			$this->success("显示成功！");
		}
	}
	public function show_no(){
		if(D("Cat")->where(array("id"=>$_GET["id"]))->save(array("is_show"=>0))){
			$this->success("隐藏成功！");
		}
	}
}