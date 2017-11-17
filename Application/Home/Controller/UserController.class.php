<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    //显示会员列表
    public function showList(){
        $userSelect = M("User"); //实例化用户表

        $page = trim(I("POST.userPage","1","htmlspecialchars"));//获取前台传的页码参数page，不传默认为1

        if( $userSelect ->select() ) {//如果成功
            $list = $userSelect ->order("id") ->page("{$page},20") ->select();//按id排序输出当前页码的10条内容
            $count = $userSelect ->count();//获取数据总条数
            $res = array(
                "status" => 1,
                "message" => "查询成功！",
                "data" => $list,
                "count" => $count   //输出数据总条数
            );
            echo json_encode($res);
        }else if( $userSelect ->select() == false) {
            $res = array(
                "status" => 0,
                "message" => "查询失败，错误原因：".mysql_error()."<br>",
            );
            echo json_encode($res);
        }
    }
    //增加会员
    public function add(){
        $userAdd = M("User");//实例化用户表
        global $result;//定义全局变量
        $count = $userAdd ->count();//获取数据总数
        $name = $userAdd ->field("name") ->select();//获取name集合
        $data["name"] = trim(I("POST.name","","htmlspecialchars")); //获取前台传过来的name

        if( isRepeat($name,$data["name"],"name") ) {//调用isRepeat函数判断用户名是否已经存在
            //isRepeat函数在目录Application\Common\Common\function.php里面定义
            if( $count ){   //如果数据总数存在
                $data["uid"] = $count +1;//uid自动在原有基础+1
                $data["tel"] = trim(I("POST.tel","","htmlspecialchars"));//获取前台参数电话
                $data["qq"] = trim(I("POST.qq","","htmlspecialchars"));//参数qq
                $data["total_consumption"] = trim(I("POST.total_consumption","","htmlspecialchars")); //参数总消费金额
                $data["total_integral"] = trim(I("POST.total_integral","","htmlspecialchars"));//总积分
                $data["esidual_integral"] = trim(I("POST.esidual_integral","","htmlspecialchars"));//剩余积分
                $data["card_number"] = "000".(intval("1001000")+($count +1));//会员卡号，原有基础自动+1
                $data["discount"] = trim(I("POST.discount","","htmlspecialchars"));//参数折扣
                $result = $userAdd ->add($data);//添加该会员
             }
            if( $result ) { //如果成功
                $res = array(
                    "status" => 1,
                    "message" => "添加成功！",
//                  "data" => ""
                );
                echo json_encode($res);
            }else{
                $res = array(
                    "status" => 0,
                    "message" => "添加失败，错误原因：".$userAdd ->getError()."<br>",
//                  "data" => ""
                );
                echo json_encode($res);
            }
        }else{ //isRepeat函数判断用户名存在
            $res = array(
                "status" => 0,
                "message" => "添加失败，错误原因：用户名重复"."<br>",
//              "data" => ""
            );
            echo json_encode($res);
        }

    }
    //删除会员
    public function delete(){
        $userDelete = M("User");//实例化用户表

        $data = trim(I("POST.id","","htmlspecialchars")); //获取前台参数id

        $result = $userDelete -> where("id={$data}") ->delete(); //找到当前id的会员数据

        if( $result ) {
            $res = array(
                "status" => 1,
                "message" => "删除成功！",
//            "data" => ""
            );
            echo json_encode($res);
        }else{
            $res = array(
                "status" => 0,
                "message" => "删除失败，错误原因：".mysql_error()."<br>",
//            "data" => ""
            );
            echo json_encode($res);
        }
    }
    //更新会员
    public function update(){
        $userUpdate = M("User");//实例化用户表

        $id = trim(I("POST.id","","htmlspecialchars")); //获取前台参数id
        $data["name"] = trim(I("POST.name","","htmlspecialchars"));//name
        $data["tel"] = trim(I("POST.tel","","htmlspecialchars")); //电话
        $data["qq"] = trim(I("POST.qq","","htmlspecialchars")); //qq
        $data["total_consumption"] = trim(I("POST.total_consumption","","htmlspecialchars"));//总消费金额
        $data["total_integral"] = trim(I("POST.total_integral","","htmlspecialchars"));//总积分
        $data["esidual_integral"] = trim(I("POST.esidual_integral","","htmlspecialchars"));//剩余积分
        $data["discount"] = trim(I("POST.discount","","htmlspecialchars"));//折扣

        $result = $userUpdate -> where("id={$id}") ->save($data);//更新当前id的会员信息
        if( $result ) {
            $res = array(
                "status" => 1,
                "message" => "修改成功！",
//              "data" => ""
            );
            echo json_encode($res);
        }else{
            $res = array(
                "status" => 0,
                "message" => "修改失败，错误原因：".mysql_error()."<br>",
//              "data" => ""
            );
            echo json_encode($res);
        }
    }
    //按姓名查询会员
    public function select(){
        $userSelect = M("User"); //实例化用户表

        $name = trim(I("POST.name","","htmlspecialchars"));//获取前台参数name

        $result = $userSelect -> where("name=\"".$name."\"") ->select();//搜索当前name的用户数据

        if( $result ){
            $res = array(
                "status" => 1,
                "message" => "查询成功！",
                "data" => $result    //返回数据
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

     // 按id查询会员
     public function selectId(){
            $user = M("User");

            $id = trim(I("GET.id","","htmlspecialchars")); //获取前台传过来的id
            $result = $user -> where("id={$id}") ->find();//获取当前id的用户数据

            if( $result ) {
                $res = array(
                    "status" => 1,
                    "message" => "查询成功",
                    "data" => $result
                );
                echo json_encode($res);
            }else{
                $res = array(
                    "status" => 0,
                    "message" => "查询失败，错误原因：".mysql_error()."<br>",
                );
                echo json_encode($res);
            }
        }

}
