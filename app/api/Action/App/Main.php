<?php

namespace Api\Action\App;

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
     * 查询应用
     *
     * @return json
     */
    protected function handlePost()
    {
        try {
            $data = $this->callService(
                'App\\Main',
                []
            );
        } catch (\Exception $e) {
            return $this->fault(403, $e->getMessage());
        }
        $this->response($data);
    }
}
