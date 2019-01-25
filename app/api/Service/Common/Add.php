<?php

namespace Api\Service\Common;

use Mx\Service\ServiceAbstract;

/**
 * 添加公共参数
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
        $biz = new \Api\Biz\Common();
        try {
            return (string)$biz->dao()
                ->insert($this->update);
        } catch (\Exception $e) {
            throw new \Exception('新增失败');
        }
    }
}
