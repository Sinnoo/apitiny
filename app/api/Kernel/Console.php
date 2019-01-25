<?php

namespace Api\Kernel;

use Mx\Console\ConsoleAppAbstract;

/**
 * Console
 *
 * @see ConsoleAppAbstract
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Console extends ConsoleAppAbstract
{
    public function __construct()
    {
        $name = "Command Line Tool";
        $env = getenv('PHP_ENV') ? : 'prod';

        $config = require __DIR__ . '/../config/' . $env .'.php';
        parent::__construct($config, $name);

        $config = $this->getServiceManager()->call('\\MxUtil\\Service\\Config\\Read');
        $config && $this->initApp($config);
    }
}
