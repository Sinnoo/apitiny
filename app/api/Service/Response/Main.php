<?php

namespace Api\Service\Response;

use Mx\Service\ServiceAbstract;

/**
 * 回复的字段
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
        'sort' => 'utime',
        'desc' => 'DESC',
    ];

    protected function execute()
    {
        $data = $this->getData();
        return $this->formatData($data);
    }

    /*
     * 格式化数据
     *
     * @return array
     */
    protected function formatData($data)
    {
        $result = [];
        if ($data->list) {
            foreach ($data->list as $value) {
                $result['responseData'] = $value->responseData;
                $result['desc'] = (string)$value->desc;
                $result['id'] = $value->id;
            }
        }
        return $result;
    }

    /*
     * 获取数据
     *
     * @return array
     */
    protected function getData()
    {
        $biz = new \Api\Biz\Response();
        try {
            return $biz->dao()
                ->page($this->page, $this->limit)
                ->find($this->query);
        } catch (\Exception $e) {
            throw new \Exception('查询失败');
        }
    }
}
