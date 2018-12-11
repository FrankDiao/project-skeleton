<?php
/**
 * 简要说明该类的作用
 * Date: 2018/12/10 0010 21:10
 * User: 你的小星星
 * Copyright: 深圳市微开互联科技有限公司 http://www.weekey.cn/
 */

namespace app\admin\model;

use traits\model\SoftDelete;

class Admin extends ModelBase
{
    //软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';


    /**
     * 全局范围查询
     * @param $query
     */
    protected function base($query){
        $query->where(['delete_time'=>0]);
    }
}
