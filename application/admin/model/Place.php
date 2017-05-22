<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class Place extends Model
{
	function findProvince()
	{
		return  Db::table('place')->where('grandpa_id',0)->where('parent_id',0)->select();
		
	}

	function findCity()
	{
		return Db::table('place')->where('grandpa_id','>',0)->where('parent_id',0)->select();
	}

	function findPlace()
	{
		return Db::table('place')->where('grandpa_id','>',0)->where('parent_id','>',0)->select();
	}
	

	function addPlaceModel($data)
	{
		return DB::table('place')->insert($data);
	}
} 