<?php
namespace app\admin\controller;
use app\admin\model\Station;
use think\Controller;

class Station extends Controller
{
	function updateStation()
	{

		
		$station = new Station;
		//判断如果有$_POST['isclose']的就是打开站点，用on表示，没有的就是关闭站点用0表示。
		$data = count($_POST) == 7?$_POST:array_merge($_POST, ['isclose'=>0]);
		$station->updateMsg($data)?$this->success('修改站点信息成功！'):$this->error('修改站点信息失败！');
	}
}