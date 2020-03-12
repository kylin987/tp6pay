<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 22:37
 */

namespace app\controller\notify;
use app\BaseController;
class Weixin extends BaseController
{
    public $payType = "weixin";

    /**
     *
     */
    public function index() {
        // 获取流式数据
        $data = $this->request->getInput();
        file_put_contents(public_path()."notify_tmp/".date("Ymd").".log", $data."\n\n", FILE_APPEND);
        //file_put_contents("/tmp/a.log", $data, FILE_APPEND);
        // 第一： 解析数据， 校验数据是否 订单 => redis ,
        // 要告诉微信 ， success ok,  redis hash 
    }

}
