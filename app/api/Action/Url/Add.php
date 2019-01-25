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
class Add extends ActionAbstract
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
     * 接口
     *
     * @return json
     */
    protected function handlePost()
    {
        $data = $this->formatData();
        if ($data) {
            $data = $this->doAdd($data);
        }
        $this->response($data);
    }

    /*
     * 格式化数据
     *
     * @return array
     */
    protected function formatData()
    {
        $result = [];
        $pathNum = array('a', 'b');//目前支持两级目录
        $path = explode('/', $this->validatedData['path']);
        if (count($path) > 2) {
            return $this->fault(403, '最多支持两级目录');
        }
        if ($path) {
            $result = array(
                'app' => $this->validatedData['appId'],
                'value' => $this->validatedData['value'],
                'title' => $this->validatedData['title'],
                'desc' => $this->validatedData['desc'],
                'mark' => $this->validatedData['mark'],
                'type' => $this->validatedData['type'],
                'utime' => time(),
            );
            foreach ($path as $key => $value) {
                $result[$pathNum[$key]] = $value;
            }
            return $result;
        }
        return false;
    }

    /*
     * 添加接口
     *
     * @return array
     */
    protected function doAdd($data)
    {
        $query['value'] = $data['value'];
        try {
            return $this->callService(
                'Url\\Add',
                ['update' => $data,
                'query' => $query]
            );
        } catch (\Exception $e) {
            return $this->fault(403, $e->getMessage());
        }
    }
}
