<?php
/**
 * 支付pay 服务 公共API
 */
namespace app\controller;

use think\facade\Cache;
use app\lib\Key;

class AuthBase extends ApiBase {

    public $appId = "";
    public $token = "";
    public $time = 0;
    public $order_id = "";
    public $total_price = 0;
    public $query = 0;
    public function initialize() {
        //
        //59a387e24211c4feb09ea27da9da8d98 1582452200
        //$t = time();
        //echo md5($t."&mp"."singwa_mall&mpm*68+0sg_12")."<br />";
        //echo $t; 
        //exit;
        parent::initialize();
        $this->appId = input("param.appid", "", "trim");
        $this->token = input("param.token", "", "trim");
        $this->time = input("param.time", 0, "intval");
        $this->order_id = input("param.order_id", 0, "trim");
        $this->total_price = input("param.total_price", 0, "intval");
        $this->query = input("param.query", 0, "intval");
        if(!$this->appId || !$this->token || !$this->time) {
            $this->show("appid,token,time字段不能为空");
        }
        if(!$this->order_id) {
            $this->show("订单号不能为空");
        }
        if (!$this->query && !$this->total_price){
            $this->show("订单金额不能为空");
        }
        $this->checkAuth();
    }

    /**
     * app_id:
     * app_key:
     * access_token:
     * post请求
     */
    public function checkAuth() {
        $app = config("appuser.{$this->appId}");
        if(!$app) {
            $this->show("不存在该appid，请联系支付平台负责人申请开通", ["appid" => $this->appId]);
        } 

        $data = [
            $this->time,
            $this->appId,
            $app["key"],
            $this->order_id,
            $this->total_price,
        ];
        if ($this->query){
            array_pop($data);
        }
        // 时间检验
        if ($app['expire'] + $this->time < time() ) {
            $this->show("请求token时间已过期，请重新生成token");
        }
        // token检验  $this->time."_".$this->appId."_".$app["key"]
        $token = md5(implode($app['stitching_symbol'], $data));
        if($this->token != $token) {
           $this->show("不合法的请求，请检验token是否合法");
        }
        // 最好还需要 把token放到redis 只能让我们token用一次 => 很安全 。。。。
        $token_key = Key::Order($this->appId)."_".$token;
        if (Cache::store('redis')->get($token_key)){
            $this->show("token已经使用，请重新尝试");
        }
        Cache::store('redis')->set($token_key,1,$app['expire']);
        return true;
    }
}
