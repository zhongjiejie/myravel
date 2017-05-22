<?php
namespace app\admin\model;
use think\Model;
use think\Db;

class Station extends Model
{
	function findMsg()
	{
		return Db::table('station')->find();
	}

	function updateMsg($data)
	{
		return Db::table('station')->where('sid',1)->update($data);
	}
}