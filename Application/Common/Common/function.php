<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/13 0013
 * Time: 下午 12:37
 */

/**
 * @param $arr  //被循环的数组
 * @param $data //值
 * @param $name //键名
 * @return bool //返回false有重复，反之
 */
// 用户名判重
function isRepeat($arr,$data,$name) {
    global $ok;
    $ok = 0;
    foreach ( $arr as $value) {
        $repeat = $value[$name];
        if( $data === $repeat ){
            $ok = 1;
        }
    }
    if( $ok === 1 ){
        return false;
    }else{
        return true;
    }
}