<?php

namespace Api\Action\Request;

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
    protected $validateRulesPost    = [
        'id' => [
            'desc' => 'id',
            'message' => 'URL的ID不能为空!',
            'rules' => ['required'],
        ],
    ];

    /**
     * 参数列表
     *
     * @return json
     */
    protected function handlePost()
    {
        $data = $this->getRequest();
        if (!$data['list']) {
            $data = $this->getCommon();
        }
        $this->response($data);
    }

    protected function getCommon()
    {
        try {
            return $this->callService(
                'Common\\Main',
                ['query' => []]
            );
        } catch (\Exception $e) {
            return $this->fault(403, $e->getMessage());
        }
    }

    protected function getRequest()
    {
        try {
            return $this->callService(
                'Request\\Main',
                ['query' => ['urlId' => $this->validatedData['id']]]
            );
        } catch (\Exception $e) {
            return $this->fault(403, $e->getMessage());
        }
    }
}
