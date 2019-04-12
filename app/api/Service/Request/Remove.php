<?php

namespace Api\Service\Request;

use Mx\Service\ServiceAbstract;

/**
 * Class: Remove
 *
 * @see ServiceAbstract
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Remove extends ServiceAbstract
{
    protected $deParams = [];

    protected function execute()
    {
        if (!$this->query) {
            throw new \Exception('查询条件不>能为空');
        }
        $biz = new \Api\Biz\Request();
        return (string)$biz->dao()
            ->remove($this->query, ['justOne' => true]);
    }
}
