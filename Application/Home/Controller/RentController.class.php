<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/11 0011
 * Time: 下午 3:52
 */

namespace Home\Controller;
use Think\Controller;

class RentController extends Controller{
    //显示租赁列表
    public function showList (){
        $rent = M("Rent");//实例化租赁表

        $page = trim(I("POST.rentPage","1","htmlspecialchars")); //获取前台参数rentPage，默认不传为1

        //查找租赁表和用户表和礼服表和udrm表里面uid,oid,did相同的数据
        $result = $rent-> join("dress_user ON dress_user.uid = dress_rent.uid")//用户表和租赁表 uid相同
                       -> join("dress_udrm ON dress_rent.oid = dress_udrm.oid")//租赁和udrm  oid相同
                       -> join("dress_dresses ON dress_dresses.did = dress_udrm.did")//礼服和udrm did相同
                       -> field("dress_rent.oid,name,tel,qq,dress_name,number,dress_ma,dress_receive,plan_return,actual_return,overdue_return,dress_man,dress_woman,deposit,receipt_number,handler,date,state")//指定显示oid,name,tel,qq,数量,计划领取，实际领取，计划归还，实际归还，逾期归还，男士礼服数量，女士礼服数量，押金，收据号，经办人，日期，完成状态
                       -> page("{$page},20")//获取当前页码的20条数据
                       -> order("oid")//按oid排序
                       -> select();
        //获取租赁表和用户表和礼服表和udrm表里面uid,oid,did相同的数据的数据总数
        $count = $rent -> join("dress_user ON dress_user.uid = dress_rent.uid")
                       -> join("dress_udrm ON dress_rent.oid = dress_udrm.oid")
                       -> join("dress_dresses ON dress_dresses.did = dress_udrm.did")
                       -> field("dress_rent.oid,name,tel,qq,dress_name,number,dress_ma,dress_receive,plan_return,actual_return,overdue_return,dress_man,dress_woman,deposit,receipt_number,handler,date,state")
                       ->count();

        if( $result ) {
            $res = array(
                "status" => 1,
                "message" => "查询成功！",
                "data" => $result,//输出数据
                "count"=> $count //输出数据条数
            );
            echo json_encode($res);
        }else {
            $res = array(
                "status" => 0,
                "message" => "查询失败，错误原因：".mysql_error()."<br>",
//              "data" => ""
            );
            echo json_encode($res);
        }
    }
    //添加租赁
    public function add(){

        $user = M("User");//实例化用户表
        $dresses = M("Dresses");//实例化礼服表
        $rent = M("Rent");//实例化租赁表

        $userData["name"] = trim(I("POST.name","","htmlspecialchars"));//获取前台参数name存入用户数据数组
        $userData["tel"] = trim(I("POST.tel","","htmlspecialchars")); //tel
        $userData["qq"] = trim(I("POST.qq","","htmlspecialchars")); //qq

        $dressesData["dress_name"] = trim(I("POST.dress_name","","htmlspecialchars"));//获取前台参数dress_name存入礼服数据数组

        $udrmData["number"] = trim(I("POST.number","","htmlspecialchars"));//获取前台参数number存入udrm数据数组

        $rentData["oid"] = trim(I("POST.oid","","htmlspecialchars"));//获取前台参数oid存入租赁数据数组
        $rentData["dress_ma"] = trim(I("POST.dress_ma","","htmlspecialchars"));//计划领取
        $rentData["dress_receive"] = trim(I("POST.dress_receive","","htmlspecialchars"));//实际领取
        $rentData["plan_return"] = trim(I("POST.plan_return","","htmlspecialchars"));//计划归还
        $rentData["actual_return"] = trim(I("POST.actual_return","","htmlspecialchars"));//实际归还
        $rentData["overdue_return"] = trim(I("POST.overdue_return","","htmlspecialchars"));//逾期归还
        $rentData["deposit"] = trim(I("POST.deposit","","htmlspecialchars"));//押金
        $rentData["receipt_number"] = trim(I("POST.receipt_number","","htmlspecialchars"));//收据单号
        $rentData["handler"] = trim(I("POST.handler","","htmlspecialchars"));//经办人
        $rentData["date"] = trim(I("POST.date","","htmlspecialchars"));//日期
        $rentData["state"] = trim(I("POST.state","","htmlspecialchars"));//完成状态

        global $uid; //定义全局变量
        global $oid;
        global $dress_man;
        global $dress_woman;
        $dress_man = $dress_woman = 0; //初始化全局变量

        $name = $user -> field("name") ->select();  //取得用户表里会员姓名合集
        if( isRepeat($name,$userData["name"],"name") ) {   //调用函数判断数据库中是否已经存在相同的用户名
            //没有重复则自动添加
            $count = $user ->count();//获取数据总数
            $userData["uid"] = $uid["uid"] = $count + 1;//新增的用户uid自动+1
            $user ->add($userData);//添加信息

        }else{     //否则取得该用户的uid
            $uid = $user ->field("uid") ->where("name=\"".$userData["name"]."\"") ->find();
        }

        //取得礼服名称相对应的did
        $did = $dresses  ->where("dress_name=\"".$dressesData["dress_name"]."\"") ->find();
        //取得租赁表中oid的集合
        $oid = $rent ->field("oid") ->select();

        if( isRepeat($oid,$rentData["oid"],"oid") ){ //调用函数判断数据库中是否已经存在相同的oid
            //没有则自动添加一条新的租赁记录
            $rentData["uid"] = $uid["uid"] ;//把获取到的用户uid存入租赁表数据数组
            $rent ->add($rentData);//添加信息

            $this ->isHave($rentData,$udrmData,$uid,$did,$dress_man,$dress_woman);//调用isHave函数
        }else{   //否则

            $this ->isHave($rentData,$udrmData,$uid,$did,$dress_man,$dress_woman);//调用isHave函数
        }
    }
    //删除租赁
    public function delete(){
        $rent = M("Rent");//实例化租赁表
        $udrm = M("Udrm");//实例化udrm

        $data = trim(I("POST.oid","","htmlspecialchars"));//获取前台参数oid

        $rentResult = $rent ->where("oid={$data}") ->delete(); //删除租赁表中当前oid的数据
        $udrmResult = $udrm ->where("oid={$data}") ->delete(); //删除udrm表中当前oid的数据

        if( $rentResult and $udrmResult ) {//如果两个表都删除成功
            $res = array(
                "status" => 1,
                "message" => "删除成功！",
//              "data" => ""
            );
            echo json_encode($res);
        }else{
            $res = array(
                "status" => 0,
                "message" => "删除失败，错误原因：".mysql_error()."<br>",
//              "data" => ""
            );
            echo json_encode($res);
        }

    }
    //查找租赁
    public function select(){
        $rent = M("Rent");//实例化租赁表

        $data["oid"] = trim(I("POST.oid","","htmlspecialchars"));//获取前台oid
        //查找租赁表中当前oid的数据,获取方法同显示租赁列表功能
        $result = $rent-> join("dress_user ON dress_user.uid = dress_rent.uid")
            -> join("dress_udrm ON dress_rent.oid = dress_udrm.oid")
            -> join("dress_dresses ON dress_dresses.did = dress_udrm.did")
            -> field("dress_rent.oid,name,tel,qq,dress_name,number,dress_ma,dress_receive,plan_return,actual_return,overdue_return,dress_man,dress_woman,deposit,receipt_number,handler,date,state")
            -> where("dress_rent.oid={$data["oid"]}")
            -> select();

        if( $result ) {
            $res = array(
                "status" => 1,
                "message" => "查询成功！",
                "data" => $result//输出数据
            );
            echo json_encode($res);
        }else {
            $res = array(
                "status" => 0,
                "message" => "查询失败，错误原因：".mysql_error()."<br>",
//              "data" => ""
            );
            echo json_encode($res);
        }
    }



