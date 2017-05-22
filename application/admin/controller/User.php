<?php 
namespace app\admin\controller;
use think\Controller;
use app\admin\model\User;
use app\admin\controller\Index;
use app\admin\controller\Upload;

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
	 $result?$this->success('登录成功！','http://localhost/mytravel/public/index.php/admin/index?action'):$this->error('用户名或密码错误！');

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



	

}