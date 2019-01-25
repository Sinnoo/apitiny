<?php

namespace Api\Service\BuiltInTool;

use Mx\Service\ServiceAbstract;

/**
 * publish 内建命令的实现
 *
 * @see ServiceAbstract
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Publish extends ServiceAbstract
{
    protected function execute()
    {
        $this->genPack();
    }

    /**
     * zip压缩包
     *
     * @return void
     */
    private function genPack()
    {
        $publishFile = $this->target;
        $publishPath = $this->config('builtInTool.publishPath');

        if (!is_dir(dirname($publishFile))) {
            mkdir(dirname($publishFile), 0755, true);
        };
        if (is_file($publishFile)) {
            system("rm -f {$publishFile}");
        }

        $cmd = "zip -rqy {$publishFile} " . implode(' ', $publishPath);
        system($cmd);
    }
}
