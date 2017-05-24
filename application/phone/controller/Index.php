<?php
namespace app\phone\controller;

use think\Controller;
use app\phone\model\Spot;


class Index extends Controller
{
    public function index()
    {
        $spotModel = new Spot;
        $spot = $spotModel->findSpot('ispass=1','3','zan ','desc');
       $this->assign('spot',$spot);
    	return $this->fetch();
    }

    
}
