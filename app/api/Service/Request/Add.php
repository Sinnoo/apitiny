<?php

namespace Api\Service\Request;

use Mx\Service\ServiceAbstract;

/**
 * Class: Add
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
        $biz = new \Api\Biz\Request();
        try {
            return (string)$biz->dao()
                ->update($this->query, $this->update, ['upsert' => true]);
        } catch (\Exception $e) {
            throw new \Exception('新增失败');
        }
    }
}
