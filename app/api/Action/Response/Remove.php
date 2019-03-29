<?php

namespace Api\Action\Response;

use Mx\Http\HttpFaultExc;
use Mx\Http\ActionAbstract;

/**
 * 清理返回的字段
 *
 * @see ActionAbstract
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Remove extends ActionAbstract
{
    protected $validateRulesPost    = [
        'id' => [
            'desc' => 'id',
            'message' => 'id格式错误',
            'rules' => ['required','mongoid'],
        ],
        'desc' => [
            'desc' => '备注',
            'message' => '返回值的一些备注信息',
            'rules' => [],
        ],
    ];

    /**
     * 删除返回的字段
     *
     * @return json
     */
    protected function handlePost()
    {
        $data = $this->doRemove();
        $this->response($data);
    }

    protected function doRemove()
    {
        $query['urlId'] = $this->validatedData['id'];
        try {
            return $this->callService(
                'Response\\Remove',
                ['query' => $query]
            );
        } catch (\Exception $e) {
            return $this->fault(403, $e->getMessage());
        }
    }
}
