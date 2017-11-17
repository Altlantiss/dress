<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9 0009
 * Time: 下午 3:03
 */

namespace Home\Controller;
use Think\Controller;

class PurchaseController extends Controller {
    //显示进货列表
    public function purchaseList(){
        $list = M("Dresses");//实例化礼服表

        $result = $list ->field("did",true) ->select();//获取礼服表里除did字段的内容

        if( $result ){//如果成功
            $res = array(
                "status" => 1,
                "message" => "查询成功！",
                "data" => $result  //输出数据
            );
            echo json_encode($res);//输出响应
        }else{
            $res = array(
                "status" => 0,
                "message" => "查询失败，错误原因：".mysql_error()."<br>",
//            "data" => ""
            );
            echo json_encode($res);
        }
    }
    //进货功能
    public function purchase(){
        $storage = M("Storage");//实例化库存表

        $id = trim(I("POST.id","","htmlspecialchars"));//获取前台页面传过来的参数id

        $number = $storage ->where("id={$id}") ->getField("dress_number");//查找数据库里相对应的id

        $data["dress_number"] = trim(I("POST.number","","htmlspecialchars")) + $number;//获取前台过来的参数number(进货礼服的数量)加上了仓库中已经有的数量

        $result = $storage ->where("id={$id}") -> save($data);//更新仓库里的礼服数量

        if( $result ){//如果成功
            $res = array(
                "status" => 1,
                "message" => "更新成功！",
//              "data" => ""
            );
            echo json_encode($res);
        }else{
            $res = array(
                "status" => 0,
                "message" => "更新失败，错误原因：".mysql_error()."<br>",
//              "data" => ""
            );
            echo json_encode($res);
        }
    }

}