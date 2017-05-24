<?php
namespace app\phone\Comment;
use think\Db;
use think\Model;

class Comment extends Model
{
	function addComment($data)
	{
		return Db::table('comment')->insert($data);
	}
}