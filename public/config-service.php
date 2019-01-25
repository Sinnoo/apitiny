<?php
/**
 * 配置服务接口
 *
 * 由配置服务平台通知配置更新,根据信息获取配置,并更新到本地
 */
namespace Api;

use Api\Kernel\App;

include __DIR__ . '/../vendor/autoload.php';

APP::service()->call('\\MxUtil\\Service\\Config\\Write');
