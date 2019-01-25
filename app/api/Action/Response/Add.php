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
class Add extends ActionAbstract
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
        'new' => [
            'desc' => '新增字段',
            'message' => '新增的字段',
            'rules' => [],
        ],
        'data' => [
            'desc' => '参数',
            'message' => '参数不能为空',
            'rules' => [],
        ],
    ];

    /**
     * 保存回复的内容
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

    /*
     * 整理并保存返回字段描述信息
     *
     * @return array
     */
    protected function doAdd($query)
    {
        #过滤不良信息
        if ($this->validatedData['data'] === 'undefined' || !$this->validatedData['data']) {
            $this->validatedData['data'] = '';
        }
        $update = array(
            'responseData' => $this->validatedData['data'],
            'desc' => (string)$this->validatedData['desc'],
            'urlId' => $this->validatedData['id'],
            'utime' => time(),
        );
        #追加新增的字段
        if ($this->validatedData['new']) {
            $parma = explode('/', $this->validatedData['new']['title']);
            $data = array(
                'name' => end($parma),
                'desc' => $this->validatedData['new']['desc'],
                'case' => '',
                'type' => $this->validatedData['new']['type'],
            );
            #有返回值
            if (is_array($update['responseData'])) {
                foreach ($update['responseData'] as $key => $value) {
                    if ($key == $parma[0]) {
                        $update['responseData'][$key]['responseData'][] = $data;
                    }
                }
            }
            #没返回值
            if (!$update['responseData']) {
                $data2[$data['name']] = $data;
                $update['responseData'] = $data2;
            }
        }
        return $this->addData($query, $update);
    }

    /*
     * 保存到数据库
     *
     * @return bool
     */
    protected function addData($query, $update)
    {
        try {
            return $this->callService(
                'Response\\Add',
                ['update' => $update,
                'query' => $query]
            );
        } catch (\Exception $e) {
            return $this->fault(403, $e->getMessage());
        }
    }

    /*
     * 查询条件
     *
     * @return array
     */
    protected function getQuery()
    {
        $query['urlId'] = $this->validatedData['id'];
        return $query;
    }
}
