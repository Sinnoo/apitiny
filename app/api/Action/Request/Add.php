<?php

namespace Api\Action\Request;

use Mx\Http\HttpFaultExc;
use Mx\Http\ActionAbstract;

/**
 * 请求参数
 *
 * @see ActionAbstract
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Add extends ActionAbstract
{
    protected $validateRulesPost    = [
        'id' => [
            'desc' => 'id',
            'message' => 'id格式错误',
            'rules' => ['required','mongoid'],
        ],
        'data' => [
            'desc' => '参数',
            'message' => '参数不能为空',
            'rules' => ['required'],
        ],
    ];

    /**
     * 保存参数
     *
     * @return json
     */
    protected function handlePost()
    {
        $data = $this->getQuery();
        if ($data) {
            $data = $this->doAdd($data);
        }
        $this->response($data);
    }

    protected function doAdd($query)
    {
        $update = [];
        foreach ($this->validatedData['data'] as $key => $value) {
            $update[$key] = array(
                'name' => $value['name'],
                'case' => $value['case'],
                'desc' => $value['desc'],
                'type' => $value['type'],
                'must' => $value['must'] === 'false' ? false : (bool)$value['must'],
            );
        }
        $result['params'] = $update;
        $result['utime'] = time();
        try {
            return $this->callService(
                'Request\\Add',
                ['update' => $result,
                'query' => $query]
            );
        } catch (\Exception $e) {
            return $this->fault(403, $e->getMessage());
        }
    }

    protected function getQuery()
    {
        $query['urlId'] = $this->validatedData['id'];
        return $query;
    }
}
