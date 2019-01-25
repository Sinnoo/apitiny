<?php

namespace Api\Service\Response;

use Mx\Service\ServiceAbstract;

/**
 * 保存回复的字段
 *
 * @see ServiceAbstract
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Add extends ServiceAbstract
{
    protected $deParams = [];

    protected function execute()
    {
        $biz = new \Api\Biz\Response();
        return (string)$biz->dao()
            ->update($this->query, $this->update, ['upsert' => true]);
    }
}
