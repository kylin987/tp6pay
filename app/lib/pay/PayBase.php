<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 01:17
 */
namespace app\lib\pay;
interface PayBase {
    public function unifiedOrder($data);
}