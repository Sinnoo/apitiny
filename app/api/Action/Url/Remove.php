<?php

namespace Api\Action\Url;

use Mx\Http\HttpFaultExc;
use Mx\Http\ActionAbstract;

/**
 * 删除接口和其请求的参数
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
            'desc' => ['id'],
            'message' => 'id格式错误',
            'rules' => ['mongoid'],
        ],
        'appId' => [
            'desc' => '应用ID',
            'message' => '应用ID不能为空',
            'rules' => ['required'],
        ],
        'type' => [
            'desc' => '请求方式',
            'message' => '请求方式不能为空',
            'rules' => ['required'],
        ],
        'mark' => [
            'desc' => '客户端标记',
            'message' => '客户端标记',
            'rules' => [],
        ],
        'desc' => [
            'desc' => '描述',
            'message' => '描述不能为空',
            'rules' => ['required'],
        ],
        'title' => [
            'desc' => '标题',
            'message' => '标题不能为空',
            'rules' => ['required'],
        ],
        'value' => [
            'desc' => 'url的值',
            'message' => 'url不能为空',
            'rules' => ['required'],
        ],
        'path' => [
            'desc' => '路径',
            'message' => '路径不能为空',
            'rules' => ['required'],
        ],
    ];

    /**
     * 删除接口
     *
     * @return json
     */
    protected function handlePost()
    {
        $mark = $this->validatedData['mark'];
        if ($mark != 132) {
            return $this->fault(403, '您不是管理员');
        }
        $data = $this->getOne();
        if ($data) {
            $data = $this->removeUrl($data);
        }
        $this->response($data);
    }

    protected function removeUrl($uid)
    {
        $this->callService(
            'Url\\Remove',
            ['query' => ['id' => $this->validatedData['id']]]
        );
        $this->callService(
            'Response\\Remove',
            ['query' => ['urlId' => $this->validatedData['id']]]
        );
        $this->callService(
            'Request\\Remove',
            ['query' => ['urlId' => $this->validatedData['id']]]
        );
    }

    protected function getOne()
    {
        $data = $this->callService(
            'Url\\One',
            ['query' => ['id' => $this->validatedData['id']]]
        );
        if ($data->id) {
            return $data->id;
        }
        return false;
    }
}
