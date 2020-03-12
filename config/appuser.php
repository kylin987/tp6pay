<?php
// +----------------------------------------------------------------------
// | 应用设置
// +----------------------------------------------------------------------

/**
 * 这块的配置 小伙伴可以做一个后端管理， 把配置信息存入表中，其实这块完全可以放入redis中哦。
 */
return [
    // https://pay.singwa666.com/x?appid=xxx&token=xxx&time=当前时间
    // token: md5(time."_".appid."_".key)

    // md5(time()."&mpm*68+0sg_12singwa_mall");  => token  redis加固使得token只能用一次
    // appid => []
    "yz0dhpq1rc5y" => [
        "key" => "f6i5w3manco83mowab5tb7x07pbe0etd",
        "expire" => 300,
        "stitching_symbol" => "@7!",
    ],
    "muku_abc" => [
        "key" => "ampqmtp",
        "expire" => 6000,
        "stitching_symbol" => "+_"
    ],
];
