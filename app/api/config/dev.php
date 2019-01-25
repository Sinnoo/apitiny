<?php

namespace Api;

/**
 * 开发环境配置信息 覆盖测试环境的部分内容
 */

$config = require __DIR__ . '/test.php';

$config['env'] = 'dev';

return $config;
