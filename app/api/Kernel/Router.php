<?php

namespace Api\Kernel;

use Mx\Http\Router as Routing;

/**
 * 路由配置
 *
 * @see AppAbstract
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Router extends Routing
{
    public function __construct()
    {
        $this->group('/api/app', '\\Api\\Action\\App');
        $this->group('/api/url', '\\Api\\Action\\Url');
        $this->group('/api/request', '\\Api\\Action\\Request');
        $this->group('/api/response', '\\Api\\Action\\Response');
        $this->group('/api/common', '\\Api\\Action\\Common');
        $this->group('/api/spider', '\\Api\\Action\\Spider');
        $this->group('/api/base', '\\Api\\Action\\Base');
        # $this->compatible('/json.php', '\\App\\Action');
    }
}
