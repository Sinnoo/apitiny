<?php

namespace Api\Service\App;

use Mx\Service\ServiceAbstract;

/**
 * 获取单个APP
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
        if (!$this->query) {
            throw new \Exception('查询条件不能为空');
        }
        $biz = new \Api\Biz\App();
        try {
            return $biz->dao()
                ->findOne($this->query);
        } catch (\Exception $e) {
            throw new \Exception('查询失败');
        }
    }
}
