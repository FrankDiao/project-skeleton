<?php
/**
 * 接管TP5 Handle类 使用自定义方式
 * Date: 2018/12/10 0010 12:30
 * User: 你的小星星
 * Copyright: 深圳市微开互联科技有限公司 http://www.weekey.cn/
 */

namespace app\common\exception;

use think\exception\Handle;

class ApiHandle extends Handle
{
    /**
     * http状态码
     * @var unknown
     */
    public $httpCode = 500;

    public function render(\Exception $e)
    {
        return show(0, $e->getMessage(), $this->httpCode, []);
    }
}
