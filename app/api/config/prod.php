<?php

namespace Api;

/**
 * 全局
 */
$config = [
    'env' => 'prod',
    'debug' => false,
    'root' => realpath(__DIR__ . '/../../../')
];


/**
 * 内建工具
 */
$config['builtInTool'] = [
    'runtimeDir' => [
        'runtime/logs',
        'runtime/smarty'
    ],
    'frontend' => [
        'api',
    ],
    'publishPath' => [
        'app/',
        'bin/',
        'frontend/api/tpl/',
        'public/',
        'runtime/',
        'vendor/',
        'composer.*',
    ],
];

/**
 * Action
 */
$config['action'] = [
    'format' => 'auto', //默认输出格式
    'catch' => false, //是否自动捕获异常
    'faultTpl' => 'fault', //异常输出的模版
];

/**
 * tpl
 */
$config['tpl'] = [
    'tplDir' => $config['root'] . '/frontend/default/tpl',
    'compileDir' => $config['root'] . '/runtime/smarty',
    'assets' => 'assets_default/'
];

/**
 * 错误日志
 */
$config['logger'] = [
    'name' => 'errorlog',
    'write' => '/var/log/mxapp/songmingshuo_api_error.log',
    'level' => 7
];

/**
 * config-service 配置管理平台
 */
$config['config-service'] = [
    //'file' => '/var/www/config-service/songmingshuo_api.json',
];

/** 以下为业务配置 **/

$config['db'] = 'mongodb://10.0.0.27:27017?dbname=news_data&connectTimeoutMS=1000';
$config['ktime'] = [
    'sign' => [
        'key' => '9229fe616a964e0b0d64d818c20e94b631ec28f9',
        'type' => 'sha1',
    ],
];
$config['vlocker'] = [
    'sign' => [
        'key' => '21ca4ac21709a30958845e7a4e700b10',
        'type' => 'sha1',
    ],
];
#图片存储相关
$config['mxss'] = [
    'api' => 'http://mxss.moxiu/api.php',
    'avatar' => 'http://avatar.imoxiu.com/',
    'file' => [
        'http://n2.f.imoxiu.com/',
        'http://f.eagla.com/',
    ],
    'tp' => [
        'http://n1.p.imoxiu.com/',
        'http://n2.p.imoxiu.com/',
        'http://n3.p.imoxiu.com/',
    ],
    'preview' => [
        'http://w.p.imoxiu.com/',
        'http://w1.p.imoxiu.com/',
    ],
    'wp' => [
        'http://w.p.imoxiu.com/',
        'http://w1.p.imoxiu.com/',
    ],
    'common' => [
        'http://n1.c.imoxiu.com/',
    ],
    'temporary' => [
        'http://cache.next.moxiu.com/temporary/'
    ],
];
return $config;
