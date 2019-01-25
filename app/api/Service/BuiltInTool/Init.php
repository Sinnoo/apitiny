<?php

namespace Api\Service\BuiltInTool;

use RuntimeException;
use Mx\Service\ServiceAbstract;

/**
 * init内建命令的实现
 *
 * @see ServiceAbstract
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Init extends ServiceAbstract
{
    protected function execute()
    {
        $this->initRuntimeDir();
        $this->initFrontend();
    }

    /**
     * 初始化处理运行文件件
     */
    private function initRuntimeDir()
    {
        $base = $this->config('root');
        $dirs = $this->config('builtInTool.runtimeDir');
        $oldmask = umask(0);
        foreach ($dirs as $dir) {
            if ($dir{0} != '/') {
                $dir = $base . '/' . $dir;
            }
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
        }
        umask($oldmask);
    }

    /**
     * 前端编译初始化
     * 方式待改进
     */
    private function initFrontend()
    {
        #git托管中的public 初始化时候需要清理
        $check = trim(`git status -s public 2>/dev/null`);
        if ($check && $check != '?? public/') {
            $this->execCmd('git clean -xfd public');
        }

        $frontend = $this->config('builtInTool.frontend');
        if (!$frontend) {
            return false;
        }

        $curPath = getcwd();
        chdir($curPath);

        foreach ($frontend as $module) {
            chdir('frontend/' . $module);
            $cmd = 'cnpm install';
            echo "[$module] " . $cmd . PHP_EOL;
            $this->execCmd($cmd);
            $cmd = 'npm run build ' . $this->env;
            echo "[$module] " .  $cmd . PHP_EOL;
            $this->execCmd($cmd);
            chdir($curPath);
        }
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
