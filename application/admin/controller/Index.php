<?php
namespace app\admin\controller;
use app\admin\model\Station;
use app\admin\model\Place;
use app\admin\model\User;
use think\Db;
use think\Controller;
use think\Session;


class Index extends Controller
{
	function index ($action=null)
	{
		//根据接收的参数确定显示的页面
		$action = empty($action)?'index':$action;
		$this->assign('action',$action);

		//显示站点的信息
		$station = new Station;
		$stationMsg = $station->findMsg();
		//dump($stationMsg);
		$this->assign('stationMsg',$stationMsg);


		//显示地点
		$places = new Place;
		$place = [$places->findProvince()];
		$place[] = $places->findCity();
		$place[] = $places->findPlace();
		//dump($place[2]);
		
		
		// 查询状态为1的地点数据 并且每页显示10条数据
		$list = Db::name('place')->where('grandpa_id',0)->paginate(10);
		// 把分页数据赋值给模板变量list
		$this->assign('list', $list);

		//显示景点
		$spotList = Db::name('spot')->where(1)->paginate(10);
		$spotPage = $spotList->render();
		$this->assign('spotList',$spotList);
		$this->assign('spotPage',$spotPage);

		//显示旅游攻略
		$logList = Db::name('log')->where('isdel=0')->paginate(10);
		$logPage = $logList->render();
		$this->assign('logList',$logList);
		$this->assign('logPage',$logPage);

		//显示回收站里面的旅游攻略
		$trashList = Db::name('log')->where('isdel=1')->paginate(10);
		$trashPage = $trashList->render();
		$this->assign('trashList',$trashList);
		$this->assign('trashPage',$trashPage);


		//显示旅游评论
		$commentList = Db::name('comment')->where('isdel=0')->paginate(10);
		$commentPage = $commentList->render();
		$this->assign('commentList',$commentList);
		$this->assign('commentPage',$commentPage);


		//显示回收站里面的评论
		$commentTrash = Db::name('comment')->where('isdel=1')->paginate(10);
		$commentTrashPage = $commentTrash->render();
		$this->assign('commentTrash',$commentTrash);
		$this->assign('commentTrashPage',$commentTrashPage);


		//查找管理员的相关信息
		$username = Session::get('username');
		$uid = Session::get('uid');
		$userModel = new User;
		$myMsg = $userModel->findUser('uid='.$uid)[0];
		$this->assign('myMsg',$myMsg);



		
		

		$this->assign('place',$place);
		//dump($list);
		return $this->fetch('index');
	}

	//用户列表
	function userManage()
	{
		// 查询所有用户数据 并且每页显示10条数据
		$list = User::where('usertype=0')->paginate(10);
		// 获取分页显示
		$page = $list->render();
		// 模板变量赋值
		$action = 'userManage';
		$this->assign('action',$action);


		//计算用户数
		$userModel = new User;
		$userCount = count($userModel->findUser());
		$this->assign('userCount',$userCount);

		//计算管理员数
		$managerCount = count($userModel->findUser('usertype=1'));
		$this->assign('managerCount',$managerCount);

		//分页
		$this->assign('list', $list);
		$this->assign('page', $page);

				//查找管理员的相关信息
		$username = Session::get('username');
		$uid = Session::get('uid');
		$userModel = new User;
		$myMsg = $userModel->findUser('uid='.$uid)[0];
		$this->assign('myMsg',$myMsg);
		// 渲染模板输出
		return $this->fetch('index');
	}

	function managerList()
	{
		//查询出所有的管理员信息
		//$userModel = new User;
		//$managerMsg = $userModel->findUser('usertype=1');
		//
		$list = User::where('usertype=1')->paginate(6);
		// 获取分页显示
		$page = $list->render();

		//查询普通用户信息
		$userModel = new User;
		$userList = $userModel->findUser('usertype=0');


		
		$action = 'manager';
		$this->assign('userList',$userList);
		
		$this->assign('list',$list);
		$this->assign('page',$page);

		$uid = Session::get('uid');
		$userModel = new User;
		$myMsg = $userModel->findUser('uid='.$uid)[0];
		$this->assign('myMsg',$myMsg);
		//$this->assign('managerMsg',$managerMsg);
		$this->assign('action',$action);
		return $this->fetch('index');

	}




}