<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\controller\Upload;
use app\admin\model\Comment;

/**
* 
*/
class Comment extends Controller
{
	
	function putTrash($cid)
	{
		$commentModel = new Comment;
		$result = $commentModel->updateComment('cid='.$cid,['isdel'=>1]);
		$result?$this->success('操作成功！'):$this->error('操作失败！');
	}

	function deleteComment($cid)
	{
		$commentModel = new Comment;
		$result = $commentModel->deleteComment('cid='.$cid);
		$result?$this->success('删除成功！'):$this->error('删除失败！');
	}
}