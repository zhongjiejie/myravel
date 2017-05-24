<?php
namespace app\phone\controller;
use think\Controller;
use app\admin\controller\Upload;
use app\admin\model\Spot;

/**
* 
*/
class Spot extends Controller
{
	
	function spotDetails($sid)
	{
		$spotModel = new Spot;
		$spotDetail = $spotModel->findSpot('sid='.$sid);

		$this->assign('spotDetail',$spotDetail[0]);
		return $this->fetch('spotDetail');
	}
}