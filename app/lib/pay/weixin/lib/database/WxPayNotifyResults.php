<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 23:25
 */
/**
 *
 * 回调回包数据基类
 *
 **/
namespace app\lib\pay\weixin\lib\database;
class WxPayNotifyResults extends WxPayResults
{
    /**
     * 将xml转为array
     * @param WxPayConfigInterface $config
     * @param string $xml
     * @return WxPayNotifyResults
     * @throws WxPayException
     */
    public static function Init($config, $xml)
    {
        $obj = new self();
        $obj->FromXml($xml);
        //失败则直接返回失败
        $obj->CheckSign($config);
        return $obj;
    }
}
