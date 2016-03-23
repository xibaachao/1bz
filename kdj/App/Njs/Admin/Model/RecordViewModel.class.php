<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-2-15
 * Time: 上午7:23
 */
class RecordViewModel extends ViewModel{
    public $viewFields = array(
        "Record"=>array(
            "no",
            "openid",
            "time",
            "outtime",
            "status",
            "prize_id",
            "name",
            "phone",
            "_type"=>"LEFT"
        ),"prize"=>array(
            "title",
            "_type"=>"LEFT",
            "_on"=>"Record.Prize_id=prize.id"
        )
    );
}