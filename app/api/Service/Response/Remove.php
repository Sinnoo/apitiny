<?php

namespace Api\Service\Response;

use Mx\Service\ServiceAbstract;

/**
 * 用户的返回字段
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
            throw new \Exception('查询条件不能为空');
        }
        $biz = new \Api\Biz\Response();
        return (string)$biz->dao()
            ->remove($this->query, ['justOne' => true]);
    }
}
