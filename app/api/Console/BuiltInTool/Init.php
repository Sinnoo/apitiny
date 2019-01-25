<?php

namespace Api\Console\BuiltInTool;

use Mx\Console\CommandAbstract;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * 内建命令 init
 *
 * 自动生成运行时目录结构
 * 可以通过扩展此类来适应项目特殊性需要
 *
 * @see CommandAbstract
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Init extends CommandAbstract
{
    protected function configure()
    {
        $this->setName('init')
            ->setDescription('项目初始化, 运行时目录和权限创建等')
            ->addOption(
                'env',
                'E',
                InputOption::VALUE_OPTIONAL,
                '运行环境  dev | test | prod',
                'dev'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $params = [];
        $params['env'] = $input->getOption('env');
        $this->callService('BuiltInTool\Init', $params);
    }
}
