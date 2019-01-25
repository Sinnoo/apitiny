<?php

namespace Api\Console;

use Mx\Console\CommandAbstract;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class: Test 用于测试, 你可以通过 ./bin/console Namespace:Test 执行到它
 *
 * @see CommandAbstract
 * @author songmingshuo <songmingshuo@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Test extends CommandAbstract
{
    /**
     * 配置项 命令行描述、支持的输出参数等, 执行--help会展示这些
     */
    protected function configure()
    {
        $this->setDescription('测试脚本')
            ->addArgument(
                'arg',
                InputArgument::REQUIRED,
                'desc'
            );
    }

    /**
     * @SuppressWarnings(PHPMD)
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $params = [];
        $params['arg'] = $input->getargument('arg');

        var_dump($params);
    }
}
