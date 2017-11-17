<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display('login');
    }
    public function home(){
        $this->display('index');
    }
    public function edituser(){
        $this->display('edituser');
    }
    public function adduser(){
        $this->display('adduser');
    }
    public function storage(){
        $this->display('storage');
    }
    public function purchaselist(){
        $this->display('purchaselist');
    }
    public function rent(){
        $this->display('rent');
    }
    public function addrent(){
        $this->display('addrent');
    }
}