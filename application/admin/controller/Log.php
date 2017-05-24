<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Log;

class Log extends Controller
{
	function putTrash($logid)
	{
		$logModel = new Log;
		$result = $logModel->updateLog('logid='.$logid,['isdel'=>1]);
		$result?$this->success('已放入回收站！'):$this->error('操作失败！');
	}

	function deletLog($logid)
	{
		$logModel = new Log;
		$result = $logModel->deleteLog('logid='.$logid);
		$result?$this->success('操作成功！'):$this->error('操作失败！');
	}

	function backLog($logid)
	{
		$logModel = new Log;
		$result = $logModel->updateLog('logid='.$logid,['isdel'=>0]);
		$result?$this->success('操作成功！'):$this->error('操作失败！');
	}
}