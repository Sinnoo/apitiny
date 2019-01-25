<?php

namespace Api\Service\BuiltInTool;

use RuntimeException;
use Mx\Service\ServiceAbstract;

/**
 * build 内建命令的实现
 *
 * @see ServiceAbstract
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Build extends ServiceAbstract
{
    protected function execute()
    {
        $this->baseDir = $this->config('root');
        $this->logsDir = $this->baseDir . "/build/logs";

        $this->genBuild();
    }

    private function genBuild()
    {
        chdir($this->baseDir);

        $logs = $this->logsDir;
        if (!is_dir($logs)) {
            mkdir($logs, 0755, true);
        }

        $cmd = "phploc -q --log-csv ${logs}/phploc.csv --log-xml=${logs}/phploc.xml app";
        $this->execCmd($cmd);

        $cmd = "phpmd app/ xml phpmd.xml --reportfile build/logs/pmd.xml";
        $this->execCmd($cmd, 2);

        $cmd = "phpcs --extensions=php --report=checkstyle";
        $cmd .= " --report-file=build/logs/checkstyle.xml";
        $cmd .= " --standard=psr2 app/ bin/";
        $this->execCmd($cmd, 1);

        $cmd = "phpdox";
        $this->execCmd($cmd);
    }

    private function execCmd($cmd, $statusCode = 0)
    {
        system($cmd, $status);
        if ($status !== $statusCode) {
            $msg = "$cmd \nexec failed";
            throw new RuntimeException($msg);
        }
    }
}
