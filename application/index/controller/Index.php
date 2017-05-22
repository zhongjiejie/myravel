<?php
namespace app\index\controller;
use think\Request;
use think\Controller;
use think\Db;


class Index extends Controller
{
    public function index()
    {
    	$request = Request::instance();
    	$request = $this->request;
        echo 'pathinfo: ' . $request->pathinfo() . '<br/>';
        echo 'pathinfo: ' . $request->path() . '<br/>';
        echo 'url with domain: ' . $request->url(true) . '<br/>';
    }

    public function haha($name,$age)
    {
    	echo $name.'======>'.$age;
    }

    public function myDbAction()
    {
    	//原生查询
    	$result = Db::execute('insert into bbs_user(name,');
    }
}
