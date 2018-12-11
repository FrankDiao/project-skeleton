<?php
/**
 * 用户相关
 * Date: 2018/12/10 0010 18:13
 * User: 你的小星星
 * Copyright: 深圳市微开互联科技有限公司 http://www.weekey.cn/
 */

namespace app\admin\controller;

use think\Request;
use app\admin\logic\User as UserLogic;

class User extends ConBase
{
    private $user;

    public function _initialize()
    {
        parent::_initialize();
        $this->user = new UserLogic();
    }

    /**
     * 管理员登录
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request){
        return $this->user->login($request->param());
    }


    /**
     * 退出登录
     * @return \think\response\Json
     */
    public function logout(){
        return show();
    }

    /**
     * 获取管理员信息
     * @return mixed
     */
    public function info(){
        return $this->user->getInfo($this->tokenData['uid']);
    }

}
