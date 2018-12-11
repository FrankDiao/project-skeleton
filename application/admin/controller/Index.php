<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/10 0010
 * Time: 12:08
 */

namespace app\admin\controller;


class Index extends ConBase
{
    public function index(){
        return show();
    }
}
