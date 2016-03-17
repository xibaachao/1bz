<?php 
class XmAction extends ManageAction{
	public function xx(){
		$this->assign("imgid",$_GET["id"]);
		$this->assign("list",D("img")->where(array("prize_id"=>$_GET["id"]))->select());
		$this->display();
	}
  /**
     * @desc 添加/发布数据
     */
    function imgadd()
    {
        $plist = M('column')->select();
        $this->assign('plist', $plist);
        $this->assign("imgid",$_GET["imgid"]);
        $this->display('imgadd');
    }

    /**
     * @desc 编辑
     */
    function imgedit()
    {
        $id = (int)$_GET['id'];
        $sign = D("img")->where("id=" . $id)->find();
        $this->assign('sign', $sign);
        $this->assign("imgid",$_GET["imgid"]);
        $this->display('imgadd');

    }
    
    
    function imgsave()
    {
    	$db = D("img");
    	if ($db->create()) {
    		if ($_POST['id'])
    			$rst = $db->where("id=" . $_POST['id'])->save();
    		else
    			$rst = $db->add();
    		if ($rst !== false)
    			$this->ajaxReturn('success', '操作成功', 1);
    		else
    			$this->ajaxReturn('faild', $db->getLastSql(), 0);
    	} else {
    		$this->ajaxReturn('faild1', $db->getLastSql(), 0);
    	}
    }
}
?>