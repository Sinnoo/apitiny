<?php

namespace Api\Action\App;

use Mx\Http\HttpFaultExc;
use Mx\Http\ActionAbstract;

/**
 * 添加应用
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
            'rules' => ['mongoid'],
        ],
        'prod' => [
            'desc' => '标记',
            'message' => '正式环境不能为空',
            'rules' => ['required'],
        ],
        'test' => [
            'desc' => '标记',
            'message' => '测试环境不能为空',
            'rules' => ['required'],
        ],
        'dev' => [
            'desc' => '标记',
            'message' => '开发环境不能为空',
            'rules' => ['required'],
        ],
        'mark' => [
            'desc' => '标记',
            'message' => '标记不能为空',
            'rules' => ['required'],
        ],
        'desc' => [
            'desc' => '应用描述',
            'message' => '应用描述不能为空',
            'rules' => ['required'],
        ],
        'title' => [
            'desc' => '应用名',
            'message' => '应用名不能为空',
            'rules' => ['required'],
        ],
    ];

    /**
     * handlePost
     *
     * @return void
     */
    protected function handlePost()
    {
        $data = $this->doAdd();
        $this->response($data);
    }

    /*
     * 添加应用
     *
     * @return array
     */
    protected function doAdd()
    {
        if ($this->isExist()) {
            return $this->fault(403, '应用标记已经存在,请更换');
        }
        $this->validatedData['utime'] = time();
        try {
            return $this->callService(
                'App\\Add',
                ['update' => $this->validatedData,
                'query' => $this->genQuery()]
            );
        } catch (\Exception $e) {
            return $this->fault(403, $e->getMessage());
        }
    }

    protected function genQuery()
    {
        $query = [];
        if ($this->validatedData['id']) {
            $query['id'] = $this->validatedData['id'];
        }
        return $query;
    }

    /*
     * 判断应用是否存在
     *
     * @return bool
     */
    protected function isExist()
    {
        if ($this->validatedData['id']) {
            return false;
        }
        $one = $this->callService(
            'App\\One',
            ['query' => ['mark' => $this->validatedData['mark']]]
        );
        if ($one->id) {
            return true;
        }
        return false;
    }
}
