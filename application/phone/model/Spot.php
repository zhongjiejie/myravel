<?php
namespace app\phone\model;
use think\Db;
use think\Model;

class Spot extends Model
{
	//查询景点
	function findSpot($where = 1,$limit=null,$orderby=null,$law=null)
	{
		return Db::table('spot')->where($where)->limit($limit)->order($orderby,$law)->select();
	}
}