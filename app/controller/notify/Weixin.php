<?php
/**
 * Created by singwa
 * User: singwa
 * motto: 现在的努力是为了小时候吹过的牛逼！
 * Time: 22:37
 */

namespace app\controller\notify;
use app\BaseController;
use think\facade\Cache;
use app\lib\Key;
use think\facade\Log;

class Weixin extends BaseController
{
    public $payType = "weixin";

    /**
     *
     */
    public function index() {
        // 获取流式数据
        $data = $this->request->getInput();
        $file = public_path()."notify_tmp/".date("Ymd");
        if (!file_exists($file)) {
            mkdir($file);
        }
        file_put_contents($file."/".date("H").".log", $data."\n\n", FILE_APPEND);
        //file_put_contents("/tmp/a.log", $data, FILE_APPEND);
        // 第一： 解析数据， 校验数据是否 订单 => redis , 
        // 要告诉微信 ， success ok,  redis hash
        $jsonxml = json_encode(simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA));
        //转成数组
        $result = json_decode($jsonxml, true);
        if($result  && isset($result['result_code'])
            && isset($result['return_code'])
            && $result['result_code'] == "SUCCESS"
            && $result['return_code'] == "SUCCESS"
        ) {
            $redisResult = Cache::store('redis')->hGet(Key::Order($result['attach']), $result['out_trade_no']);
            if ($redisResult){
                $redisArr = json_decode($redisResult,true);
                if ($redisArr['pay_status'] == 0) {
                    $redisArr['pay_status'] = 1;
                    $redisArr['pay_time'] = time();
                    $redisArr['transaction_id'] = $result['transaction_id'];
                    Cache::store('redis')->hSet(Key::Order($result['attach']), $result['out_trade_no'], json_encode($redisArr));
                }
            }else {
                $redisArr = [
                    'pay_status'=>1,
                    'pay_time'=>time(),
                    'transaction_id'=>$result['transaction_id'],
                ];
                Cache::store('redis')->hSet(Key::Order($result['attach']), $result['out_trade_no'], json_encode($redisArr));
                Log::error("weixin-notify-redis-jilu-notfound_".$result['out_trade_no']);
            }
            echo '<xml>
              <return_code><![CDATA[SUCCESS]]></return_code>
              <return_msg><![CDATA[OK]]></return_msg>
                  </xml>';
            exit; 
        }else {
            echo "fail";
            exit; 
        }


    } 

}
