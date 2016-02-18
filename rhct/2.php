<?php
//a出现的概率是10%，b是20%，c是30%，d是40%
$pro = [
'a' =>100,
'b' =>0,
'c' =>0,
'd' =>0
];

function proRand($pro)
{
        $ret = '';
        $sum = array_sum($pro);
        foreach($pro as $k=>$v)
        {   
                $r = mt_rand(1, $sum);
                //echo $r . "\t" . $v . "\n";
                if($r <= $v) 
                {   
                        $ret = $k; 
                        break;
                }else{
                        $sum = max(0, $sum - $v);
                }   
        }   
        return $ret;
}
echo proRand($pro);