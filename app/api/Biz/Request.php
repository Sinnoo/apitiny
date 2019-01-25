<?php

namespace Api\Biz;

use Mx\Biz\RowGateway;

/**
 * Class: Request
 *
 * @see RowGateway
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Request extends RowGateway
{
    public function getTable()
    {
        return 'request';
    }
}
