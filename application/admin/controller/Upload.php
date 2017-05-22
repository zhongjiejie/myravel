<?php
namespace app\admin\controller;

class Upload
{
	public function uploadFile($filename){
		// 获取表单上传文件 例如上传了001.jpg
		$file = request()->file($filename);
		// 移动到框架应用根目录/public/uploads/ 目录下
		$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
		if($info){
		// 成功上传后 获取上传信息
		return 'http://localhost/mytravel/public/uploads/'.str_replace('\\','/',$info->getSaveName());
		
		}else{
		// 上传失败获取错误信息
		echo $file->getError();
		}
	}
}