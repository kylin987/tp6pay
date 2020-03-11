<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 04:19
 */

namespace app\lib;
class Key {

    /**
     *
     * @param $appId
     * @return string
     */
    public static function Order($appId) {
        return "order_".$appId;
    }
}