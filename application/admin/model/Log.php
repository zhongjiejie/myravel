<?php
namespace app\admin\model;
use think\Model;
use think\Db;

class Log extends Model
{
	function updateLog($where=1,$data)
	{
		return Db::table('log')->where($where)->update($data);
	}

	function deleteLog($where)
	{
		return Db::table('log')->where($where)->delete();
	}
}