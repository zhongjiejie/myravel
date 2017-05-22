<?php
namespace app\admin\controller;
use app\admin\model\Place;
use think\Controller;

class Place extends Controller
{
	function addPlaceController()
	{
		//添加地点
		
		$place = new Place;
		$result = $place->addPlaceModel($_POST);
		$result?$this->success('添加成功!'):$this>error('添加失败');
	}
}