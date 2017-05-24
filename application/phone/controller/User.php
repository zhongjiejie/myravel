<?php

namespace app\phone\controller;
use think\Controller;
use app\admin\model\User;
use  think\Session;

class User extends Controller
{
	function login()
	{
		return $this->fetch();
	}

	function loginHandle()
	{
		$userModel = new User;
		$result = $userModel->checkUser($_POST['username'],$_POST['password']);
		if($result){
			session::set('username',$_POST['username']);
			$this->success('登录成功！','http://localhost/mytravel/public/index.php/phone/index');
		}else{
			$this->error('用户名或密码错误！');
		}
	}
}