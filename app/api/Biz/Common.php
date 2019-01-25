<?php

namespace Api\Biz;

use Mx\Biz\RowGateway;

/**
 * 公共参数
 *
 * @see RowGateway
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Common extends RowGateway
{
    public function getTable()
    {
        return 'common';
    }
}
