<?php

namespace Api\Service\Request;

use Mx\Service\ServiceAbstract;

/**
 * Class: Main
 *
 * @see ServiceAbstract
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Main extends ServiceAbstract
{
    protected $deParams = [
        'page' => 1,
        'limit' => 1,
    ];

    protected function execute()
    {
        $data = $this->getData();
        return $this->formatData($data);
    }

    protected function formatData($data)
    {
        $result['meta'] = $data->meta;
        $result['list'] = [];
        if ($data->list) {
            foreach ($data->list as $value) {
                if ($value->params) {
                    foreach ($value->params as $value2) {
                        $result['list'][] = $value2;
                    }
                }
            }
        }
        return $result;
    }

    protected function getData()
    {
        $biz = new \Api\Biz\Request();
        try {
            return $biz->dao()
                ->page($this->page, $this->limit)
                ->find($this->query);
        } catch (\Exception $e) {
            throw new \Exception('查询失败');
        }
    }
}