    /**
     * @param $rentData
     * @param $udrmData
     * @param $uid
     * @param $did
     * @param $dress_man
     * @param $dress_woman
     */

    //isHave函数，接收的参数依次为：租赁数据数组，udrm数据数组，uid数组,did数组,男士礼服数量,女士礼服数量
    public function isHave($rentData,$udrmData,$uid,$did,$dress_man,$dress_woman){
        $udrm = M("Udrm");//实例化udrm表
        $rent = M("Rent");//实例化租赁表

        //查找租赁表中 oid与租赁数据数组当中oid相匹配的uid
        $rentOid = $rent ->field("uid") ->where("oid={$rentData["oid"]}") ->find();


        if( intval($rentOid["uid"]) == intval($uid["uid"]) ){ //如果租赁表里面的uid和uid数组里面的uid一致
            $udrmData["oid"] = $rentData["oid"];//udrm数据数组添加oid信息
            $udrmData["uid"] = $uid["uid"]; //udrm数据数组添加uid信息
            $udrmData["did"] = $did["did"]; //udrm数据数组添加did信息
            $udrmResult = $udrm->add($udrmData);//添加信息

            //获取udrm表和礼服表里面同一个oid里面did一致的 数量和适用性别
            $dress_number = $udrm ->join("dress_dresses ON dress_udrm.did = dress_dresses.did")
                ->field("number,dress_sex")
                ->where("dress_udrm.oid={$rentData["oid"]}")
                ->select();

            //遍历刚才获取到的数据，分别判断适用性别是男还是女
            foreach ($dress_number as $value) {
                if( intval($value["dress_sex"])  === 1 ) {
                    $dress_man += intval($value["number"]);//男士礼服数量增加
                }elseif( intval($value["dress_sex"]) === 0 ){
                    $dress_woman += intval($value["number"]);//女士礼服数量增加
                }
            }
            $rentData["dress_man"] = $dress_man;//男士礼服数量存入租赁数据数组
            $rentData["dress_woman"] = $dress_woman;//女士礼服数量存入租赁数据数组
            $rentResult = $rent ->field("dress_man,dress_woman") -> where("oid={$rentData["oid"]}") ->save($rentData);//更新当前oid的租赁表中男士，女士礼服数量

            if( $udrmResult and $rentResult ){//如果添加udrm信息和更新租赁信息都成功了
                $res = array(
                    "status" => 1,
                    "message" => "添加成功！",
//                  "data" => ""
                );
                echo json_encode($res);
            }else{
                $res = array(
                    "status" => 0,
                    "message" => "添加失败，错误原因：".mysql_error()."<br>",
//                  "data" => ""
                );
                echo json_encode($res);
            }
        }else{//如果租赁表里面的uid和uid数组里面的uid不一致
            $res = array(
                "status" => 0,
                "message" => "添加失败，错误原因：用户名和订单号不匹配！"."<br>",
//              "data" => ""
            );
            echo json_encode($res);
        }


    }
}