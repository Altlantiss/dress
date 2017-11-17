<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){
        $admin = M("Admin");//实例化管理员表
        $name = trim(I("POST.name","","htmlspecialchars"));//获取前台页面过来的参数
        $pwd = trim(I("POST.pwd","","htmlspecialchars")); //去除了两头的空格，转义特殊字符
        global $loginName;//定义全局变量
        global $loginPwd;

        if( $admin -> select() ) { //如果查询成功
            $loginName = $admin -> getField("admin_name");//把数据库里的管理员名和密码赋值给全局变量
            $loginPwd = $admin -> getField("admin_pwd");
        }else if( $admin -> select() == false){//如果查询失败
            exit("查询出错!");
        };

        if( $name === $loginName && $pwd === $loginPwd ){//如果登录密码匹配成功
            $res = array( //定义一个响应数组
                "status" => 1,
                "message" => "登陆成功！",
//              "data" => ""
            );
            echo json_encode($res);//响应给前台页面
        }else{
            $res = array(
                "status" => 0,
                "message" => "用户名密码不正确！",
              "data" => "$name, $pwd"
            );
            echo json_encode($res);
        }
    }
}