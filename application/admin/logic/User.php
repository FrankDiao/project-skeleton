<?php
/**
 * 简要说明该类的作用
 * Date: 2018/12/10 0010 21:06
 * User: 你的小星星
 * Copyright: 深圳市微开互联科技有限公司 http://www.weekey.cn/
 */

namespace app\admin\logic;

use app\admin\model\Admin;
use app\common\service\Jwt;
use think\Cache;
use think\Db;

class User extends LogicBase
{
    /**
     * 管理员登录
     * @param $param
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function login($param){
        //校验参数
        if(empty($param['username']) || empty($param)){
            return show(0,"密码或账户不能为空",400);
        }

        //查询管理员
        $passwrd = md5($param['password'].config('jwt_key'));

        $adminMod = new Admin();
        $admin = $adminMod->where(['username'=>$param['username'],"password"=>$passwrd])->find();

        if(empty($admin)){
            return show(0,"账户不存在或密码有误",404);
        }

        if(empty($admin['status'])){
            return show(0,"此账户已被禁用",400);
        }

        //生成token并返回
        $token = Jwt::encodeToken(['uid'=>$admin['id']]);
        return show(1,"登录成功",200,["token"=>$token]);
    }


    public function getInfo($uid){
        $admin = Admin::get($uid);
        if(empty($admin)){
            return show(0,"无管理员信息，请重新登录",50014);
        }
        return show(1,"已获取管理员信息",200,["admin"=>$admin,"roles"=>['admin']]);
    }
}
