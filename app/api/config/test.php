<?php

namespace Api;

/**
 * 测试环境配置信息 覆盖正式的部分内容
 */

$config = require __DIR__ . '/prod.php';

$config['env'] = 'test';
$config['debug'] = true;

$config['logger']['write'] = $config['root'] . '/runtime/logs/default_error.log';

/** 以下为业务配置 **/
$config['db'] = 'mongodb://10.0.0.27:27017?dbname=news_data&connectTimeoutMS=1000';
#文件图片存储预览
$config['mxss'] = [
    'api' => 'http://mxss.test.imoxiu.cn/api.php',
    'avatar' => 'http://cache.mxss.test.imoxiu.cn/avatar/',
    'file' => [
        'http://n2.f.imoxiu.com/',
        'http://cache.mxss.test.imoxiu.cn/file/',
    ],
    'tp' => [
        'http://n1.p.imoxiu.com/',
        'http://n2.p.imoxiu.com/',
        'http://n3.p.imoxiu.com/',
    ],
    'preview' => [
        'http://cache.mxss.test.imoxiu.cn/preview/',
        'http://cache.mxss.test.imoxiu.cn/preview/'
    ],
    'wp' => [
        'http://cache.mxss.test.imoxiu.cn/preview/',
    ],
    'common' => [
        'http://cache.mxss.test.imoxiu.cn/common/'
    ],
    'temporary' => [
        'http://cache.mxss.test.imoxiu.cn/temporary/'
    ],
];
return $config;
