<?php

namespace Api\Service\Common;

use Mx\Service\ServiceAbstract;

/**
 * 公共参数
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
                $result['list'][$key] = array(
                    'id' => $value->id,
                    'name' => $value->name,
                    'desc' => $value->desc,
                    'case' => $value->case,
                    'must' => $value->must,
                    'type' => $value->type,
                );
            }
        }
        return $result;
    }

    protected function getData()
    {
        $biz = new \Api\Biz\Common();
        try {
            return $biz->dao()
                ->page(1, 10)
                ->find($this->query);
        } catch (\Exception $e) {
            throw new \Exception('新增失败');
        }
    }
}
