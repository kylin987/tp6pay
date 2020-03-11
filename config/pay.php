<?php
// +----------------------------------------------------------------------
// | 支付信息设置
// +----------------------------------------------------------------------


return [
    // 填写支付的类型，按实际情况来定。
    "pay_types" => [
        "alipay",
        "weixin",
        "baidu"
    ],

    /**
     * 支付回调通知
     *
     */
    "pay_notify" => [
        "weixin" => "https://pay.singwa666.com/notify.weixin",
        "alipay" => "https://pay.singwa666.com/notify.alipay"
    ],

    "pay_expire" => [
        "weixin" => 300, // 失效时间
    ],


    //支付商户号等信息
    'weixin' => [
        'power'  => true,   //开关
        'appid' => env('weixinpay.appid', ''),
        'appsecret' => env('weixinpay.appsecret', ''),
        'mchid' => env('weixinpay.mchid', ''),
        'key' => env('weixinpay.key', ''),
    ],
];
