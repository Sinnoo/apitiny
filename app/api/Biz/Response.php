<?php

namespace Api\Biz;

use Mx\Biz\RowGateway;

/**
 * 回复表
 *
 * @see RowGateway
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Response extends RowGateway
{
    public function getTable()
    {
        return 'response';
    }
}
