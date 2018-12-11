<?php
/**
 * 基类控制器
 * Date: 2018/12/10 0010 11:39
 * User: 你的小星星
 * Copyright: 深圳市微开互联科技有限公司 http://www.weekey.cn/
 */

namespace app\common\controller;

use app\common\service\Jwt;
use think\Controller;
use think\Request;

class Base extends Controller
{
    protected $tokenData;

    public function _initialize()
    {
        parent::_initialize();
        $this->CORS();
        $this->checkToken();
    }

    /**
     * CORS 跨域
     */
    protected function CORS(){
        $str = "Access-Control-Allow-Origin:*";

        if(!config("app_debug"))
        {
            $origin = isset($_SERVER['HTTP_ORIGIN'])?:"";
            $allow_origin = config("client_domain");

            if(in_array($origin,$allow_origin)){
               $str = "Access-Control-Allow-Origin: {$origin}";
            }
            else {
                exit("非法域名");
            }
        }

        header($str);
        header("Access-Control-Allow-Headers: token,Origin, X-Requested-With, Content-Type, Accept,X-Token");
        header("Access-Control-Allow-Methods: POST,GET");

    }

    /**
     * 验证请求Token
     * @return bool
     */
    protected function checkToken(){
        $request = Request::instance();
        $controller = $request->controller();
        $action = $request->action();

        if(($controller=='User' && $action=='login')) {
            return false;
        }

        $this->tokenData = (array)Jwt::checkToken($request->header("x-token"));
    }
}
