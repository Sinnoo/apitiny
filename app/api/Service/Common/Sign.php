<?php

namespace Api\Service\Common;

use Mx\Service\ServiceAbstract;

/**
 * Class: Sign
 *
 * @see ServiceAbstract
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Sign extends ServiceAbstract
{
    protected $deParams = [];

    protected function execute()
    {
        if (!$this->queryString) {
            throw new \Exception('查询参数不能为空!');
        }
        $string = $this->queryString($this->queryString);
        return $this->sign($string);
    }

    /*
     * 签名
     *
     * @return bool
     */
    protected function sign($string)
    {
        $key = $this->config($this->appName . '.sign.key');
        $type = $this->config($this->appName . '.sign.type');
        $sign = hash_hmac($type, $string, $key, true);
        return base64_encode($sign);
    }

    /*
     * URL拼接字符串
     *
     * @return array
     */
    protected function queryString($queryString)
    {
        unset($queryString['sign']);
        ksort($queryString);
        $string = http_build_query($queryString);
        return $string;
    }
}
