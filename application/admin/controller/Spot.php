<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\controller\Upload;
use app\admin\model\Spot;

class Spot extends Controller
{
	//添加景点
	function addSpot()
	{
		//获取图片上传的路径
		
		
		if($_FILES['file']['name']){
					// 获取表单上传文件
				$files = request()->file('file');
				foreach($files as $file){
				// 移动到框架应用根目录/public/uploads/ 目录下
				$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
				if($info){
				// 成功上传后 获取上传信息
				// 输出 jpg
				$pa = str_replace('\\','/',$info->getSaveName());
				$path[] = $pa;
				
				}else{
				// 上传失败获取错误信息
				echo $file->getError();
				}
				
			}
			$photo = join('%',$path);


		}

		//传递过来的数据存入数据库
		$data = array_merge($_POST,['photo'=>$photo]);
		$spotModel = new Spot;
		$result = $spotModel->addSpot($data);

		//判断是否存入成功
		$result?$this->success('添加景点成功！','http://localhost/mytravel/public/index.php/admin/index/index?action=updateSpot'):$this->error('添加景点失败！');

		
	}

	//审核景点
	function checkSpot($sid)
	{
		//显示景点的相关信息
		$spotModel = new Spot;
		$spotDetails = $spotModel->findSpot('sid='.$sid);
		$photo = explode('%',$spotDetails[0]['photo']);

		$this->assign('photo',$photo);
		$this->assign('spotMsg',$spotDetails[0]);
		return $this->fetch('spotDetail');
	}


	//删除景点
	function deleteSpot($sid)
	{
		$spotModel = new Spot;
		$result = $spotModel->deleteSpot($sid);
		$result?$this->success('操作成功！','http://localhost/mytravel/public/index.php/admin/index/index?action=updateSpot'):$this->error('操作失败！');
	}

	//发布景点
	function sendSpot($sid)
	{
		$spotModel = new Spot;
		$result = $spotModel->updateSpot('sid='.$sid,['ispass'=>1]);
		$result?$this->success('操作成功！','http://localhost/mytravel/public/index.php/admin/index/index?action=updateSpot'):$this->error('操作失败！');
	}

	
}