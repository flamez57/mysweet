<?php
class Replace{
  function hidtel($phone){
    $IsWhat = preg_match('/(0[0-9]{2,3}[\-]?[2-9][0-9]{6,7}[\-]?[0-9]?)/i',$phone); //固定电话
    if($IsWhat == 1){
        return preg_replace('/(0[0-9]{2,3}[\-]?[2-9])[0-9]{3,4}([0-9]{3}[\-]?[0-9]?)/i','$1****$2',$phone);
    }else{
        return  preg_replace('/(1[3578]{1}[0-9])[0-9]{4}([0-9]{4})/i','$1****$2',$phone);
    }
}
echo hidtel('17709705437');


$str = substr_replace('这个能发士大夫撒地方','****',3,24);
echo $str;



function maskName($str, $msask_len=2, $encode='utf-8'){
    $l = mb_strlen($str, $encode);
    if($l==0){
        return $str;
    }else if($l<=2){
        return mb_substr($str, 0, 1, $encode) . str_repeat('*', $msask_len);
    }else if($l==3){
        return mb_substr($str, 0, 1, $encode) . str_repeat('*', $msask_len) . mb_substr($str, -1, 1, $encode);
    }else{
        return mb_substr($str, 0, 2, $encode) . str_repeat('*', $msask_len) . mb_substr($str, -1, 1, $encode);
    }
}
}
