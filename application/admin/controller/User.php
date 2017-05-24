<?php 
namespace app\admin\controller;
use think\Controller;
use app\admin\model\User;
use app\admin\controller\Index;
use app\admin\controller\Upload;
use think\Session;

class User extends Controller
{
	//登录界面
	function login()
	{
		//显示登录界面
		return $this->fetch();
	}

	//登录操作验证
	function loginHandle()
	{
		
	 //创建一个userModel对象
	 $user = new User;
	 //验证用户名和密码是否正确
	 $result = $user->checkUser($_POST['username'],$_POST['password']);
	
	 //页面跳转
	 if($result){
	 	Session::set('username',$_POST['username']);
	 	Session::set('uid',$result[0]);
	 	$this->success('登录成功！','http://localhost/mytravel/public/index.php/admin/index?action');
	 	
	 }else{
	 	$this->error('用户名或密码错误！');
	 }
	

	}

	function logout()
	{
		Session::delete('uid');
		Session::delete('username');
		$this->success('退出登录成功！','http://localhost/mytravel/public/index.php/phone/index');
	}

	

	//编辑用户信息
	function userUpdate($uid=null)
	{
		//dump($_POST);

		//获取头像上传的路径
		if($_FILES['file']['name']){
			$upload = new Upload('file');
			$path = $upload->uploadFile('file');
		}
		

		//将用户信息放在数组里
		$data = $_FILES['file']['name']?array_merge($_POST,['picture'=>$path]):$_POST;

		//保存用户信息
		$userModel = new User;
		$result = $userModel->updateUser('uid='.$uid,$data);
		$result?$this->success('编辑用户信息成功！'):$this->error('编辑用户信息失败！');


	}
	//锁定用户
	function lockUser($uid,$islock=1)
	{

		$userModel = new User;
		$result = $userModel->updateUser('uid='.$uid,['islock'=>$islock]);
		$result?$this->success('操作成功！'):$this->error('操作失败！');
	}

	//解锁用户
	function unLockUser($uid)
	{
		$this->lockUser($uid,0);
	}

	//删除用户
	function myDeleteUser($uid)
	{
		$userModel =  new User;
		$result = $userModel->deleteUser('uid='.$uid);
		$result?$this->success('删除成功！'):$this->error('删除失败！');
	}

	//添加管理员
	function addManager()
	{

		
		$userModel = new User;
		foreach ($_POST as $key => $value) {
			foreach($value as $uid)
			$result = $userModel->updateUser('uid='.$uid,['usertype'=>1]);
		}
		$result?$this->success('添加管理员成功！'):$this->error('添加管理员失败！');
		
	}

	function deleteManager($uid)
	{
		$userModel = new User;
		$result = $userModel->updateUser('uid='.$uid,['usertype'=>0]);
		$result?$this->success('删除成功！'):$this->error('删除失败！');
	}



	

}