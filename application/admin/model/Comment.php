<?php

namespace app\admin\model;
use think\Model;
use think\Db;

/**
* 
*/
class Comment extends Model
{
	function updateComment($where=1,$data)
	{
		return Db::table('comment')->where($where)->update($data);
	}

	function deleteComment($where)
	{
		return Db::table('comment')->where($where)->delete();
	}
}