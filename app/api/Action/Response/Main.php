<?php

namespace Api\Action\Response;

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
     * 获取回复字段的URL值
     *
     * @return json
     */
    protected function handlePost()
    {
        $data = $this->getResponse();
        $this->response($data);
    }

    /*
     * 获取回复的数据
     *
     * @return array
     */
    protected function getResponse()
    {
        try {
            return $this->callService(
                'Response\\Main',
                ['query' => ['urlId' => $this->validatedData['id']]]
            );
        } catch (\Exception $e) {
            return $this->fault(403, $e->getMessage());
        }
    }
}
