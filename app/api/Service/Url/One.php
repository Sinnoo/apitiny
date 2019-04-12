<?php

namespace Api\Service\Url;

use Mx\Service\ServiceAbstract;

/**
 * Class: One
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
        $biz = new \Api\Biz\Url();
        try {
            return $biz->dao()
                ->findOne($this->query);
        } catch (\Exception $e) {
            throw new \Exception('查询失败');
        }
    }
}
