<?php

namespace Api\Action\Url;

use Mx\Http\HttpFaultExc;
use Mx\Http\ActionAbstract;

/**
 * 接口排序
 *
 * @see ActionAbstract
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Sort extends ActionAbstract
{
    protected $validateRulesPost    = [
        'tableData1' => [
            'desc' => '接口',
            'message' => '接口数据不能为空',
            'rules' => ['required'],
        ],
        'appform' => [
            'desc' => '产品',
            'message' => '产品信息不能为空',
            'rules' => ['required'],
        ],
    ];

    /**
     * 接口排序
     *
     * @return json
     */
    protected function handlePost()
    {
        $data = $this->formatData();
        if ($data) {
            $data = $this->doUpdate($data);
        }
        $this->response($data);
    }

    /*
     * 要更新的数据
     *
     * @return array
     */
    protected function doUpdate($data)
    {
        if ($data['list']) {
            $query['app'] = $data['app'];
            foreach ($data['list'] as $key => $value) {
                $query['a'] = $value;
                $update['order'] = $key;
                $this->callService(
                    'Url\\Add',
                    ['query' => $query,
                    'update' => $update]
                );
            }
        }
    }

    /*
     * 整理数据
     *
     * @return array
     */
    protected function formatData()
    {
        $data = [];
        $data['app'] = $this->validatedData['appform']['mark'];
        if (is_array($this->validatedData['tableData1'])) {
            foreach ($this->validatedData['tableData1'] as $value) {
                $data['list'][] = $value['value'];
            }
        }
        return $data;
    }
}
