<?php

namespace Api\Service\Response;

use Mx\Service\ServiceAbstract;

/**
 * 获取单个的回复字段
 *
 * @see ServiceAbstract
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class One extends ServiceAbstract
{
    protected $deParams = [];

    protected function execute()
    {
        $biz = new \Api\Biz\Response();
        if (!$this->query) {
            throw new \Exception('查询参数不能为空');
        }
        return $biz->dao()
            ->findOne($this->query);
    }
}
