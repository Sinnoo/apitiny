<?php

namespace Api\Action\Url;

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
        'q' => [
            'desc' => '查询',
            'message' => '查询参数',
            'rules' => [],
        ],
        'app' => [
            'desc' => '产品',
            'message' => '请先选择产品',
            'rules' => ['required'],
        ],
    ];

    /**
     * 查询接口
     *
     * @return json
     */
    protected function handlePost()
    {
        if ($this->validatedData['app'] == '选择产品') {
            return $this->fault(403, '请先选择产品');
        }
        $data = $this->getData();
        $this->response($data);
    }

    /*
     * 获取内容
     *
     * @return array
     */
    protected function getData()
    {
        $query['app'] = $this->validatedData['app'];
        $query['value'] = ['$regex' => $this->validatedData['q']];
        try {
            return $this->callService(
                'Url\\Main',
                ['query' => $query]
            );
        } catch (\Exception $e) {
            return $this->fault(403, $e->getMessage());
        }
    }
}
