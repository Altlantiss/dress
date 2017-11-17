<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/11 0011
 * Time: 下午 3:06
 */

namespace Home\Controller;
use Think\Controller;

class StorageController extends Controller {
    //库存列表
    public function showList() {
        $storage = M("Storage");//实例化库存表

        $result = $storage -> join("dress_dresses ON dress_storage.id = dress_dresses.id") ->Field("dress_name,dress_sex,dress_number") ->select();
        //获取库存表和礼服表里面相同id的礼服名称，适用性别，礼服数量
        iF( $result ){
            $res = array(
                "status" => 1,
                "message" => "查询成功！",
                "data" => $result//返回数据
            );
            echo json_encode($res);
        }else{
            $res = array(
                "status" => 0,
                "message" => "查询失败，错误原因：".mysql_error()."<br>",
//              "data" => ""
            );
            echo json_encode($res);
        }
    }
    
}