<?php

namespace Api\Kernel;

use Mx\Http\Front;
use Mx\Base\Kernel\AppAbstract;

/**
 * App
 *
 * @see AppAbstract
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class App extends AppAbstract
{
    public function __construct()
    {
        $env = getenv('PHP_ENV') ? : 'prod';

        $config = require __DIR__ . '/../config/' . $env . '.php';
        parent::__construct($config);

        $this->getServiceManager()->call('\\MxUtil\\Service\\Config\\Read');
    }

    public function run()
    {
        $router = new Router();
        $front  = new Front($this, $router);

        $front->registerPhase(new \Mx\Http\Phase\PhaseInit());
        $front->registerPhase(new \Mx\Http\Phase\PhaseRouter());
        $front->registerPhase(new \Mx\Http\Phase\PhaseOutput());
        $front->registerPhase(new \Mx\Http\Phase\PhaseAsync());

        $front->run();
    }
}
