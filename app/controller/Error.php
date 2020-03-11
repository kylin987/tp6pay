<?php

namespace app\controller;

use app\lib\Show;

/**
 * 控制器不存在
 */
class Error
{
    
    public function __call($name, $arguments) {
        return Show::error("该控制器不存在");
    }
}