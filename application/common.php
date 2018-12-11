<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


/**
 * 通用化API接口数据输出
 * @param $status
 * @param $message
 * @param array $data
 * @param int $httpCode
 * @return \think\response\Json
 */
function show($status=1, $message="OK" ,$httpCode = 200 ,$data = [] ,$str=false)
{
    $data =  [
        'status' => $status,
        'message' => $message,
        'data' =>$data,
        "httpCode"=>$httpCode
    ];

    if ($str){
        return json_encode($data);
    }
    return json($data);
}

