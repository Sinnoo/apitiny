<?php

namespace Api;

use Mx\Http\Router;

include __DIR__ . '/../vendor/autoload.php';

# php内置服务器如果有访问目录问题开启
#if ( php_sapi_name() == 'cli-server' && is_file( __DIR__ . $_SERVER["REQUEST_URI"] ) ) {
#    return false;
#}

/**
 * 访问的单一入口
 *
 * 多模块命名空间在这里配置路由去识别, 路径前缀对应的命名空间
 */
$namespace = Router::prefix([
    '/api' => 'Api',
    '/' => 'Api',
]);

$namespace::single()->run();
