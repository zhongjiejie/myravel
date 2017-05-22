<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class User extends Model
{
	//使用字符串定义连接数据库
	protected $connection = 'mysql://root:@127.0.0.1:3306/travel#utf8';

	//验证用户名和密码是否正确
	function checkUser ($username,$password)
	{
		return Db::table('user')->where('username',$username)->where('password',$password)->column('uid');
	}

	//查找用户
	function findUser($where = 1)
	{
		return Db::table('user')->where($where)->select();
	}

	function updateUser($where = 1,$data)
	{
		return Db::table('user')->where($where)->update($data);
	}

	function deleteUser($where)
	{
		return Db::table('user')->where($where)->delete();
	}

}