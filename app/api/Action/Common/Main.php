<?php

namespace Api\Action\Common;

use Mx\Http\HttpFaultExc;
use Mx\Http\ActionAbstract;

/**
 * Class: Main
 *
 * @see ActionAbstract
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Main extends ActionAbstract
{
    protected $validateRulesPost    = [];

    /**
     * handlePost
     *
     * @return void
     */
    protected function handlePost()
    {
        throw new HttpFaultExc('not support', 500);
    }
}
