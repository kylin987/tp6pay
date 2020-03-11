<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 01:30
 */
namespace app\controller;

use app\BaseController;

use app\lib\phpqrcode\QRcode;
class Test extends BaseController {

    /**
     * 生成二维码
     */
    public function index() {
        echo "<img src='https://pay.singwa666.com/qcode/index.html?data=weixin%3A%2F%2Fwxpay%2Fbizpayurl%3Fpr%3D436MP2H'>";
    }
}