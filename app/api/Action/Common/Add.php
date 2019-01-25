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
class Add extends ActionAbstract
{
    protected $validateRulesPost    = [
        'name' => [
            'desc' => '参数名',
            'message' => '参数名不能为空',
            'rules' => ['required'],
        ],
        'desc' => [
            'desc' => '描述',
            'message' => '描述不能为空',
            'rules' => ['required'],
        ],
        'case' => [
            'desc' => '请求方式',
            'message' => '请求方式不能为空',
            'rules' => ['required'],
        ],
        'type' => [
            'desc' => '参数类型',
            'message' => '参数类型不能为空',
            'rules' => ['required'],
        ],
        'must' => [
            'desc' => '是否必须',
            'message' => '是否必须',
            'rules' => ['required'],
        ],
    ];

    /**
     * 公共参数
     *
     * @return json
     */
    protected function handlePost()
    {
        $data = $this->doAdd();
        $this->response($data);
    }

    protected function doAdd()
    {
        $must = $this->validatedData['must'];
        $this->validatedData['must'] = true;
        if ($must == '-1') {
            $this->validatedData['must'] = false;
        }
        $this->validatedData['utime'] = time();
        try {
            return $this->callService(
                'Common\\Add',
                ['update' => $this->validatedData]
            );
        } catch (\Exception $e) {
            return $this->fault(403, $e->getMessage());
        }
    }
}
