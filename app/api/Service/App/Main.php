<?php

namespace Api\Service\App;

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
    protected $deParams = [];

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
            foreach ($data->list as $key => $value) {
                $result['list'][$key] = $value->export();
                $result['list'][$key]['id'] = $value->id;
            }
        }
        return $result;
    }

    protected function getData()
    {
        $biz = new \Api\Biz\App();
        try {
            return $biz->dao()
                ->find();
        } catch (\Exception $e) {
            throw new \Exception('新增失败');
        }
    }
}
