<?php
namespace app\admin\model;
use think\Model;
use think\Db;

class Spot extends Model
{
	//添加景点
	function addSpot($data)
	{
		return Db::table('spot')->insert($data);
	}

	//查询景点
	function findSpot($where = 1)
	{
		return Db::table('spot')->where($where)->select();
	}

	//删除景点
	function deleteSpot($sid)
	{
		return Db::table('spot')->where('sid='.$sid)->delete();
	}

	//编辑景点
	function updateSpot($where,$data)
	{
		return Db::table('spot')->where($where)->update($data);
	}
}
