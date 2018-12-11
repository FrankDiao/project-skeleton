<?php
/**
 * JWT(json web token) 鉴权
 * Date: 2018/12/10 0010 18:13
 * User: 你的小星星
 * Copyright: 深圳市微开互联科技有限公司 http://www.weekey.cn/
 */

namespace app\common\service;

use think\Cache;
use Firebase\JWT\JWT as LibJWT;

class Jwt extends Base
{
    public static function encodeToken($data){
        $key = config("jwt_key");
        $token = array(
            "aud" => config('app_debug')?"":$_SERVER['HTTP_ORIGIN'], //接收jwt的一方
            "iat" => time(), //token创建时间
            "nbf" => time()-30, //在这个时间之前，该token无法使用
            "exp" => time()+(3600*2),//过期时间
            "data" => $data
        );

        return LibJWT::encode($token, $key);
    }

    public static function decodeToken($token){
        $key = config("jwt_key");
        $alg = config("jwt_alg");
        return LibJWT::decode($token, $key, $alg);
    }

    public static function checkToken($token){
        $data = (array)self::decodeToken($token);
        $time = time();

        if ($_SERVER['HTTP_ORIGIN'] != $data['aud'] && !config('app_debug')){//请求域名是否与token颁发域名一致
            exit(show(0,"非法请求地址",50008,[],true));
        }

        if ($time < $data['nbf']){//请求时间是否满足
            exit(show(0,"非法请求时间",50008,[],true));
        }

        if ($time > $data['exp']){
            exit(show(0,"Token已过期",50014,[],true));
        }

        return $data['data'];

    }
}
